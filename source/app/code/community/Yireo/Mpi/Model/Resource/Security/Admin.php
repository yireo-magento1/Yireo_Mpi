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
class Yireo_Mpi_Model_Resource_Security_Admin extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $result = array();

        $result[] = $this->getMetric('users', $this->getAdminUsers(), 'array');

        return $result;
    }

    /**
     * @return array
     */
    protected function getAdminUsers()
    {
        $adminUsers = Mage::getModel('admin/user')->getCollection();
        $adminUserData = array();
        foreach($adminUsers as $adminUser) {
            /** @var $adminUser Mage_Admin_Model_User */
            $adminUserData[] = array('username' => $adminUser->getUsername(), 'email' => $adminUser->getEmail());
        }

        return $adminUserData;
    }
}
