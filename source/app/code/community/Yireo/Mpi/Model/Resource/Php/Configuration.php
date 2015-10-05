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
class Yireo_Mpi_Model_Resource_Php_Configuration extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $result = array();

        if (function_exists('ini_get') == false) {
            $this->log('PHP ini_get() does not exist');
            return $result;
        }

        foreach ($this->getOptions() as $option => $variableType) {
            $result[] = $this->getMetric($option, ini_get($option), $variableType);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return array(
            'display_errors' => 'bool',
            'error_reporting' => 'int',
            'log_errors' => 'bool',
            'magic_quotes_gpc' => 'bool',
            'safe_mode' => 'bool',
            'disable_functions' => 'string',
            'realpath_cache_size' => 'bytes',
            'realpath_cache_ttl' => 'seconds',
            'expose_php' => 'bool',
            'open_basedir' => 'string',
            'max_execution_time' => 'seconds',
            'max_input_time' => 'seconds',
            'memory_limit' => 'bytes',
            'ignore_repeated_errors' => 'bool',
            'post_max_size' => 'bytes',
            'upload_max_filesize' => 'bytes',
            'default_socket_timeout' => 'seconds',
            'mysql.allow_persistent' => 'bool',
            'mysql.max_links' => 'int',
            'mysql.connect_timeout' => 'seconds',
            'session.save_path' => 'string',
            'session.save_handler' => 'string',
            'apc.enabled' => 'bool',
            'apc.shm_size' => 'bytes',
            'apc.stat' => 'bool',
            'opcache.enable' => 'bool',
            'opcache.memory_consumption' => 'megabytes',
            'opcache.revalidate_freq' => 'seconds',
            'opcache.validate_timestamps' => 'bool',
            'memcache.allow_failover' => 'bool',
            'memcache.chunk_size' => 'bytes',
            'memcache.lock_timeout' => 'seconds',
            'zlib.output_compression' => 'bool',
            'zend_optimizerplus.enable' => 'bool',
            'zend_optimizerplus.memory_consumption' => 'bytes',
            'zend_optimizerplus.enable_slow_optimizations' => 'bool',
            'zend_optimizerplus.validate_timestamps' => 'bool',
            'eaccelerator.enable' => 'bool',
            'eaccelerator.optimizer' => 'bool',
            'eaccelerator.check_mtime' => 'bool',
            'eaccelerator.shm_size' => 'bytes',
            'soap.wsdl_cache_enabled' => 'bool',
            'date.timezone' => 'string',
        );
    }
}
