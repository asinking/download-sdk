<?php

namespace ak\download\Utils;

class SignUtil
{
    /**
     * 计算签名
     * @param array $data 待签名的参数
     * @param string $secret_key 秘钥串
     * @return string
     */
    public static function calculateSign(array $data, string $secret_key)
    {
        ksort($data);
        $stringBuf = '';
        foreach ($data as $k => $v) {
            $stringBuf .= "{$k}={$v}&";
        }
        $string = hash_hmac("sha256", $stringBuf, $secret_key);
        return strtoupper($string);
    }

    /**
     * 验证签名
     * @param array $data 待签名的参数
     * @param string $secret_key 秘钥串
     * @param string $comp_sign  待比较的签名
     * @return bool
     */
    public static function verifySign(array $data, string $secret_key, string $comp_sign)
    {
        $correctSign = self::calculateSign($data, $secret_key);
        return $correctSign == $comp_sign;
    }
}
