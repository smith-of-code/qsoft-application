<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var object $component
 */

if(property_exists($component, 'arResultCacheKeys')) {
    if(!is_array($component->arResultCacheKeys)) {
        $component->arResultCacheKeys = array();
    }
    $sVarName = 'arResult';
    $component->arResultCacheKeys[] = $sVarName;
    $component->arResult[$sVarName] = $$sVarName;
}
