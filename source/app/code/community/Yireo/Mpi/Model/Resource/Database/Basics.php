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
class Yireo_Mpi_Model_Resource_Database_Basics extends Yireo_Mpi_Model_Resource_Database_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $result = array();

        $result[] = $this->getMetric('version', $this->getDatabaseVersion());
        $result[] = $this->getMetric('host', $this->getDatabaseHost());
        $result[] = $this->getMetric('database', $this->getDatabaseName());
        $result[] = $this->getMetric('database_count', $this->countDatabases());
        $result[] = $this->getMetric('table_count', $this->countTables());
        $result[] = $this->getMetric('status', $this->getStatus(), 'array');

        $tableStatuses = $this->getTableStatus();
        foreach($tableStatuses as $tableStatus) {
            $tableName = array_shift($tableStatus);
            $result[] = $this->getMetric('table_status/'.$tableName, $tableStatus, 'array');
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function getDatabaseVersion()
    {
        $db = $this->getDbConnection();
        return (string) $db->getConnection()->getAttribute(PDO::ATTR_SERVER_VERSION);
    }

    /**
     * @return Mage_Core_Model_Config_Element
     */
    protected function getDatabaseHost()
    {
        return (string) Mage::getConfig()->getNode('global/resources/default_setup/connection/host');
    }

    /**
     * @return Mage_Core_Model_Config_Element
     */
    protected function getDatabaseName()
    {
        return (string) Mage::getConfig()->getNode('global/resources/default_setup/connection/dbname');
    }

    /**
     * @return int
     */
    protected function countDatabases()
    {
        $db = $this->getDbConnection();
        $query = 'SHOW DATABASES';
        $result = $db->fetchAll($query);
        return count($result) - 1;
    }

    /**
     * @return int
     */
    protected function countTables()
    {
        $db = $this->getDbConnection();
        $query = 'SHOW TABLES';
        $result = $db->fetchAll($query);
        return count($result);
    }

    /**
     * @return mixed
     */
    protected function getTableStatus()
    {
        $db = $this->getDbConnection();
        $query = 'SHOW TABLE STATUS';
        $result = $db->fetchAll($query);
        return $result;
    }

    /**
     * @return mixed
     */
    protected function getStatus()
    {
        $db = $this->getDbConnection();
        $query = 'SHOW STATUS';
        $result = $db->fetchAll($query);
        return $result;
    }
}
