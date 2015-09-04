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
class Yireo_Mpi_Model_Check_Enabled extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $enabled = Mage::helper('mpi')->enabled();

        if ($enabled == false) {
            $this->addCheck('Enabled', 'The Yireo_MPI extension is disabled by setting', false);
            return false;
        }

        $this->addCheck('Enabled' , 'The Yireo_MPI extension is enabled', true);
    }
}
