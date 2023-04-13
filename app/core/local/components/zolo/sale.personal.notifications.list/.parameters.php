<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = [
	"GROUPS" => [
        "ONLY_UNREAD" => [
            "NAME" => GetMessage("ONLY_ACTIVE"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ],
        "LIMIT_COUNT_BY_PAGE" => [
            "NAME" => GetMessage("LIMIT_COUNT_BY_PAGE"),
            "TYPE" => "STRING",
            "DEFAULT" => "0",
        ]
    ]
];
