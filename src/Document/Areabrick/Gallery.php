<?php

namespace App\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Editable\Area\Info;

class Gallery extends AbstractAreabrick implements EditableDialogBoxInterface
{
    public function getName(): string
    {
        return 'Galerie';
    }

    public function getDescription(): string
    {
        return '';
    }

    public function getTemplateLocation(): string
    {
        return static::TEMPLATE_LOCATION_GLOBAL;
    }

    public function getIcon(): ?string
    {
        return '/bundles/pimcoreadmin/img/flat-color-icons/grid.svg';
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
                    'title' => $this->getName(),
                    'items' => [
                        [
                            'type' => 'checkbox',
                            'label' => 'Grosse Darstellung',
                            'name' => 'large'
                        ]
                    ]
                ],
                [
                    'type' => 'panel',
                    'title' => 'Allgemein',
                    'items' => $this->getDefaultConfig(),
                ]
            ],
        ]);
        return $config;
    }

    public function action(Info $info): ?\Symfony\Component\HttpFoundation\Response
    {
        $currentId = $info->tag->currentIndex['type'] . '-' . $info->tag->currentIndex['key'];
        $info->getView()->currentId = $currentId;
    }
}
