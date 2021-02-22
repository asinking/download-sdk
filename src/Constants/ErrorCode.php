<?php
namespace ak\download\Constants;
/**
 * 异常枚举类
 * method static getMessage($errorCode)
 */
class ErrorCode
{
    /**
     * @Message("无效签名")
     */
    const SIGN_INVALID_ERROR = 20001;
    /**
     * @Message("签名已过期或失效")
     */
    const SIGN_EXPIRE = 20002;

    /** @var string[] 错误码对应消息映射 */
    protected static $errorMsgAlias = [
        self::SIGN_INVALID_ERROR => '无效签名',
        self::SIGN_EXPIRE => '签名已过期或失效',
    ];

    /**
     * 获取错误码信息
     * @param $code
     *
     * @return string
     */
    public static function getMessage($code)
    {
        if (key_exists($code, self::$errorMsgAlias)) {
            return self::$errorMsgAlias[$code];
        }
        return 'unknown error message';
    }
}
