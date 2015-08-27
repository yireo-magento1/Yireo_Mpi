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
 * Security check for the AddHandler security exploit
 *
 * @info        SUPEE-5344
 */
class Yireo_Mpi_Model_Resource_Security_Shoplift extends Yireo_Mpi_Model_Resource_Abstract
{
    public function getData()
    {
        return array(
            $this->getMetricFromCallback('cms_wysiwyg_post', 'checkCmsWysiwygPost'),
            $this->getMetricFromCallback('patch_internally_forwarded', 'checkInternallyForwardedMethod'),
        );
    }

    public function checkCmsWysiwygPost()
    {
        return false;
    }

    public function checkInternallyForwardedMethod()
    {
        $result = method_exists('Mage_Admin_Model_Observer','setInternallyForwarded');
        return $result;
    }
}
