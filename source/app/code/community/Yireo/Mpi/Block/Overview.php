<?php
/**
 * Mpi extension for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_Mpi_Block_Overview extends Mage_Core_Block_Template
{
    /**
     * Constructor method
     */
    public function _construct()
    {
        parent::_construct();

        $this->setTemplate('mpi/overview.phtml');
    }

    /**
     * Helper to return the header of this page
     */
    public function getHeader($title = null)
    {
        return 'Yireo MPI (Magento Performance Insights) - '.$this->__($title);
    }

    /**
     * Helper to return the menu
     */
    public function getMenu()
    {
        return $this->getLayout()->createBlock('mpi/menu')->toHtml();
    }

    public function getChecks()
    {
        return Mage::getModel('mpi/check')->getResults();
    }
}
