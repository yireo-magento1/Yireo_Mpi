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
class Yireo_Mpi_Model_Check_Secret extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $secret = Mage::helper('mpi')->getSecret();

        if (empty($secret)) {
            $this->addCheck('API Key', 'You have not configured an API key yet', false);
            return false;
        }

        if (strlen($secret) < 10) {
            $this->addCheck('API Key', 'You have configured an invalid API key', false);
            return false;
        }

        $this->addCheck('API Key' , 'You have a valid API Key', true);
    }
}
