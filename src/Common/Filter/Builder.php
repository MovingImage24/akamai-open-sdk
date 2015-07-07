<?php

namespace Mi\Akamai\SDK\Common\Filter;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 */
class Builder
{
    /**
     * @param int    $dimensionId
     * @param array  $values
     * @param string $condition
     * @param array  $filter
     *
     * @return array
     */
    public function filterDimension($dimensionId, array $values, $condition, array $filter = [])
    {
        $filter[] = ['type' => 'dimension', 'values' => $values, 'id' => $dimensionId, 'condition' => $condition];

        return $filter;
    }

    /**
     * @param int    $metricId
     * @param array  $values
     * @param string $condition
     * @param array  $filter
     *
     * @return array
     */
    public function filterMetric($metricId, array $values, $condition, array $filter = [])
    {
        $filter[] = ['type' => 'metric', 'values' => $values, 'id' => $metricId, 'condition' => $condition];

        return $filter;
    }

}
