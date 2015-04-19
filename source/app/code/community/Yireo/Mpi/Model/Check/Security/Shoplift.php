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
class Yireo_Mpi_Model_Check_Security_Shoplift extends Yireo_Mpi_Model_Check_Abstract
{
    public function getChecks()
    {
        return array(
            'cms_wysiwyg_post' => $this->checkCmsWysiwygPost(),
            'patch_internally_forwarded' => $this->checkInternallyForwardedMethod(),
        );
    }

    public function checkCmsWysiwygPost()
    {
        return array('bool', false);
        // @todo: POST /index.php/admin/Cms_Wysiwyg/directive/index/
    }

    public function checkInternallyForwardedMethod()
    {
        $result = (int) method_exists('Mage_Admin_Model_Observer','setInternallyForwarded');
        return array('bool', $result);
    }
}
