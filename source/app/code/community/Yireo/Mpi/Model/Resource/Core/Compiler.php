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
 * Get information on the Magento Compiler
 */
class Yireo_Mpi_Model_Resource_Core_Compiler extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        return array(
            $this->getMetricFromCallback('enabled', 'isEnabled'),
        );
    }

    public function isEnabled()
    {
        // Check for compiler
        $compilerConfigFile = BP.'/includes/config.php';

        if (file_exists($compilerConfigFile) && is_readable($compilerConfigFile)) {
            include_once $compilerConfigFile;
            if(defined('COMPILER_INCLUDE_PATH')) {
                return true;
            }
        }

        return false;
    }
}
