<?php
namespace ak\download\Exception;
use ak\download\Constants\ErrorCode;

/**
 * 签名异常类
 * Class SignException
 * @package ak\download\Exception
 */
class SignException extends \Exception
{
    public function __construct($message = null, $code = 0)
    {
        if (is_null($message)) {
            $message = ErrorCode::getMessage($code);
        }
        parent::__construct($message, $code);
    }
}
