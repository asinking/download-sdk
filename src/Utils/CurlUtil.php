<?php

namespace ak\download\Utils;

class CurlUtil
{
    /**
     * API接口请求
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $header
     * @param int $timeout
     * @return bool|string
     */
    public static function request(string $method, string $url, array $data = [], array $header = [], int $timeout = 60)
    {
        if ($method == "POST") return self::post($url, $data, $header, $timeout);
        else return self::get($url, $data, $header, $timeout);
    }

    /**
     * @param $url
     * @param array $data
     * @param array $header
     * @param int $timeout
     * @return bool|string
     */
    public static function get($url, $data = [], $header = [], $timeout = 60)
    {
        if (!empty($data)) {
            $url .= (stripos($url, '?') === false ? '?' : '&');
            $url .= (is_array($data) ? http_build_query($data) : $data);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1);              // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        //设置header头
        if (!empty($header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);//设置头部
        }
        $content=curl_exec($curl);
        $status=curl_getinfo($curl);
        curl_close($curl);
//        [$content, $status] = [curl_exec($curl), curl_getinfo($curl), curl_close($curl)];
        $bool = intval($status["http_code"]) === 200;
//        if ($bool) LogUtil::info("api request [success]url:{{$url}}");
//        else LogUtil::error("[GET]api request [fail]url:{{$url}},err:" . curl_error($curl) . ",content:{{$content}}");
        return $bool ? $content : false;
    }

    /**
     * @param $url
     * @param array $data
     * @param array $header
     * @param int $timeout
     * @return bool|string
     */
    public static function post($url, $data = [], $header = [], $timeout = 60)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60); // 设置超时限制防止死循环
        //设置发起连接前的等待时间，如果设置为0，则无限等待。
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//跳过证书检查，访问htpps需要设置此项
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);//设置CURLOPT_PORT 跟表单提交一样
        curl_setopt($curl, CURLOPT_NOSIGNAL, 1);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF8");
        if (!empty($header)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);//设置头部
        }
        //设置支持跳转
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $content=curl_exec($curl);
        $status=curl_getinfo($curl);
        curl_close($curl);
//        [$content, $status] = [curl_exec($curl), curl_getinfo($curl), curl_close($curl)];
        $bool = intval($status["http_code"]) === 200;
//        if ($bool) LogUtil::info("api request [success]url:{{$url}}");
//        else LogUtil::error("[POST]api request [fail]url:{{$url}},err:" . curl_error($curl) . ",content:{{$content}}");
        return $bool ? $content : false;
    }
}
