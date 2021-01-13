<?php

namespace ak\download\Report;

use ak\download\Constants\Constant;
use ak\download\Utils\CurlUtil;
use ak\download\Utils\SignUtil;

class AbstractReport implements IReport
{
    /**
     * 访问域名
     * @var string
     */
    public $domain = "http://172.18.1.30:9507";
    /**
     * 应用环境appid
     * @var string
     */
    public $appId = '6E007E3mB=';
    /**
     * 签名秘钥串
     * @var string
     */
    public $appSecret = '676af546fe80e75b399b00aff8a018a6';

    /**
     * 创建报表任务
     * @param array $params
     * @return array
     */
    function createReport(array $params): array
    {
        $sign = SignUtil::calculateSign($params, $this->appSecret);
        $result = CurlUtil::post($this->domain . Constant::URL_CREATE_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . time(),
        ));
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 创建定时报表任务
     * @param array $params
     * @return array
     */
    function createTimerReport(array $params): array
    {
        $sign = SignUtil::calculateSign($params, $this->appSecret);
        $result = CurlUtil::post($this->domain . Constant::URL_CREATE_TIMER_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . time(),
        ));
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 获取报表数据列表
     * @param array $params
     * @return array
     */
    function getReportDataList(array $params): array
    {
        $sign = SignUtil::calculateSign($params, $this->appSecret);
        $result = CurlUtil::get($this->domain . Constant::URL_CREATE_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . time(),
        ));
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 编辑定时报表任务
     * @param array $params
     * @return mixed
     */
    function editTimerReport(array $params): array
    {
        $sign = SignUtil::calculateSign($params, $this->appSecret);
        $result = CurlUtil::post($this->domain . Constant::URL_EDIT_TIMER_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . time(),
        ));
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 订阅报表状态
     * @param array $params
     * @return array
     */
    function subscribe(array $params): array
    {
        $sign = SignUtil::calculateSign($params, $this->appSecret);
        $result = CurlUtil::post($this->domain . Constant::URL_REPORT_SUBSCRIBE, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . time(),
        ));
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 取消订阅报表状态
     * @param array $params
     * @return array
     */
    function unSubscribe(array $params): array
    {
        $sign = SignUtil::calculateSign($params, $this->appSecret);
        $result = CurlUtil::post($this->domain . Constant::URL_REPORT_UNSUBSCRIBE, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . time(),
        ));
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 重试报表导出
     * @param array $params
     * @return array
     */
    function retryReportExport(array $params): array
    {
        return ['code' => -1, 'msg' => 'no support'];
    }

    /**
     * 获取条件分组列表
     * @param array $params
     * @return array
     */
    function getConditionGroupList(array $params): array
    {
        return ['code' => -1, 'msg' => 'no support'];
    }

}
