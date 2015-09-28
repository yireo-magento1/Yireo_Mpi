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
 *
 */
class Yireo_Mpi_Model_Resource_Php_Basics extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $result = array();

        $result[] = $this->getMetric('version', $this->getVersion());
        $result[] = $this->getMetric('user', $this->getUser());
        $result[] = $this->getMetric('os', $this->getOs());
        $result[] = $this->getMetric('hostname', $this->getHostname());
        $result[] = $this->getMetric('machine_type', $this->getMachineType());
        $result[] = $this->getMetric('os_additional', $this->getOsAdditional());
        $result[] = $this->getMetric('zend_version', $this->getZendVersion());
        $result[] = $this->getMetric('resource_usage', $this->getResourceUsage(), 'array');
        $result[] = $this->getMetric('memory_usage', $this->getMemoryUsage(), 'bytes');
        $result[] = $this->getMetric('load_average', $this->getLoadAverage(), 'array');
        $result[] = $this->getMetric('date_default_timezone_get', date_default_timezone_get());

        return $result;
    }

    protected function getVersion()
    {
        return phpversion();
    }

    protected function getUser()
    {
        return get_current_user();
    }

    protected function getOs()
    {
        return php_uname('s') . ' ' . php_uname('r');
    }

    protected function getHostname()
    {
        return php_uname('n');
    }

    protected function getMachineType()
    {
        return php_uname('m');
    }

    protected function getOsAdditional()
    {
        return php_uname('v');
    }

    protected function getZendVersion()
    {
        return zend_version();
    }

    protected function getResourceUsage()
    {
        return getrusage();
    }

    protected function getMemoryUsage()
    {
        return memory_get_usage();
    }

    protected function getLoadAverage()
    {
        return sys_getloadavg();
    }
}
