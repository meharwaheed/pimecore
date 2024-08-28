<?php

namespace App\Controller;

use Pimcore\Bundle\AdminBundle\Controller\Admin\LoginController;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Conecto\SearchBundle\SearchServiceInterface;

class DefaultController extends FrontendController
{
    public function defaultAction(Request $request): Response
    {
        return $this->render('default/default.html.twig');
    }

    public function indexAction(Request $request): Response {
        die('got here');
    }

    /**
     * Forwards the request to admin login
     */
    public function loginAction(): Response
    {
        return $this->forward(LoginController::class.'::loginCheckAction');
    }

    public function searchAction(Request $request, SearchServiceInterface $search) {
        $results = false;
        $searchstringText = null;

        if ($request->query->has('q')) {
            $searchstring = trim($request->get('q', ''));

            if ($searchstring) {
                $searchstringText = $searchstring;
                $results = $search->getResults($searchstring);
            }
        }

        $this->view->searchstring = $searchstringText;
        $this->view->results = $results;

    }

//    public function defaultAction(Request $request)
//    {
//
//    }
    public function contactAction(Request $request, ValidatorInterface $validator, \Pimcore\Config\Config $websiteConfig)
    {

        $this->view->validation_error = false;
        $this->view->robot_error = false;
        $session = $request->getSession();
        $session->clear();

        if (!$this->editmode && $request->get('isSend') == 'Ja' && $request->get('sendcheck') == '') {

            // validation
            $mandatories = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'dataProtection' => $request->get('dataProtection')
            ];

            $constraints = new Assert\Collection([
                'name' => [new Assert\Length(['min' => 2]), new Assert\NotBlank],
                'email' => [new Assert\Email(), new Assert\notBlank],
                'dataProtection' => [new Assert\NotNull],
            ]);
            $violations = $validator->validate($mandatories, $constraints);
            if (count($violations) > 0) {
                $this->view->validation_error = true;
            } else {
                // validation passed
                $area = $request->get("message");
                $text = trim($area);
                $text = nl2br($text);
                $paramArray = [
                    "name" => $request->get("name"),
                    "email" => $request->get("email"),
                    "phone" => $request->get("phone"),
                    "street" => $request->get("street"),
                    "postal" => $request->get("postal"),
                    "city" => $request->get("city"),
                    "country" => $request->get("country"),
                    "message" => $text,
                ];

                $mail = new \Pimcore\Mail();
                $mail->addTo($paramArray['email']);
                $mail->setDocument($this->document->getProperty("email"));
                $mail->setParams($paramArray);

                if (!isset($_POST['g-recaptcha-response'])) {
                    $this->view->robot_error = true;
                } else {
                    $captcha = $_POST['g-recaptcha-response'];
                    $secretKey = $websiteConfig->get('recaptcha_serverkey');
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captcha);
                    $response = file_get_contents($url);
                    $responseKeys = json_decode($response, true);
                    if (!$responseKeys["success"]) {
                        $this->view->robot_error = true;
                    } else {
                        $mail->send();
                        return $this->redirect($this->document->getProperty("thankyouPage"));
                    }
                }

            }
        }
    }

    public function emailAction(Request $request)
    {

    }

    public function mainnavAction(Request $request)
    {

    }

    public function footerAction(Request $request)
    {

    }

    public function biepgartenAction(Request $request)
    {

    }

    public function notfoundAction(Request $request)
    {

    }
}
