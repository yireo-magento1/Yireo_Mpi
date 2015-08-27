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
    /**
     * @return bool|mixed
     */
    public function enabled()
    {
        if ((bool)Mage::getStoreConfig('advanced/modules_disable_output/Yireo_Mpi')) {
            return false;
        }

        return Mage::getStoreConfig('mpi/settings/enabled');
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return Mage::getStoreConfig('mpi/settings/secret');
    }

    /**
     * @return bool
     */
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

    public function log($string, $variable1 = null, $variable2 = null)
    {
        $string = $this->__($string, $variable1, $variable2);

        // @todo: Add option for debugging

        $logger = Mage::getModel('core/log_adapter', 'mpi.log');
        $logger->log($string);
    }
}