<?php

namespace ak\download\Report;

interface IReport
{
    /**
     * 创建报表任务
     * @param array $params
     * @return mixed
     */
    function createReport(array $params): array;

    /**
     * 创建定时报表任务
     * @param array $params
     * @return array
     */
    function createTimerReport(array $params): array;

    /**
     *获取报表数据列表
     * @param array $params
     * @return mixed
     */
    function getReportData(array $params): array;

    /**
     * 获取定时任务报告
     * @return array
     */
    function getTimerTaskReport(array $params): array;

    /**
     * 编辑定时报表任务
     * @param array $params
     * @return mixed
     */
    function editTimerTaskReport(array $params): array;

    /**
     * 订阅报表状态【当有新建报表任务时，会下发通知】
     * @param array $params
     * @return array
     */
    function subscribe(array $params): array;

    /**
     * 取消订阅报表状态
     * @param array $params
     * @return array
     */
    function unSubscribe(array $params): array;

    /**
     * 重试报表导出
     * @param array $params
     * @return array
     */
    function retryReportExport(array $params): array;

    /**
     * 删除报表操作
     * @param array $params
     * @return array
     */
    function delReport(array $params): array;

    /**
     * 获取报告任务分组
     * @param array $params
     * @return array
     */
    function getReportTaskGroup(array $params): array;

    /**
     * 获取下载资源
     * @param array $params
     * @return array
     */
    function downloadResource(array $params): array;
}