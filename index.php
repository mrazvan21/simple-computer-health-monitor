<?php

require 'vendor/autoload.php';

use Slim\Slim;

$app = new Slim();

$response = new \App\Response($app);
$response->setHeader("Content-Type", "application/json");

$resources = array(
    '\App\Monitoring\BandwidthMonitoring',
    '\App\Monitoring\CpuInfoMonitoring',
    '\App\Monitoring\UptimeMonitoring',
    '\App\Monitoring\CurrentRamMonitoring',
    '\App\Monitoring\MemoryInfoMonitoring',
    '\App\Monitoring\LoadAvgMonitoring',
    '\App\Monitoring\DiskPartitionsMonitoring',
    '\App\Monitoring\CpuIntensiveProcessesMonitoring',
    '\App\Monitoring\IssueMonitoring',
    '\App\Monitoring\HostnameMonitoring',
    '\App\Monitoring\TimeMonitoring',
);

$monitoringCollection = new \App\MonitoringCollection();
$monitoringCollection->addCollection($resources);

foreach ($monitoringCollection as $resource) {
    $app->get('/'.$resource::MONITORING_TYPE, function() use ($resource, $response) {
        echo $response->send(
            $resource::getData()
        );
    });
}

$app->run();
