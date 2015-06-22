<?php

namespace Mi\Akamai\SDK\Model;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 *
 * @codeCoverageIgnore
 */
class DataStore
{
    private $id;
    private $name;
    private $type;
    private $description;
    private $dimensions;
    private $metrics;
    private $aggregationInSeconds;
    private $purgeIntervalInDays;
    private $maxQueryDurationInMinutes;
}
