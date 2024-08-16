<?php

namespace AppBundle\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\EditableDialogBoxConfiguration;
use Pimcore\Extension\Document\Areabrick\EditableDialogBoxInterface;
use Pimcore\Model\Document;
use Pimcore\Model\Document\Editable\Area\Info;

class Button extends AbstractAreabrick implements EditableDialogBoxInterface
{
    /* custom-sorting: 70 */

    public function getName()
    {
        return 'Button';
    }

    public function getIcon()
    {
        return '/bundles/pimcoreadmin/img/flat-color-icons/button.svg';
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
                            'label' => 'Zentriert',
                            'name' => 'centered',
                            'config' => [
                                'reload' => true
                            ]
                        ],
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