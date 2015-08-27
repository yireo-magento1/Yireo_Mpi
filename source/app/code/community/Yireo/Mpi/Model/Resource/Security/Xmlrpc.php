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
 * Security check for the XML-RPC security exploit
 */
class Yireo_Mpi_Model_Resource_Security_Xmlrpc extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        return array(
            $this->getMetric('vulnerable', $this->hasPotentialExploit()),
        );
    }

    /**
     * Perform the AddHandler check
     *
     * @return array
     */
    public function hasPotentialExploit()
    {
        if (version_compare(Mage::getVersion(), '1.7.0.1', '<') == false) {
            return false;
        }

        if (is_file(MAGENTO_ROOT.'/app/code/core/Mage/Api/controllers/XmlrpcController.php') == false) {
            return false;
        }

        return true;
    }
}
