<?php

namespace ak\download\Constants;

/**
 * 公共常量
 * Class Constant
 * @package ak\download\Constants
 */
class Constant
{
    /**
     * 创建报表任务
     */
    const URL_CREATE_REPORT = '/v1/report/createReport';
    /**
     * 创建定时报表任务
     */
    const URL_CREATE_TIMER_REPORT = '/v1/report/createTimerReport';
    /**
     * 编辑定时报表任务
     */
    const URL_EDIT_TIMER_REPORT = '/v1/report/editTimerReport';
    /**
     * 重试导出报表
     */
    const URL_RETRY_REPORT = '/v1/report/retryReportExport';
    /**
     * 删除报表
     */
    const URL_DEL_REPORT = '/v1/report/delReport';
    /**
     * 获取所有报表任务分组
     */
    const URL_GET_ALL_TASKGROUP = '/v1/report/getAllTaskGroup';

    /**
     * 获取报告列表
     */
    const URL_GET_REPORT_DATA_LIST = '/v1/report/getReportDataList';

    /**
     * 订阅报表状态
     */
    const URL_REPORT_SUBSCRIBE = '/v1/subscribe/subscribe';
    /**
     * 取消报表订阅
     */
    const URL_REPORT_UNSUBSCRIBE = '/v1/subscribe/unSubscribe';
}
