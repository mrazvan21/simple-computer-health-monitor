<?php

namespace App\Monitoring;

class IssueMonitoring implements MonitoringInterface
{
    const MONITORING_TYPE = 'issue';

    public static function getData()
    {
        return array(
            'issue' => shell_exec('/usr/bin/lsb_release -ds;/bin/uname -r')
        );
    }

} 