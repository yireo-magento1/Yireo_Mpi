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
 * Get information on the Magento indexer
 */
class Yireo_Mpi_Model_Check_Core_Indexer extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Return all checks of this class
     *
     * @return array
     */
    public function getChecks()
    {
        $checks = array();

        $indices = $this->getIndexes();
        foreach($indices as $index) {
            $indexCode = $index->getData('indexer_code');
            $checks[] = $this->getMetric('index/'.$indexCode.'/label', $index->getIndexer()->getName());
            $checks[] = $this->getMetric('index/'.$indexCode.'/status', $index->getData('status'));
            $checks[] = $this->getMetric('index/'.$indexCode.'/mode', $index->getData('mode'));
            $checks[] = $this->getMetric('index/'.$indexCode.'/date', strtotime($index->getData('started_at')), 'timestamp');
        }

        return $checks;
    }

    public function getIndexes()
    {
        return Mage::getModel('index/process')->getCollection();
    }
}
