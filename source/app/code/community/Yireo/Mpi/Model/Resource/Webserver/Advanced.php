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
 * Get core versioning
 */
class Yireo_Mpi_Model_Resource_Webserver_Advanced extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $result = array();

        $result[] = $this->getMetric('disk_free_space_varcache', $this->getFreeSpace('var/cache'));
        $result[] = $this->getMetric('disk_free_space_varsession', $this->getFreeSpace('var/session'));

        return $result;
    }

    protected function getFreeSpace($dir)
    {
        $dir = MAGENTO_ROOT.'/'.$dir;

        if(function_exists('disk_free_space')) {
            return disk_free_space($dir);
        }

        return -1;
    }
}