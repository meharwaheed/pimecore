<?php

namespace App\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Editable\Area\Info;

class Heading extends AbstractAreabrick implements EditableDialogBoxInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'Überschrift';
    }

    public function getDescription(): string
    {
        return '';
    }

    public function getTemplateLocation(): string
    {
        return static::TEMPLATE_LOCATION_GLOBAL;
    }

    public function getIcon(): string {
        return '/bundles/pimcoreadmin/img/flat-color-icons/input.svg';
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
                            'type' => 'select',
                            'label' => 'Typ',
                            'name' => 'version',
                            'config' => [
                                'store' => [
                                    ['h2', 'Heading 2'],
                                    ['h3', 'Heading 3'],
                                    ['h4', 'Heading 4'],
                                    ['h5', 'Heading 5'],
                                ],
                                'defaultValue' => 'h2',
                                'reload' => true
                            ]
                        ],
                        [
                            'type' => 'checkbox',
                            'label' => 'Zentriert?',
                            'name' => 'centered',
                            'config' => [
                                'reload' => true
                            ]
                        ]
                    ]
                ],
                [
                    'type' => 'panel',
                    'title' => 'Allgemein',
                    'items' => $this->getDefaultConfig(),
                ],

            ],
        ]);
        return $config;
    }
}
