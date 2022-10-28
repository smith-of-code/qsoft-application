<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SPOL_SORT_TEMPLATE_NAME"),
	"DESCRIPTION" => GetMessage("SPOL_SORT_DESCRIPTION"),
	"ICON" => "/images/sale_order_tbl.gif",
	"PATH" => array(
		"ID" => "e-store",
		"CHILD" => array(
			"ID" => "sale_personal_sort",
			"NAME" => GetMessage("SPOL_SORT_NAME")
		)
	),
);
?>