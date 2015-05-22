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
class Yireo_Mpi_Model_Check_Core_Session extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Return all checks of this class
     *
     * @return array
     */
    public function getChecks()
    {
        $checks = array();

        $checks[] = $this->getMetric('session_save', $this->getSessionSave());

        return $checks;
    }

    public function getSessionSave()
    {
        return (string)Mage::getConfig()->getNode('global/session_save');
    }
}
