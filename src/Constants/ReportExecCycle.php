<?php

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace ak\download\Constants;

/**
 * 报告执行周期
 * Class ReportExecCycle
 * @package ak\download\Constants
 */
class ReportExecCycle
{
    /**
     * 指定某天执行
     */
    const CYCLE_DAY = 1;
    /**
     * 每周执行
     */
    const CYCLE_WEEK = 2;
    /**
     * 每月执行
     */
    const CYCLE_MONTH = 4;

}
