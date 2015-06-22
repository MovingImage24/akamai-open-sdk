<?php

namespace Mi\Akamai\SDK\AudienceAnalytics;

use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Mi\Akamai\SDK\Model\DataSource;
use Mi\Akamai\SDK\Model\DataStore;
use Mi\Akamai\SDK\Model\ReportPack;
use Mi\Akamai\SDK\Model\ResultData;

/**
 * @author Alexander Miehe <alexander.miehe@movingimage.com>
 *
 * @codeCoverageIgnore
 */
class AudienceAnalyticsService extends GuzzleClient
{
    const DATE_FORMAT = 'MM/DD/YY:HH:II';

    /**
     * @return ReportPack[]
     */
    public function getAllReportPacks()
    {
        return $this->execute($this->getCommand('getAllReportPacks'));
    }

    /**
     * @param integer $reportPackId
     *
     * @return ReportPack
     */
    public function getReportPack($reportPackId)
    {
        return $this->execute($this->getCommand('getReportPack', ['reportPackId' => $reportPackId]));
    }

    /**
     * @param integer $reportPackId
     *
     * @return DataStore[]
     */
    public function getAllDataStores($reportPackId)
    {
        return $this->execute($this->getCommand('getAllDataStores', ['reportPackId' => $reportPackId]));
    }

    /**
     * @param integer $reportPackId
     * @param integer $dataStoreId
     *
     * @return DataStore
     */
    public function getDataStore($reportPackId, $dataStoreId)
    {
        return $this->execute(
            $this->getCommand('getAllDataStores', ['reportPackId' => $reportPackId, 'dataStoreId' => $dataStoreId])
        );
    }

    /**
     * @param integer $reportPackId
     *
     * @return DataSource[]
     */
    public function getAllDataSources($reportPackId)
    {
        return $this->execute($this->getCommand('getAllDataSources', ['reportPackId' => $reportPackId]));
    }

    /**
     * @param integer $reportPackId
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param string $dimensions
     * @param string $metrics
     * @param array $optionalParameters
     *
     * @return ResultData
     */
    public function getData(
        $reportPackId,
        \DateTime $startDate,
        \DateTime $endDate,
        $dimensions,
        $metrics,
        array $optionalParameters = []
    ) {
        $optionalParameters['reportPackId'] = $reportPackId;
        $optionalParameters['startDate']    = $startDate->format(self::DATE_FORMAT);
        $optionalParameters['endDate']      = $endDate->format(self::DATE_FORMAT);
        $optionalParameters['dimensions']   = $dimensions;
        $optionalParameters['metrics']      = $metrics;

        return $this->execute($this->getCommand('getData', $optionalParameters));
    }
}
