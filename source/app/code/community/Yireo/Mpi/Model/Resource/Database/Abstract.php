<?php
/**
 * Yireo Mpi for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 *
 */
class Yireo_Mpi_Model_Resource_Database_Abstract extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * @return mixed
     */
    protected function getDbConnection()
    {
        $db = Mage::getSingleton('core/resource')->getConnection('core_read');
        return $db;
    }
}