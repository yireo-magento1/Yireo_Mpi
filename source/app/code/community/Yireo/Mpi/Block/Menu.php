<?php
/**
 * Mpi extension for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_Mpi_Block_Menu extends Mage_Core_Block_Template
{
    /**
     * Constructor method
     */
    public function _construct()
    {
        parent::_construct();

        $this->setTemplate('mpi/menu.phtml');
    }

    /**
     * Helper method to get a list of the menu-items
     */
    public function getMenuItems()
    {
        // Build the list of menu-items
        $items = array(
            array(
                'action' => 'index',
                'title' => 'System Check',
            ),
        );

        $url = Mage::getModel('adminhtml/url');
        $current_action = $this->getRequest()->getActionName();

        foreach($items as $index => $item) {

            if($item['action'] == $current_action) {
                $item['class'] = 'active';
            } else {
                $item['class'] = 'inactive';
            }

            $item['url'] = $url->getUrl('adminhtml/mpi/'.$item['action']);

            $items[$index] = $item;
        }

        return $items;
    }
}
