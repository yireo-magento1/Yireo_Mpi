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
 * Get caching information
 */
class Yireo_Mpi_Model_Resource_Core_Session extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $result = array();

        $result[] = $this->getMetric('session_save', $this->getSessionSave());

        return $result;
    }

    public function getSessionSave()
    {
        return (string)Mage::getConfig()->getNode('global/session_save');
    }
}
