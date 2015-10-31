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
 * Get core versioning
 */
class Yireo_Mpi_Model_Resource_Core_Configuration extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $defaultStore = Mage::helper('mpi')->getDefaultStore();
        $result = array();

        foreach ($this->getPaths() as $path => $variableType) {
            $result[] = $this->getMetric($path, Mage::getStoreConfig($path, $defaultStore), $variableType);
        }

        foreach ($this->getNodes() as $node => $variableType) {
            $result[] = $this->getMetric($node, (string) Mage::getConfig()->getNode($node), $variableType);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getNodes()
    {
        return array(
            'global/disable_local_modules' => 'bool',
            'global/skip_process_modules_updates' => 'bool',
            'admin/routers/adminhtml/args/frontName' => 'string',
        );
    }

    /**
     * @return array
     */
    public function getPaths()
    {
        return array(
            'catalog/frontend/flat_catalog_category' => 'bool',
            'catalog/frontend/flat_catalog_product' => 'bool',
            'catalog/search/use_layered_navigation_count' => 'int',
            'admin/url/use_custom' => 'bool',
            'system/media_storage_configuration/media_storage' => 'bool',
            'system/external_page_cache/enabled' => 'bool',
            'dev/debug/profiler' => 'bool',
            'dev/translate_inline/active' => 'bool',
            'dev/log/active' => 'bool',
            'dev/js/merge_files' => 'bool',
            'dev/css/merge_css_files' => 'bool',
            'general/locale/timezone' => 'string',
        );
    }
}
