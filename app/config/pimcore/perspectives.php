<?php

return [
    "default" => [
        "iconCls" => "pimcore_nav_icon_perspective",
        "elementTree" => [
            [
                "type" => "documents",
                "position" => "left",
                "expanded" => false,
                "hidden" => false,
                "sort" => -3
            ],
            [
                "type" => "assets",
                "position" => "left",
                "expanded" => false,
                "hidden" => false,
                "sort" => -2
            ],
            [
                "type" => "objects",
                "position" => "left",
                "expanded" => false,
                "hidden" => false,
                "sort" => -1
            ]
        ],
        "dashboards" => [
            "predefined" => [
                "welcome" => [
                    "positions" => [
                        [
                            [
                                "id" => 1,
                                "type" => "pimcore.layout.portlets.modificationStatistic",
                                "config" => null
                            ],
                            [
                                "id" => 2,
                                "type" => "pimcore.layout.portlets.modifiedAssets",
                                "config" => null
                            ],
                        ],
                        [
                            [
                                "id" => 3,
                                "type" => "pimcore.layout.portlets.modifiedObjects",
                                "config" => null
                            ],
                            [
                                "id" => 4,
                                "type" => "pimcore.layout.portlets.modifiedDocuments",
                                "config" => null
                            ]
                        ]
                    ],
                ]
            ]
        ]
    ],

    "Biegert" => [
        "iconCls" => "pimcore_nav_icon_object",
        "toolbar" => [
            "file" => 1
            ,
            "extras" => [
                "hidden" => true
            ],
            "marketing" => [
                "hidden" => true
            ],
            "settings" => [
                "items" => [
                    "documentTypes" => false,
                    "predefinedProperties" => false,
                    "predefinedMetadata" => false,
                    "system" => false,
                    "routes" => false,
                    "thumbnails" => false,
                    "adminTranslations" => false,
                    "website" => false,
                    "users" => false,
                    "cache" => false
                ]
            ],
            "search" => [
                "items" => [
                    "documents" => false,
                    "esBackendSearch" => false
                ]
            ],
            "ecommerce" => false
        ],
        "elementTree" => [
            [
                "type" => "documents",
                "position" => "left",
                "expanded" => false,
                "hidden" => true,
                "sort" => -3
            ],
            [
                "type" => "objects",
                "position" => "left",
                "expanded" => false,
                "hidden" => false,
                "sort" => -1
            ],
            [
                "type" => "customview",
                "id" => 1,
                "hidden" => false,
                "position" => "left",
                "sort" => -5
            ],
            [
                "type" => "assets",
                "position" => "left",
                "expanded" => false,
                "hidden" => false,
                "sort" => 3
            ],
        ],
    ]
];