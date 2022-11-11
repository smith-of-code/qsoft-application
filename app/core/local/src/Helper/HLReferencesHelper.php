<?php


namespace QSoft\Helper;


use Bitrix\Highloadblock\HighloadBlockTable;

class HLReferencesHelper
{
    const CACHE_TTL = 86400; // 24 hours
    const CACHE_NAME_COLORS = 'color_reference';
    const CACHE_NAME_SIZES = 'size_reference';

    public static function getSizeNames(): array
    {
        $data = self::loadReference(self::CACHE_NAME_SIZES, HIGHLOAD_BLOCK_HLSIZES);

        return self::formatData($data);
    }

    public static function getColorNames(): array
    {
        $data = self::loadReference(self::CACHE_NAME_COLORS, HIGHLOAD_BLOCK_COLORREFERENCE);

        return self::formatData($data);
    }

    public static function loadReference($cacheName, $hlId)
    {
        $cacheId = md5($cacheName);
        $cache = \Bitrix\Main\Application::getInstance()->getCache();
        if($cache->initCache(self::CACHE_TTL, $cacheId))
        {
            return $cache->getVars();
        } else {
            $cache->startDataCache();
            $hlBlock = HighloadBlockTable::getRow([
                'filter' => [
                    '=ID' => $hlId
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

    private static function formatData($data)
    {
        $result = [];
        foreach ($data as $item) {
            $result[$item['UF_XML_ID']] = $item['UF_NAME'];
        }

        return $result;
    }
}