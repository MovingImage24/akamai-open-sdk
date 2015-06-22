<?php

namespace Mi\Akamai\SDK\Model;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 *
 * @codeCoverageIgnore
 */
class ResultData
{
    private $columns;
    private $rows;
    private $metaData;

    /**
     * @return String[]
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @return String[]
     */
    public function getColumns()
    {
        return $this->columns;
    }
}
