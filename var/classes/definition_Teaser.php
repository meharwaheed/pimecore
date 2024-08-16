<?php

/**
 * Inheritance: no
 * Variants: no


Fields Summary:
- image [image]
- category [select]
- title [input]
- link [link]
 */


return Pimcore\Model\DataObject\ClassDefinition::__set_state(array(
    'id' => '1',
    'name' => 'Teaser',
    'description' => '',
    'creationDate' => 0,
    'modificationDate' => 1613477246,
    'userOwner' => 2,
    'userModification' => 2,
    'parentClass' => '',
    'implementsInterfaces' => '',
    'listingParentClass' => '',
    'useTraits' => '',
    'listingUseTraits' => '',
    'encryption' => false,
    'encryptedTables' =>
        array (
        ),
    'allowInherit' => false,
    'allowVariants' => NULL,
    'showVariants' => false,
    'layoutDefinitions' =>
        Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
            'fieldtype' => 'panel',
            'labelWidth' => 100,
            'layout' => NULL,
            'border' => false,
            'name' => 'pimcore_root',
            'type' => NULL,
            'region' => NULL,
            'title' => NULL,
            'width' => NULL,
            'height' => NULL,
            'collapsible' => false,
            'collapsed' => false,
            'bodyStyle' => NULL,
            'datatype' => 'layout',
            'permissions' => NULL,
            'childs' =>
                array (
                    0 =>
                        Pimcore\Model\DataObject\ClassDefinition\Layout\Panel::__set_state(array(
                            'fieldtype' => 'panel',
                            'labelWidth' => 100,
                            'layout' => NULL,
                            'border' => false,
                            'name' => 'Layout',
                            'type' => NULL,
                            'region' => NULL,
                            'title' => '',
                            'width' => NULL,
                            'height' => NULL,
                            'collapsible' => false,
                            'collapsed' => false,
                            'bodyStyle' => '',
                            'datatype' => 'layout',
                            'permissions' => NULL,
                            'childs' =>
                                array (
                                    0 =>
                                        Pimcore\Model\DataObject\ClassDefinition\Data\Image::__set_state(array(
                                            'fieldtype' => 'image',
                                            'width' => '',
                                            'height' => '',
                                            'uploadPath' => '',
                                            'queryColumnType' => 'int(11)',
                                            'columnType' => 'int(11)',
                                            'phpdocType' => '\\Pimcore\\Model\\Asset\\Image',
                                            'name' => 'image',
                                            'title' => 'Bild',
                                            'tooltip' => '',
                                            'mandatory' => true,
                                            'noteditable' => false,
                                            'index' => false,
                                            'locked' => false,
                                            'style' => '',
                                            'permissions' => NULL,
                                            'datatype' => 'data',
                                            'relationType' => false,
                                            'invisible' => false,
                                            'visibleGridView' => false,
                                            'visibleSearch' => false,
                                        )),
                                    1 =>
                                        Pimcore\Model\DataObject\ClassDefinition\Data\Select::__set_state(array(
                                            'fieldtype' => 'select',
                                            'options' =>
                                                array (
                                                    0 =>
                                                        array (
                                                            'key' => 'Garten',
                                                            'value' => 'garten',
                                                        ),
                                                    1 =>
                                                        array (
                                                            'key' => 'Pool',
                                                            'value' => 'pool',
                                                        ),
                                                    2 =>
                                                        array (
                                                            'key' => 'Schwimmteich',
                                                            'value' => 'schwimmteich',
                                                        ),
                                                    3 =>
                                                        array (
                                                            'key' => 'Zubehör',
                                                            'value' => 'zubehoer',
                                                        ),
                                                ),
                                            'width' => '',
                                            'defaultValue' => 'garten',
                                            'optionsProviderClass' => '',
                                            'optionsProviderData' => '',
                                            'queryColumnType' => 'varchar',
                                            'columnType' => 'varchar',
                                            'columnLength' => 190,
                                            'phpdocType' => 'string',
                                            'dynamicOptions' => false,
                                            'name' => 'category',
                                            'title' => 'Kategorie',
                                            'tooltip' => 'Zu welcher Unterseite gehört dieser Teaser?',
                                            'mandatory' => true,
                                            'noteditable' => false,
                                            'index' => false,
                                            'locked' => false,
                                            'style' => '',
                                            'permissions' => NULL,
                                            'datatype' => 'data',
                                            'relationType' => false,
                                            'invisible' => false,
                                            'visibleGridView' => false,
                                            'visibleSearch' => false,
                                            'defaultValueGenerator' => '',
                                        )),
                                    2 =>
                                        Pimcore\Model\DataObject\ClassDefinition\Layout\Text::__set_state(array(
                                            'fieldtype' => 'text',
                                            'html' => '<div class="alert alert-success">ACHTUNG! Wenn kein Link gesetzt ist wird der Teaser nicht ausgegeben!</div>',
                                            'renderingClass' => '',
                                            'renderingData' => '',
                                            'border' => false,
                                            'name' => 'Hinweis-Text',
                                            'type' => NULL,
                                            'region' => NULL,
                                            'title' => '',
                                            'width' => NULL,
                                            'height' => NULL,
                                            'collapsible' => false,
                                            'collapsed' => false,
                                            'bodyStyle' => '',
                                            'datatype' => 'layout',
                                            'permissions' => NULL,
                                            'childs' =>
                                                array (
                                                ),
                                            'locked' => false,
                                        )),
                                    3 =>
                                        Pimcore\Model\DataObject\ClassDefinition\Data\Input::__set_state(array(
                                            'fieldtype' => 'input',
                                            'width' => NULL,
                                            'defaultValue' => NULL,
                                            'queryColumnType' => 'varchar',
                                            'columnType' => 'varchar',
                                            'columnLength' => 190,
                                            'phpdocType' => 'string',
                                            'regex' => '',
                                            'unique' => false,
                                            'showCharCount' => false,
                                            'name' => 'title',
                                            'title' => 'Titel',
                                            'tooltip' => '',
                                            'mandatory' => true,
                                            'noteditable' => false,
                                            'index' => false,
                                            'locked' => false,
                                            'style' => 'color: red;',
                                            'permissions' => NULL,
                                            'datatype' => 'data',
                                            'relationType' => false,
                                            'invisible' => false,
                                            'visibleGridView' => false,
                                            'visibleSearch' => false,
                                            'defaultValueGenerator' => '',
                                        )),
                                    4 =>
                                        Pimcore\Model\DataObject\ClassDefinition\Data\Link::__set_state(array(
                                            'fieldtype' => 'link',
                                            'queryColumnType' => 'text',
                                            'columnType' => 'text',
                                            'phpdocType' => '\\Pimcore\\Model\\DataObject\\Data\\Link',
                                            'name' => 'link',
                                            'title' => 'Link',
                                            'tooltip' => '',
                                            'mandatory' => false,
                                            'noteditable' => false,
                                            'index' => false,
                                            'locked' => false,
                                            'style' => '',
                                            'permissions' => NULL,
                                            'datatype' => 'data',
                                            'relationType' => false,
                                            'invisible' => false,
                                            'visibleGridView' => false,
                                            'visibleSearch' => false,
                                        )),
                                ),
                            'locked' => false,
                            'icon' => '',
                        )),
                ),
            'locked' => false,
            'icon' => NULL,
        )),
    'icon' => '',
    'previewUrl' => '',
    'group' => '',
    'showAppLoggerTab' => false,
    'linkGeneratorReference' => '',
    'compositeIndices' =>
        array (
        ),
    'generateTypeDeclarations' => false,
    'showFieldLookup' => false,
    'propertyVisibility' =>
        array (
            'grid' =>
                array (
                    'id' => true,
                    'key' => false,
                    'path' => true,
                    'published' => true,
                    'modificationDate' => true,
                    'creationDate' => true,
                ),
            'search' =>
                array (
                    'id' => true,
                    'key' => false,
                    'path' => true,
                    'published' => true,
                    'modificationDate' => true,
                    'creationDate' => true,
                ),
        ),
    'enableGridLocking' => false,
    'dao' => NULL,
));
