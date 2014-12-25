<?php
namespace App\Monitoring;

class CpuInfoMonitoring implements MonitoringInterface
{
    const MONITORING_TYPE = 'cpu-info';

    public static function getData()
    {
        $interfacePath = 'ls /sys/class/net';
        $interfaces = explode("\n", shell_exec($interfacePath));
        array_pop($interfaces);
        $key = array_search("lo", $interfaces);
        unset($interfaces[$key]);
        $data = array();
        sleep(5);
        foreach ($interfaces as $interface) {
            $txPath = "cat /sys/class/net/{$interface}/statistics/tx_bytes";
            $rxPath = "cat /sys/class/net/{$interface}/statistics/rx_bytes";
            $txStart = intval(shell_exec($txPath));
            $rxStart = intval(shell_exec($rxPath));
            sleep(2);
            $txEnd = intval(shell_exec($txPath));
            $rxEnd = intval(shell_exec($rxPath));
            $result = array();
            $result['interface'] = $interface;
            $result['tx'] = ($txEnd - $txStart);
            $result['rx'] = ($rxEnd - $rxStart);
            $data[] = $result;
        }

        return $data;
    }
} 