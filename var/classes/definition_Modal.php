<?php

/**
 * Inheritance: no
 * Variants: no


Fields Summary:
- localizedfields [localizedfields]
-- headline [input]
-- wysiwyg [wysiwyg]
 */


return Pimcore\Model\DataObject\ClassDefinition::__set_state(array(
    'id' => '2',
    'name' => 'Modal',
    'description' => '',
    'creationDate' => 0,
    'modificationDate' => 1606402964,
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
                                        Pimcore\Model\DataObject\ClassDefinition\Data\Localizedfields::__set_state(array(
                                            'fieldtype' => 'localizedfields',
                                            'phpdocType' => '\\Pimcore\\Model\\DataObject\\Localizedfield',
                                            'childs' =>
                                                array (
                                                    0 =>
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
                                                            'name' => 'headline',
                                                            'title' => 'H2',
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
                                                            'defaultValueGenerator' => '',
                                                        )),
                                                    1 =>
                                                        Pimcore\Model\DataObject\ClassDefinition\Data\Wysiwyg::__set_state(array(
                                                            'fieldtype' => 'wysiwyg',
                                                            'width' => '',
                                                            'height' => '',
                                                            'queryColumnType' => 'longtext',
                                                            'columnType' => 'longtext',
                                                            'phpdocType' => 'string',
                                                            'toolbarConfig' => '',
                                                            'excludeFromSearchIndex' => false,
                                                            'name' => 'wysiwyg',
                                                            'title' => 'Text',
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
                                                ),
                                            'name' => 'localizedfields',
                                            'region' => NULL,
                                            'layout' => NULL,
                                            'title' => '',
                                            'width' => '',
                                            'height' => '',
                                            'maxTabs' => NULL,
                                            'labelWidth' => NULL,
                                            'border' => false,
                                            'provideSplitView' => true,
                                            'tabPosition' => NULL,
                                            'hideLabelsWhenTabsReached' => NULL,
                                            'referencedFields' =>
                                                array (
                                                ),
                                            'tooltip' => NULL,
                                            'mandatory' => NULL,
                                            'noteditable' => NULL,
                                            'index' => NULL,
                                            'locked' => NULL,
                                            'style' => NULL,
                                            'permissions' => NULL,
                                            'datatype' => 'data',
                                            'relationType' => false,
                                            'invisible' => false,
                                            'visibleGridView' => true,
                                            'visibleSearch' => true,
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
