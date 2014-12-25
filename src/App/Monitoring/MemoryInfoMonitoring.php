<?php

namespace App\Monitoring;

class MemoryInfoMonitoring implements MonitoringInterface
{
    const MONITORING_TYPE = 'memory-info';

    public static function getData()
    {
        $data = array();
        exec(
            "/bin/cat /proc/meminfo",
            $result
        );
        foreach ($result as $a) {
            $p = explode(':', $a);
            if(substr($p[1], -2) === 'kB') {
                $number = intval(substr($p[1], 0, -2));
                $numberFormatted = number_format($number);
                $numberFormattedWithUnits = (string)$numberFormatted . ' kB';
                $p[1] = $numberFormattedWithUnits;
            }
            $data[$p[0]] = $p[1];
        }
        return $data;
    }
} 