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
class Yireo_Mpi_Model_Resource_Attribute_Listing extends Yireo_Mpi_Model_Resource_Abstract
{
    protected $attributeListing = array();

    protected $attributeConfigurable = array();

    protected $attributeFilterable = array();

    protected $attributeSearchable = array();

    protected $attributeComparable = array();

    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $this->getAttributeListings();

        $this->addMetric('catalog_product_attributes_array_listing', $this->attributeListing);
        $this->addMetric('catalog_product_attributes_array_configurable', $this->attributeConfigurable);
        $this->addMetric('catalog_product_attributes_array_filterable', $this->attributeFilterable);
        $this->addMetric('catalog_product_attributes_array_searchable', $this->attributeSearchable);
        $this->addMetric('catalog_product_attributes_array_comparable', $this->attributeComparable);

        return $this->metrics;
    }

    /**
     *
     */
    protected function getAttributeListings()
    {
        $attributes = $this->getAttributes();

        foreach($attributes as $attribute) {

            if($attribute->getData('used_in_product_listing') == 1) {
                $this->attributeListing[] = $attribute->getName();
            }

            if($attribute->getData('is_configurable') == 1) {
                $this->attributeFilterable[] = $attribute->getName();
            }

            if($attribute->getData('is_filterable') == 1) {
                $this->attributeFilterable[] = $attribute->getName();
            }

            if($attribute->getData('is_searchable') == 1) {
                $this->attributeSearchable[] = $attribute->getName();
            }

            if($attribute->getData('is_comparable') == 1) {
                $this->attributeComparable[] = $attribute->getName();
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
