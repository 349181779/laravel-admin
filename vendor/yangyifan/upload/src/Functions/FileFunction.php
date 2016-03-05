<?php

// +----------------------------------------------------------------------
// | date: 2016-03-04
// +----------------------------------------------------------------------
// | FileFunction.php: 文件相关方法
// +----------------------------------------------------------------------
// | Author: yangyifan <yangyifanphp@gmail.com>
// +----------------------------------------------------------------------

namespace Yangyifan\Upload\Functions;


class FileFunction
{

    /**
     * 获得文件mime_type
     *
     * @param $file
     * @return bool|mixed
     * @author yangyifan <yangyifanphp@gmail.com>
     */
    public static function getFileMimeType($file)
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo) {
            return finfo_file($finfo, $file);
        }
        return false;
    }
}