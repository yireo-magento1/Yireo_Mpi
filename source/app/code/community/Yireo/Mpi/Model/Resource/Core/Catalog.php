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
 *
 */
class Yireo_Mpi_Model_Resource_Core_Catalog extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $this->addMetric('product_count', $this->countCollection('catalog/product'));
        $this->addMetric('product_inactive_count', $this->countCollection('catalog/product', array(
            'status' => Mage_Catalog_Model_Product_Status::STATUS_DISABLED)));
        $this->addMetric('category_count', $this->countCollection('catalog/category'));

        return $this->metrics;
    }
}
