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
class Yireo_Mpi_Model_Resource_Database_Variable extends Yireo_Mpi_Model_Resource_Database_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $db = $this->getDbConnection();
        $variables = $this->getVariables();

        $query = 'SHOW VARIABLES';
        $rows = $db->fetchAll($query);
        foreach ($rows as $row) {
            $rowName = strtolower(array_shift($row));
            $rowValue = array_shift($row);
    
            if (array_key_exists($rowName, $variables)) {
                $variableType = $variables[$rowName];
                $this->addMetric($rowName, $rowValue, $variableType);
            }
        }

        return $this->metrics;
    }

    protected function getVariables()
    {
        return array(
            'read_buffer_size' => 'bytes',
            'read_rnd_buffer_size' => 'bytes',
            'join_buffer_size' => 'bytes',
            'key_buffer_size' => 'bytes',
            'sort_buffer_size' => 'bytes',
            'query_cache_limit' => 'bytes',
            'query_cache_min_res_unit' => 'bytes',
            'query_cache_size' => 'bytes',
            'query_cache_type' => 'int',
            'query_cache_wlock_invalidate' => 'bool',
            'have_query_cache' => 'bool',
            'table_open_cache' => 'int',
            'table_cache' => 'int',
            'table_definition_cache' => 'int',
            'max_heap_table_size' => 'bytes',
            'thread_cache_size' => 'bytes',
            'thread_stack' => 'bytes',
            'binlog_cache_size' => 'bytes',
            'tmp_table_size' => 'bytes',
            'myisam_sort_buffer_size' => 'bytes',
            'innodb_buffer_pool_size' => 'bytes',
            'innodb_additional_mem_pool_size' => 'bytes',
            'innodb_log_file_size' => 'bytes',
            'innodb_thread_concurrency' => 'int',
            'innodb_thread_sleep_delay' => 'int',
            'innodb_flush_log_at_trx_commit' => 'int',
            'innodb_flush_method' => 'string',
            'innodb_log_file_size' => 'bytes',
            'innodb_lock_wait_timeout' => 'seconds',
            'long_query_time' => 'seconds',
            'log_slow_queries' => 'string',
            'slow_query_log' => 'bool',
            'slow_query_log_file' => 'string',
            'max_connections' => 'int',
            'connect_timeout' => 'seconds',
            'performance_schema' => 'bool',
        );
    }
}
