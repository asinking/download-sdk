<?php

namespace asinking\download\Report;

interface IReport
{
    /**
     * 创建报表任务
     * @param array $params
     * @return mixed
     */
    function createReport(array $params): array;

    /**
     *获取报表数据列表
     * @param array $params
     * @return mixed
     */
    function getReportDataList(array $params): array;

    /**
     * 编辑定时报表任务
     * @param array $params
     * @return mixed
     */
    function editTimerReport(array $params): array;

}