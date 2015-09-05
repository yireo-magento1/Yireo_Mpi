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
 * System check class
 */
class Yireo_Mpi_Model_Check_Version extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $config = Mage::app()->getConfig()->getModuleConfig('Yireo_Mpi');
        $version = (string)$config->version;

        $this->addCheck('Version', 'Current version is '.$version, true);
    }
}
