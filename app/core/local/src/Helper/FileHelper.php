<?php

namespace QSoft\Helper;

use CFile;

class FileHelper
{
    public static function getFileArray(int $fileId): array
    {
        $result = CFile::GetFileArray($fileId);

        return [
            'src' => $result['SRC'],
            'name' => implode('.',array_splice(@($tmp=explode('.',$result['ORIGINAL_NAME'])),0, count($tmp) - 1)),
            'filename' => $result['ORIGINAL_NAME'],
            'size' => filesizeFormat($result['FILE_SIZE']),
        ];
    }
}