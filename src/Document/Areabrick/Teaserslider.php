<?php

namespace App\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Editable\Area\Info;

class Teaserslider extends AbstractAreabrick implements EditableDialogBoxInterface
{
    public function getName(): string
    {
        return 'Teaser-Slider';
    }

    public function getDescription(): string
    {
        return '';
    }

    public function getTemplateLocation(): string
    {
        return static::TEMPLATE_LOCATION_GLOBAL;
    }

    public function getIcon() : string{
        return '/bundles/pimcoreadmin/img/flat-color-icons/tag.svg';
    }

    public function getEditableDialogBoxConfiguration(Document\Editable $area, ?Info $info): EditableDialogBoxConfiguration
    {
        $config = new EditableDialogBoxConfiguration();
        $config->setWidth(600);
        $config->setHeight(450);
        $config->setItems([
            'type' => 'tabpanel',
            'items' => [
                [
                    'type' => 'panel',
                    'title' => 'Allgemein',
                    'items' => $this->getDefaultConfig(),
                ]
            ],
        ]);
        return $config;
    }
}
