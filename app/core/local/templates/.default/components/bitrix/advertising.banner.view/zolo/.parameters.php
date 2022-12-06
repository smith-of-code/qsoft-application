<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!CModule::IncludeModule("advertising"))
	return;

$arTemplateParameters = array(
	"PARAMETERS" => array(
		"BACKGROUND" => Array(
			"NAME" => GetMessage("ADV_BS_PARAMETER_BACKGROUND"),
			"TYPE" => "LIST",
			"VALUES" => array(
				'' => GetMessage("ADV_BS_PARAMETER_NO"),
				'image' => GetMessage("ADV_BS_PARAMETER_BACKGROUND_IMAGE"),
			),
			"REFRESH" => 'Y',
			"SORT" => 10
		)
	)
);
if ($arCurrentValues['BACKGROUND'] == 'image')
{
	$arTemplateParameters["PARAMETERS"]["IMG"] = Array(
		"NAME" => GetMessage("ADV_BS_PARAMETER_IMG"),
		"TYPE" => "IMAGE",
		"DEFAULT" => "Y",
		"SORT" => 20
	);
    $arTemplateParameters["PARAMETERS"]["IMG_MOBILE"] = Array(
        "NAME" => GetMessage("ADV_BS_PARAMETER_IMG_MOBILE"),
        "TYPE" => "IMAGE",
        "DEFAULT" => "Y",
        "SORT" => 21
    );
    $arTemplateParameters["PARAMETERS"]["IMG_TABLET"] = Array(
        "NAME" => GetMessage("ADV_BS_PARAMETER_IMG_TABLET"),
        "TYPE" => "IMAGE",
        "DEFAULT" => "Y",
        "SORT" => 22
    );
}

if ($arCurrentValues['EXTENDED_MODE'] == 'N')
{
	$arTemplateParameters["PARAMETERS"]["HEADING_SHOW"] = Array(
		"NAME" => GetMessage("ADV_BS_PARAMETER_HEADING_SHOW"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"REFRESH" => 'Y',
		"SORT" => 80
	);
	if ($arCurrentValues['HEADING_SHOW'] == 'Y')
	{
		$arTemplateParameters["PARAMETERS"]["HEADING"] = Array(
			"NAME" => GetMessage("ADV_BS_PARAMETER_HEADING_TEXT"),
			"TYPE" => "STRING",
			"ROWS" => "4",
			"COLS" => "49",
			"DEFAULT" => GetMessage("ADV_BS_PARAMETER_HEADING"),
			"SORT" => 90
		);
	}
	$arTemplateParameters["PARAMETERS"]["ANNOUNCEMENT_SHOW"] = Array(
		"NAME" => GetMessage("ADV_BS_PARAMETER_ANNOUNCEMENT_SHOW"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
		"REFRESH" => 'Y',
		"SORT" => 170
	);
	if ($arCurrentValues['ANNOUNCEMENT_SHOW'] == 'Y')
	{
		$arTemplateParameters["PARAMETERS"]["ANNOUNCEMENT"] = Array(
			"NAME" => GetMessage("ADV_BS_PARAMETER_ANNOUNCEMENT_TEXT"),
			"TYPE" => "STRING",
			"ROWS" => "4",
			"COLS" => "49",
			"DEFAULT" => GetMessage("ADV_BS_PARAMETER_ANNOUNCEMENT"),
			"SORT" => 180
		);
	}

    $arTemplateParameters["PARAMETERS"]["SALE"] = Array(
        "NAME" => GetMessage("ADV_BS_PARAMETER_SALE_TEXT"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "SORT" => 200,
    );

    $arTemplateParameters["PARAMETERS"]["LINK"] = Array(
        "NAME" => GetMessage("ADV_BS_PARAMETER_LINK"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
        "SORT" => 220,
    );
}