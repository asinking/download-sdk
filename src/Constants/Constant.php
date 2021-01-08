<?php

namespace ak\download\Constants;

/**
 * 公共常量
 * Class Constant
 * @package asinking\download\Constants
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
     * 获取报告列表
     */
    const URL_GET_REPORT_DATA_LIST = '/v1/report/getReportDataList';

}
