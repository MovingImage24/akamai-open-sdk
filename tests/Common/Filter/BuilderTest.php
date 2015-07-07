<?php

namespace Mi\Akamai\SDK\Tests\Common\Filter;

use Mi\Akamai\SDK\Common\Filter\Builder;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 * 
 * @covers Mi\Akamai\SDK\Common\Filter\Builder
 */
class BuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Builder
     */
    private $builder;

    /**
     * @test
     */
    public function filterDimension()
    {
        $filter = $this->builder->filterDimension(2, ['value'], 'in');

        self::assertEquals([['type' => 'dimension', 'id' => 2, 'values' => ['value'], 'condition' => 'in']], $filter);
    }

    /**
     * @test
     */
    public function filterMetric()
    {
        $filter = $this->builder->filterMetric(2, ['value'], 'in');

        self::assertEquals([['type' => 'metric', 'id' => 2, 'values' => ['value'], 'condition' => 'in']], $filter);
    }

    protected function setUp()
    {
        $this->builder = new Builder();
    }
}
