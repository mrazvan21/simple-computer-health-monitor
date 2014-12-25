<?php

namespace App\Monitoring;

class TimeMonitoring implements MonitoringInterface
{
    const MONITORING_TYPE = 'time';

    public static function getData()
    {
        return array(
            'time' => shell_exec('/bin/date')
        );
    }
} 