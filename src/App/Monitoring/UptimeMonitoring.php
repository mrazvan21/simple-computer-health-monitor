<?php

namespace App\Monitoring;

class UptimeMonitoring implements MonitoringInterface
{
    const MONITORING_TYPE = 'uptime';

    public static function getData()
    {
        $uptime = explode( '.', file_get_contents( '/proc/uptime' ) );
        $totalSeconds = $uptime[ 0 ];
        $totalMinutes = $totalSeconds / 60;
        $totalHours = $totalMinutes / 60;
        $days = floor( $totalHours / 24 );
        $hours = floor( $totalHours - ( $days * 24 ) );
        $minutes = floor( $totalMinutes - ( $days * 60 * 24 ) - ( $hours * 60 ) );
        $formatUptime = '';
        if( 0 != $days ){
            $formatUptime .= $days . ' day' . ( ( 1 < $days ) ? 's' : '' ) . ' ';
        }
        if( 0 != $hours ){
            $formatUptime .= $hours . ' hour' . ( ( 1 < $hours ) ? 's' : '' ) . ' ';
        }
        if( 0 != $minutes ){
            $formatUptime .= $minutes . ' minute' . ( ( 1 < $minutes ) ? 's' : '' ) . ' ';
        }
        return array(
            'uptime' => $formatUptime
        );
    }
} 