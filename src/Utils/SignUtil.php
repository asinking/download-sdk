<?php

namespace asinking\download\Utils;

class SignUtil
{
    /**
     * 计算签名
     * @param array $data
     * @param string $secret_key
     * @return string
     */
    public static function calculateSign(array $data,string $secret_key)
    {
        $data = $data ?? [];
        ksort($data);
        $buff = '';
        foreach ($data as $k => $v) {
            $buff .= "{$k}={$v}&";
        }
        return strtoupper(md5("{$buff}key={$secret_key}"));
    }
}
