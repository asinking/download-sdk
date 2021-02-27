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
     * 连接超时时间
     * @var int
     */
    public $connect_timeout = 10;
    /**
     * 接收缓冲数据等待时间
     * @var int
     */
    public $curlopt_timeout = 60;

    /**
     * 创建报表任务
     * @param array $params
     * @return array
     */
    function createReport(array $params): array
    {
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_CREATE_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . $timestamp,
        ), $this->connect_timeout, $this->curlopt_timeout);
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
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_CREATE_TIMER_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . $timestamp,
        ), $this->connect_timeout, $this->curlopt_timeout);
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 获取报表数据列表
     * @param array $params
     * @return array
     */
    function getReportData(array $params): array
    {
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_GET_REPORT_DATA, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . $timestamp,
        ), $this->connect_timeout, $this->curlopt_timeout);
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 获取定时任务报告
     * @param array $params
     * @return mixed
     */
    function getTimerTaskReport(array $params): array
    {
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_GET_TIMER_TASK_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . $timestamp,
        ), $this->connect_timeout, $this->curlopt_timeout);
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 编辑定时报表任务
     * @param array $params
     * @return mixed
     */
    function editTimerTaskReport(array $params): array
    {
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_EDIT_TIMER_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . $timestamp,
        ), $this->connect_timeout, $this->curlopt_timeout);
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
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_REPORT_SUBSCRIBE, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . $timestamp,
        ), $this->connect_timeout, $this->curlopt_timeout);
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
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_REPORT_UNSUBSCRIBE, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' .$timestamp,
        ), $this->connect_timeout, $this->curlopt_timeout);
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
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_RETRY_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' . $timestamp
        ), $this->connect_timeout, $this->curlopt_timeout);
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 删除报表
     * @param array $params
     * @return array
     */
    function delReport(array $params): array
    {
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_DEL_REPORT, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' .$timestamp,
        ), $this->connect_timeout, $this->curlopt_timeout);
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }

    /**
     * 获取分组查询条件
     * @param array $params
     * @return array
     */
    function getReportTaskGroup(array $params): array
    {
        $timestamp= time();
        $sign = SignUtil::calculateSign($params, $this->appId, $this->appSecret,$timestamp);
        $result = CurlUtil::post($this->domain . Constant::URL_GET_REPORT_TASK_GROUP, $params, array(
            'Asink-Appid:' . $this->appId,
            'Asink-Sign:' . $sign,
            'Asink-Time:' .$timestamp
        ), $this->connect_timeout, $this->curlopt_timeout);
        if (!$result['code']) return ['code' => -1, 'msg' => $result['content']];
        return json_decode($result['content'], true);
    }


}
