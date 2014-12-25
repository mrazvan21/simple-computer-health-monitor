<?php

namespace App\Monitoring;

class CurrentRamMonitoring implements MonitoringInterface
{
    const MONITORING_TYPE = 'current-ram';

    public static function getData()
    {
        exec(
            '/usr/bin/free -tmo | /usr/bin/awk \'BEGIN {OFS=","} {print $1,$2,$3-$6-$7,$4+$6+$7}\'',
            $result
        );
        return explode(',', $result[1]);
    }
} 