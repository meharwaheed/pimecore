<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use \Pimcore\Model\DataObject;
use \Pimcore\Model\Document;
use \Pimcore\Model\Asset;
use \Pimcore\Tool;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Conecto\SearchBundle\SearchServiceInterface;

class NewsletterController extends BaseController
{


    public function defaultAction(Request $request)
    {

    }
   
}
