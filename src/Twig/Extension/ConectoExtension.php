<?php

namespace AppBundle\Twig\Extension;

use http\Env\Request;
use Pimcore\Model\Document;
use Pimcore\Model\Site;
use Pimcore\Navigation\Container;
use \Pimcore\Tool\Frontend;
use Pimcore\Templating\Helper\Navigation;
use Symfony\Component\Intl\Intl;


final class ConectoExtension extends \Twig_Extension
{
    /**
     * @var Navigation
     */
    private $navigationHelper;

    /**
     * @param Navigation $navigationHelper
     */
    public function __construct(Navigation $navigationHelper)
    {
        $this->navigationHelper = $navigationHelper;
    }

    /**
     * @return \Twig_Function[]
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_Function('conecto_build_nav', [$this, 'buildMainNavigation']),
            new \Twig_Function('conecto_country_list', [$this, 'buildCountryList']),
            new \Twig_Function('conecto_inline_data', [$this, 'inlineData']),
        ];
    }

    /**
     * @param string $path
     * @return false|string
     */
    public function inlineData(string $path)
    {
        $fileContent = file_get_contents(PIMCORE_WEB_ROOT . '/' . $path);
        return $fileContent;
    }

    /**
     * @param $locale
     * @return mixed
     */
    public function buildCountryList($locale)
    {
        return Intl::getRegionBundle()->getCountryNames($locale);
    }

    /**
     * @param Document $activeDocument
     * @param Document $navigationRootDocument
     * @return Container
     */
    public function buildMainNavigation(Document $activeDocument, Document $navigationRootDocument): Container
    {
        return $this->navigationHelper->buildNavigation(
            $activeDocument,
            $navigationRootDocument,
            null,
            function (\Pimcore\Navigation\Page\Document $page, $doc) {
                if (!$doc instanceof Document) {
                    return;
                }
                $page->setCustomSetting("siteClass", $doc->getProperty("siteClass"));
                $page->setCustomSetting("special", $doc->getProperty("special"));
                $mainDomain = \Pimcore\Tool\Frontend::getSiteForDocument($doc)->mainDomain;

                // we are on th current site
                if ( !is_null($mainDomain) ) {
                    // if url parameter 'conecto' is set
                    if ( $doc->getType() === 'link' ) {
                        /*$domain = \Pimcore\Tool\Frontend::getSiteForDocument($doc)->mainDomain;
                        $href = $doc->getHref();
                        $url = $domain . $href;
                        $page->setCustomSetting("url", $url);*/
                        $page->setCustomSetting("url", $doc->getHref());
                    } else {
                        $page->setCustomSetting("url", $doc->getUrl($mainDomain));
                    }
                    // we are on another site
                } else {
                    //p_r($doc->getType());
                    if ( $doc->getType() === 'link' ) {

                        $page->setCustomSetting("url", $doc->getHref());
                    } else {
                        $page->setCustomSetting("url", $doc->getFullPath());
                    }
                }
                return $page;
            }
        );
    }

}