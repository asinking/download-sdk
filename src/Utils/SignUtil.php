<?php

namespace ak\download\Utils;

class SignUtil
{
    /**
     * 计算签名
     * @param array $params 原始参数
     * @param string $appid 应用ID
     * @param string $secretKey 秘钥串
     * @param int $timestamp 签名时间戳
     * @return string
     */
    public static function calculateSign(array $params, string $appid, string $secretKey, int $timestamp = null)
    {
        /* if (!isset($data['sign_timestamp'])) $params['sign_timestamp'] = time();
         ksort($params);
         $stringBuf = '';
         foreach ($params as $k => $v) {
             $stringBuf .= "{$k}={$v}&";
         }
         $string = hash_hmac("sha256", $stringBuf, $secretKey);
         #时间戳整合到签名中
         $signSignTimestamp = str_pad(CommonUtil::decb64($params['sign_timestamp']), 6, "0", STR_PAD_LEFT);
         return strtoupper($string) . $signSignTimestamp;*/
        //引入公共签名
        return \Ak\Encrypt\Facades\AkEncrypt::generateSign($params, $appid, $secretKey,$timestamp);
    }

    /**
     * 验证签名
     * @param array $params
     * @param string $appid
     * @param string $secretKey
     * @param int $timestamp
     * @param string $compSign
     * @return bool
     * @throws \Ak\Encrypt\Exceptions\AkEncryptException
     */
    public static function verifySign(array $params, string $appid, string $secretKey, int $timestamp, string $compSign)
    {
        /*f (empty($compSign) || strlen($compSign) <= 6) throw new SignException(null, ErrorCode::INVALID_SIGN_ERROR);
         $timeStamp = CommonUtil::b64dec(substr($compSign, -6));
         if (abs(time() - $timeStamp) > 60) throw new SignException(null, ErrorCode::INVALID_SIGN_EXPIRE);
         if (!isset($params['sign_timestamp'])) $params['sign_timestamp'] = $timeStamp;
         $correctSign = self::calculateSign($params, $secret_key);
         return $correctSign == $compSign;*/
        return \Ak\Encrypt\Facades\AkEncrypt::validateSign($params, $appid, $secretKey, $timestamp, $compSign, 60);
    }
}
