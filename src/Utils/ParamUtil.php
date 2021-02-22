<?php

namespace ak\download\Utils;
/**
 * 参数操作
 * Class ParamUtil
 * @package ak\download\Utils
 */
class ParamUtil
{
    /**
     *数据压缩
     * @param array $data
     * @return string
     */
    public static function data2compress(array $data)
    {
        return gzencode(json_encode($data));
    }

    /**
     * 数据解压
     * @param string $params
     * @return array
     */
    public static function data2unCompress(string $params)
    {
        return json_decode(gzdecode($params), true);
    }
}
