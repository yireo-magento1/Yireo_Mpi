<?php
/**
 * Yireo Mpi for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * Get environment basics
 */
class Yireo_Mpi_Model_Resource_Environment_Basics extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        return array(
            $this->getMetricFromCallback('ip', 'getIpAddress'),
            $this->getMetricFromCallback('internal_ip', 'getInternalIpAddress'),
            $this->getMetricFromCallback('keep_alive', 'getKeepAlive'),
            $this->getMetricFromCallback('gzip', 'getGzip'),
            $this->getMetricFromCallback('deflate', 'getDeflate'),
            $this->getMetricFromCallback('dns_time', 'getDnsTime', 'seconds'),
            $this->getMetric('timezone:php', date_default_timezone_get()),
            $this->getMetric('timezone:ini', ini_get('date.timezone')),
        );
    }

    public function getIpAddress()
    {
        return $_SERVER['SERVER_ADDR'];
    }

    public function getInternalIpAddress()
    {
        return gethostbyname($_SERVER['HTTP_HOST']);
    }

    public function getKeepAlive()
    {
        return ($_SERVER['HTTP_CONNECTION'] == 'keep-alive');
    }

    public function getGzip()
    {
        return (bool) stristr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip');
    }

    public function getDeflate()
    {
        return (bool) stristr($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate');
    }

    public function getDnsTime()
    {
        $host = 'www.magentocommerce.com';
        $dnsTimer = 0;
        for($i = 0; $i < 4; $i++) {
            $startTimer = microtime(true);
            gethostbyname($host);
            $endTimer = microtime(true);
            $dnsTimer = $dnsTimer + (float)$endTimer - $startTimer;
        }

        return (float) round($dnsTimer / 4, 4);
    }
}
