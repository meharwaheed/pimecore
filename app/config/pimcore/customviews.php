<?php

return [
    "views" => [
        [
            "treetype" => "document",
            "name" => "biegert-garten.de",
            "icon" => "/bundles/pimcoreadmin/img/flat-color-icons/reading.svg",
            "id" => 1,
            "rootfolder" => "/de",
            "showroot" => TRUE,
            "classes" => "",
            "position" => "left",
            "sort" => "-12",
            "expanded" => TRUE,
            "having" => "",
            "joins" => "",
            "where" => "(type = 'folder' OR (type = 'page' and `key` NOT LIKE '%g%' OR type = 'link'))"
        ]
    ]
];