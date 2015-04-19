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
 * Mpi helper
 */
class Yireo_Mpi_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function enabled()
    {
        return Mage::getStoreConfig('mpi/settings/enabled');
    }

    public function getSecret()
    {
        return Mage::getStoreConfig('mpi/settings/secret');
    }

    public function authenticate()
    {
        $secret = Mage::app()->getRequest()->getParam('secret');
        $secret = trim($secret);

        if (empty($secret)) {
            return false;
        }

        if (strlen($secret) < 10) {
            return false;
        }

        if ($secret == $this->getSecret()) {
            return true;
        }

        return false;
    }
}