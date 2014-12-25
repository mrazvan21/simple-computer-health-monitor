<?php
namespace App\Monitoring;

class CpuInfoMonitoring implements MonitoringInterface
{
    const MONITORING_TYPE = 'cpu-info';

    public static function getData()
    {
        $data = array();
        exec("/usr/bin/lscpu", $result);
        $result = array_filter($result);

        foreach ($result as $info) {
            $p = explode(':', $info);
            $data[$p[0]] = $p[1];
        }

        return $data;
    }
} 