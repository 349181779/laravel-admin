<?php
namespace Qiniu\Storage;

use Qiniu\Config;
use Qiniu\Http\Client;
use Qiniu\Http\Error;

final class FormUploader
{
    public static function put(
        $upToken,
        $key,
        $data,
        $config,
        $params,
        $mime,
        $checkCrc
    ) {
        $fields = array('token' => $upToken);
        if ($key === null) {
            $fname = 'filename';
        } else {
            $fname = $key;
            $fields['key'] = $key;
        }
        if ($checkCrc) {
            $fields['crc32'] = \Qiniu\crc32_data($data);
        }
        if ($params) {
            foreach ($params as $k => $v) {
                $fields[$k] = $v;
            }
        }

<<<<<<< HEAD
        $response = Client::multipartPost($config->getUpHost(), $fields, 'file', $fname, $data, $mime);
        if (!$response->ok()) {
            return array(null, new Error($config->getUpHost(), $response));
=======
        $response = Client::multipartPost($config::$upHost, $fields, 'file', $fname, $data, $mime);
        if (!$response->ok()) {
            return array(null, new Error($config::$upHost, $response));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        }
        return array($response->json(), null);
    }

    public static function putFile(
        $upToken,
        $key,
        $filePath,
        $config,
        $params,
        $mime,
        $checkCrc
    ) {

        $fields = array('token' => $upToken, 'file' => self::createFile($filePath, $mime));
        if ($key === null) {
            $fname = 'filename';
        } else {
            $fname = $key;
            $fields['key'] = $key;
        }
        if ($checkCrc) {
            $fields['crc32'] = \Qiniu\crc32_file($filePath);
        }
        if ($params) {
            foreach ($params as $k => $v) {
                $fields[$k] = $v;
            }
        }
        $headers =array('Content-Type' => 'multipart/form-data');
<<<<<<< HEAD
        $response = client::post($config->getUpHost(), $fields, $headers);
        if (!$response->ok()) {
            return array(null, new Error($config->getUpHost(), $response));
=======
        $response = client::post($config::$upHost, $fields, $headers);
        if (!$response->ok()) {
            return array(null, new Error($config::$upHost, $response));
>>>>>>> 705d3246d2b96a483f40bf87e0cc15b93106fad1
        }
        return array($response->json(), null);
    }

    private static function createFile($filename, $mime)
    {
        // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
        // See: https://wiki.php.net/rfc/curl-file-upload
        if (function_exists('curl_file_create')) {
            return curl_file_create($filename, $mime);
        }

        // Use the old style if using an older version of PHP
        $value = "@{$filename}";
        if (!empty($mime)) {
            $value .= ';type=' . $mime;
        }

        return $value;
    }
}
