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
class Yireo_Mpi_Model_Check_Core_Version extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Return all checks of this class
     *
     * @return array
     */
    public function getChecks()
    {
        return array(
            $this->getMetric('version', $this->getVersion()),
            $this->getMetric('edition', $this->getEdition()),
        );
    }

    public function getVersion()
    {
        if(method_exists('Mage', 'getVersion')) {
            return Mage::getVersion();
        }

        return 'unknown';
    }

    public function getEdition()
    {
        if(method_exists('Mage', 'getEdition')) {
            return Mage::getEdition();
        }

        return 'unknown';
    }
}
