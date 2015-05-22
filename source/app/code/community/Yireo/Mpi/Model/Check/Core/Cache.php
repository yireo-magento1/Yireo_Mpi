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
class Yireo_Mpi_Model_Check_Core_Cache extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Return all checks of this class
     *
     * @return array
     */
    public function getChecks()
    {
        $checks = array();

        $cacheTypes = $this->getCacheTypes();
        foreach($cacheTypes as $cacheName => $cacheType) {
            $checks[] = $this->getMetric('type/'.$cacheName.'/status', (bool)$cacheType->getData('status'));
            $checks[] = $this->getMetric('type/'.$cacheName.'/tags', $cacheType->getData('tags'));
        }

        $checks[] = $this->getMetric('caching_backend', $this->getCachingBackend());

        return $checks;
    }

    public function getCacheTypes()
    {
        $cacheTypes = Mage::getModel('core/cache')->getTypes();
        return $cacheTypes;
    }

    public function getCachingBackend()
    {
        return (string)Mage::getConfig()->getNode('global/cache/backend');
    }
}
