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

    protected $attributeSuper = array();

    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $this->getAttributeListings();

        $this->addMetric('catalog_product_attributes_array_listing', $this->attributeListing, 'array');
        $this->addMetric('catalog_product_attributes_array_configurable', $this->attributeConfigurable, 'array');
        $this->addMetric('catalog_product_attributes_array_filterable', $this->attributeFilterable, 'array');
        $this->addMetric('catalog_product_attributes_array_searchable', $this->attributeSearchable, 'array');
        $this->addMetric('catalog_product_attributes_array_comparable', $this->attributeComparable, 'array');
        $this->addMetric('catalog_product_attributes_array_super', $this->attributeSuper, 'array');

        return $this->metrics;
    }

    /**
     *
     */
    protected function getAttributeListings()
    {
        $attributes = $this->getAttributes();
        $superAttributes = $this->getUsedSuperAttributeIds();

        foreach($attributes as $attribute) {

            if($attribute->getData('is_user_defined') == 0) {
                continue;
            }

            if($attribute->getData('used_in_product_listing') == 1) {
                $this->attributeListing[] = $attribute->getName();
            }

            $applyTo = explode(',', $attribute->getData('apply_to'));
            $allowFrontendInput = array('boolean', 'select', 'multiselect');
            if($attribute->getData('is_configurable') == 1 && in_array('configurable', $applyTo) 
                && in_array($attribute->getData('frontend_input', $allowFrontendInput))) {
                $this->attributeConfigurable[] = $attribute->getName();
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

            if(in_array($attribute->getId(), $superAttributes)) {
                $this->attributeSuper[] = $attribute->getName();
            }
        }
    }

    public function getUsedSuperAttributeIds()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $tableName = $resource->getTableName('catalog_product_super_attribute');
        $query = 'SELECT DISTINCT(`attribute_id`) AS `id` FROM '.$tableName;
        $results = $readConnection->fetchAll($query);

        $ids = array();
        foreach ($results as $result) {
            $ids[] = $result['id'];
        }

        return $ids;
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
