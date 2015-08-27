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
 * Get caching information
 */
class Yireo_Mpi_Model_Resource_Core_Cache extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all caches of this class
     *
     * @return array
     */
    public function getData()
    {
        $cacheTypes = $this->getCacheTypes();
        foreach($cacheTypes as $cacheName => $cacheType) {
            $this->addMetric('type/'.$cacheName.'/type', $cacheType->getData('cache_type'));
            $this->addMetric('type/'.$cacheName.'/status', (bool)$cacheType->getData('status'));
            $this->addMetric('type/'.$cacheName.'/tags', $cacheType->getData('tags'));
        }

        $this->addMetric('caching_backend', $this->getCachingBackend());

        return $this->metrics;
    }

    public function getCacheTypes()
    {
        $cacheTypes = Mage::app()->getCacheInstance()->getTypes();
        return $cacheTypes;
    }

    public function getCachingBackend()
    {
        return (string)Mage::getConfig()->getNode('global/cache/backend');
    }
}
