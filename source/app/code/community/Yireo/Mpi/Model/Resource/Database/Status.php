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
class Yireo_Mpi_Model_Resource_Database_Status extends Yireo_Mpi_Model_Resource_Database_Abstract
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

        $query = 'SHOW STATUS';
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
            'connections' => 'int',
            'innodb_page_size' => 'bytes',
            'innodb_buffer_pool_pages_total' => 'int',
            'innodb_buffer_pool_pages_misc' => 'int',
            'innodb_buffer_pool_pages_free' => 'int',
            'innodb_buffer_pool_pages_data' => 'int',
            'innodb_buffer_pool_pages_flushed' => 'int',
            'innodb_buffer_pool_pages_dirty' => 'int',
            'open_tables' => 'int',
            'open_table_definitions' => 'int',
            'qcache_free_memory' => 'bytes',
            'slow_queries' => 'int',
            'uptime' => 'seconds',
        );
    }
}
