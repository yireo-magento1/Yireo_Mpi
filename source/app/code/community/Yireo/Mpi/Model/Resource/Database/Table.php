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
class Yireo_Mpi_Model_Resource_Database_Table extends Yireo_Mpi_Model_Resource_Database_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $result = array();

        $tables = $this->getTableNames();
        foreach($tables as $table) {
            $result[] = $this->getMetric($table . '/count', $this->getTableSize($table));
        }

        return $result;
    }

    /**
     * @param $table
     *
     * @return mixed
     */
    protected function getTableSize($table)
    {
        $db = $this->getDbConnection();
        $table_name = Mage::getSingleton('core/resource')->getTableName($table);

        $query = 'SELECT COUNT(*) FROM `'.$table_name.'`';
        $result = $db->fetchOne($query);

        return $result;
    }

    /**
     * @return array
     */
    protected function getTableNames()
    {
        return array(
            'core_url_rewrite',
            'log_customer',
            'log_quote',
            'log_summary',
            'log_summary_type',
            'log_url',
            'log_url_info',
            'log_visitor',
            'log_visitor_info',
            'log_visitor_online',
            'report_viewed_product_index',
            'report_compared_product_index',
            'report_event',
            'catalog_compare_item',
            'dataflow_batch_export',
            'dataflow_batch_import',
        );
    }
}
