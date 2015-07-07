<?php

namespace Mi\Akamai\SDK\Common\Filter;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 *
 * @codeCoverageIgnore
 */
class DimensionCondition
{
    const IN = 'in';
    const NOT_IN = 'nin';
    const CONTAINS = 'contains';
    const NOT_CONTAINS = 'ncontains';
    const STARTS = 'starts';
    const NOT_STARTS = 'nstarts';
    const ENDS = 'ends';
    const NOT_ENDS = 'nends';
}
