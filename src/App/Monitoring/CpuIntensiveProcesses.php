<?php

namespace App\Monitoring;

class CpuIntensiveProcesses implements MonitoringInterface
{
    const MONITORING_TYPE = 'cpu-intensive-processes';

    public static function getData()
    {
        exec(
            '/bin/ps axo pid,user,comm,pcpu,rss,vsz --sort -pcpu,-rss,-vsz | head -n 15 | /usr/bin/awk ' .
            "'{print ".
            '$1","$2","$3","$4","$5","$6}'.
            "'",
            $result
        );
        $data = array();
        $x = 0;
        foreach ($result as $a) {
            $temp = explode(',', $result[$x]);
            $data[] = array(
                'pid' => $temp[0],
                'user' => $temp[1],
                'command' => $temp[2],
                'per' => $temp[3],
                'rss' => $temp[4],
                'vsz' => $temp[5],
            );
            unset($result[$x],$a);
            $x++;
        }
        array_shift($data); // remove header row
        return $data;
    }

} 