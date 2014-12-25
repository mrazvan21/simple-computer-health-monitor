<?php

namespace App\Monitoring;

class HostnameMonitoring implements MonitoringInterface
{
    const MONITORING_TYPE = 'hostname';

    public static function getData()
    {
        return array(
            'hostname' => php_uname( 'n' )
        );
    }

} 