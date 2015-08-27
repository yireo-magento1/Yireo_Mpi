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
class Yireo_Mpi_Model_Resource_Core_Attribute extends Yireo_Mpi_Model_Resource_Abstract
{
    protected $attributeCountAll = 0;

    protected $attributeCountLayNav = 0;

    protected $attributeCountSearch = 0;

    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $this->getAttributeStatistics();

        $this->addMetric('catalog_product_attributes', $this->attributeCountAll);
        $this->addMetric('catalog_product_attributes_laynav', $this->attributeCountLayNav);
        $this->addMetric('catalog_product_attributes_search', $this->attributeCountSearch);

        return $this->metrics;
    }

    /**
     *
     */
    protected function getAttributeStatistics()
    {
        $attributes = $this->getAttributes();

        foreach($attributes as $attribute) {
            $this->attributeCountAll++;

            if($attribute->getData('is_filterable') == 1) {
                $this->attributeCountLayNav++;
            }

            if($attribute->getData('is_searchable') == 1 && $attribute->getData('is_filterable_in_search') == 1) {
                $this->attributeCountSearch++;
            }
        }
    }

    /**
     * @return mixed
     */
    protected function getAttributes()
    {
        $attributes = Mage::getSingleton('eav/config')->getEntityType(Mage_Catalog_Model_Product::ENTITY)->getAttributeCollection();
        return $attributes;
    }
}
