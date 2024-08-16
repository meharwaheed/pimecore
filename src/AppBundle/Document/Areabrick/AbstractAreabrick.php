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
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace AppBundle\Document\Areabrick;

use Pimcore\Extension\Document\Areabrick\AbstractTemplateAreabrick;

abstract class AbstractAreabrick extends AbstractTemplateAreabrick
{

    /**
     * Default Configuration for container-width class of area block
     * @var array
     */
    private $containerWidth = [
        'type' => 'select',
        'label' => 'Breite des Containers (gilt nicht innerhalb von Spalten!)',
        'name' => 'container',
        'config' => [
            'store' => [
                ['narrow', 'Schmal'],
                ['standard', 'Standard'],
                ['wide', 'Volle Breite'],
            ],
            'defaultValue' => 'standard'
        ]
    ];

    /**
     * Default configuration for margin-bottom class of area block
     * @var array
     */
    private $marginTop = [
        'type' => 'select',
        'label' => 'Abstand nach oben',
        'name' => 'margin-top',
        'config' => [
            'store' => [
                ['none', 'Keiner'],
                ['tiny', 'Winzig'],
                ['small', 'Klein'],
                ['medium', 'Standard'],
                ['large', 'Groß'],
            ],
            'defaultValue' => 'medium'
        ]
    ];

    /**
     * Default configuration for margin-bottom class of area block
     * @var array
     */
    private $marginBottom = [
        'type' => 'select',
        'label' => 'Abstand nach unten',
        'name' => 'margin-bottom',
        'config' => [
            'store' => [
                ['none', 'Keiner'],
                ['tiny', 'Winzig'],
                ['small', 'Klein'],
                ['medium', 'Standard'],
                ['large', 'Groß'],
            ],
            'defaultValue' => 'medium'
        ]
    ];

    /**
     * Default configuration for background class of area block
     * @var array
     */
    private $greyBackground = [
        'type' => 'checkbox',
        'label' => 'Grauer Hintergrund',
        'name' => 'grey',
        'config' => [
            'reload' => true
        ]
    ];

    /**
     * Default configuration for background class of area block
     * @var array
     */
    private $backgroundColor = [
        'type' => 'select',
        'label' => 'Hintergrundfarbe',
        'name' => 'background-color',
        'config' => [
            'store' => [
                ['none', 'Keine'],
                ['grey', 'grau'],
                ['green', 'grün'],
                ['blue', 'blau'],
                ['brown', 'braun'],
            ],
            'defaultValue' => 'none'
        ]
    ];

    /**
     * Default configuration for anchor id
     * @var string
     */
    private $anchor = [
        'type' => 'input',
        'label' => 'Anker ID',
        'name' => 'anchor',
        'config' => [
            'defaultValue' => ''
        ]
    ];

    /**
     * @inheritDoc
     */
    public function getTemplateLocation()
    {
        return static::TEMPLATE_LOCATION_GLOBAL;
    }

    /**
     * @inheritDoc
     */
    public function getTemplateSuffix()
    {
        return static::TEMPLATE_SUFFIX_TWIG;
    }

    /**
     * @return array
     */
    public function getContainerWidth()
    {
        return $this->containerWidth;
    }

    /**
     * @return array
     */
    public function getMarginTop()
    {
        return $this->marginTop;
    }

    /**
     * @return array
     */
    public function getMarginBottom()
    {
        return $this->marginBottom;
    }

    /**
     * @return array
     */
    public function getBackgroundColor()
    {
        return $this->greyBackground;
    }

    /**
     * @return array
     */
    public function getAnchor()
    {
        return $this->getAnchor;
    }

    /**
     * @return array
     */
    public function getGreyBackground()
    {
        return $this->backgroundColor;
    }

    /**
     * @return array
     */
    public function getDefaultConfig()
    {
        return [$this->containerWidth, $this->marginTop, $this->marginBottom, $this->anchor, $this->backgroundColor, $this->greyBackground];
    }

    /**
     * @return array
     */
    public function getLimitedConfig()
    {
        return [$this->marginTop, $this->marginBottom, $this->backgroundColor, $this->greyBackground];
    }


}