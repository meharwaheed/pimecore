<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Pimcore\Log\Simple;

class BaseController extends FrontendController
{
    /**
     * @inheritDoc
     */
    public function onKernelController(FilterControllerEvent $event)
    {

        /**
         * @var Pimcore\Model\Document\Page  $document
         */
        if ( !$this->editmode ) {
            if (\Pimcore\Model\Site::isSiteRequest()) {
            } else {
                $document = $this->document;
                $actualSite = \Pimcore\Tool\Frontend::getSiteForDocument($document);
                $mainDomain = $actualSite->mainDomain;
                if ( !is_null($mainDomain) ) {
                    if ( $document->getPath() !== '/' ) {
                        $newRoute = 'https://' . $mainDomain . '/' .  $document->getKey();
                    } else {
                        $newRoute = 'https://' . $mainDomain;
                    }
                    header("Location: " . $newRoute);
                    exit;
                }
            }
        }

        // enable view auto-rendering
        $this->setViewAutoRender($event->getRequest(), true, 'twig');

    }

    /**
     * @param Request $request
     * @param DataObject $object
     *
     * @return bool
     */
    protected function verifyPreviewRequest(Request $request, DataObject $object): bool
    {
        if ($request->get('pimcore_object_preview') && DataObject\Service::getObjectFromSession($object->getId())) {
            return true;
        }

        return false;
    }
}