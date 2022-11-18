<?php


namespace QSoft\Helper;


use Bitrix\Highloadblock\HighloadBlockTable;

class ColorHelper
{

    const CACHE_TTL = 86400; // 24 hours

    public static function loadColorReference(): array
    {
        $cacheId = md5('color_reference');
        $cache = \Bitrix\Main\Application::getInstance()->getCache();
        if($cache->initCache(self::CACHE_TTL, $cacheId))
        {
            return $cache->getVars();
        } else {
            $cache->startDataCache();
            $hlBlock = HighloadBlockTable::getRow([
                'filter' => [
                    '=ID' => HIGHLOAD_BLOCK_COLORREFERENCE
                ]
            ]);
            $entityManager = HighloadBlockTable::compileEntity($hlBlock)->getDataClass();
            $result = $entityManager::getList()->fetchAll();

            if (!empty($result)) {
                $cache->endDataCache($result);
            } else {
                $cache->abortDataCache();
                $result = [];
            }

            return $result;
        }
    }

    public static function getColorNames(): array
    {
        $data = self::loadColorReference();
        $colorNames = [];
        foreach ($data as $item) {
            $colorNames[$item['UF_XML_ID']] = $item['UF_NAME'];
        }
        return $colorNames;
    }

    public static function getTable()
    {
        $hlblock = HighloadBlockTable::getById(HIGHLOAD_BLOCK_COLORREFERENCE)->fetch();
        $entity = HighloadBlockTable::compileEntity($hlblock);
        return $entity->getDataClass();
    }
}