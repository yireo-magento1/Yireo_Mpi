<?php
/**
 * Mpi extension for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * MPI backend controller
 *
 * @category   Mpi
 * @package     Yireo_Mpi
 */
class Yireo_Mpi_MpiController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Common method
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('system/tools/mpi')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('System'), Mage::helper('adminhtml')->__('System'))
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Tools'), Mage::helper('adminhtml')->__('Tools'))
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('System Information'), Mage::helper('adminhtml')->__('Performance Insights'))
        ;
        return $this;
    }

    /**
     * Overview page
     */
    public function indexAction()
    {
        $this->_initAction()
            ->_addContent($this->getLayout()->createBlock('mpi/overview'))
            ->renderLayout();
    }

    protected function _isAllowed()
    {
        $aclResource = 'admin/system/tools/mpi';

        return Mage::getSingleton('admin/session')->isAllowed($aclResource);
    }
}
