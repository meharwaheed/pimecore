<?php

namespace AppBundle\Sitemap\Processor;

use Pimcore\Tool;
use Pimcore\Model\Element\AbstractElement;
use Pimcore\Sitemap\Element\GeneratorContextInterface;
use Pimcore\Sitemap\Element\ProcessorInterface;
use Presta\SitemapBundle\Sitemap\Url as Sitemap;
use Presta\SitemapBundle\Sitemap\Url\Url;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

class ImageProcessor implements ProcessorInterface
{
    public function process(Url $url, AbstractElement $element, GeneratorContextInterface $context)
    {
        if ($url instanceof UrlConcrete) {

            $images = $this->getImagesForDocument($element);

            if($images->count()) {
                $decoratedUrl = new Sitemap\GoogleImageUrlDecorator($url);

                foreach($images as $image) {
                    $fullPath = Tool::getHostUrl() . $image->getFullPath();
                    $decoratedUrl->addImage(new Sitemap\GoogleImage($fullPath));
                }

                return $decoratedUrl;
            }
        }

        return $url;
    }

    /**
     * Gets all images of a page based on dependencies table
     *
     * @param $page
     * @return \Pimcore\Model\Asset\Listing
     */
    private function getImagesForDocument($page)
    {
        $images = new \Pimcore\Model\Asset\Listing();
        $images->setCondition("assets.type = \"image\" AND dependencies.sourceid = :page AND sourcetype = \"document\" AND targettype = \"asset\"", ["page" => $page->getId()]);

        $images->onCreateQuery(
        /*
         * \Pimcore\Db\ZendCompatibility\QueryBuilder ist leider deprecated,
         * aber weder in der Doku noch in einem Kommentar ist ein Ersatz zu finden ...
         */
            function (\Pimcore\Db\ZendCompatibility\QueryBuilder $select) use ($images) {
                $select->join(
                    'dependencies',
                    'assets.id = dependencies.targetid',
                    ''
                );
            }
        );

        return $images;
    }
}
