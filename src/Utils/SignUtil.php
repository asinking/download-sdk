<?php

namespace ak\download\Utils;

class SignUtil
{
    /**
     * 计算签名
     * @param array $data   待发送的数据
     * @param string $secret_key  秘钥串
     * @return string
     */
    public static function calculateSign(array $data,string $secret_key)
    {
        ksort($data);
        $stringBuf = '';
        foreach ($data as $k => $v) {
            $stringBuf .= "{$k}={$v}&";
        }
        $string = hash_hmac("sha256", $stringBuf, $secret_key);
        return strtoupper($string);
    }
}
