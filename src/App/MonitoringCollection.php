<?php

namespace App;

class MonitoringCollection implements \IteratorAggregate, \Countable
{
    private $resources = array();

    public function add($resource)
    {
        //to do check is MonitoringInterface
        $this->resources[] = $resource;
    }

    public function addCollection(array $resources)
    {
        $this->resources = $resources;
    }

    public function all()
    {
        return $this->resources;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->resources);
    }

    public function count()
    {
        return count($this->resources);
    }
} 