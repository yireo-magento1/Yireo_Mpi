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
class Yireo_Mpi_Model_Check_Core_Compiler extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Return all checks of this class
     *
     * @return array
     */
    public function getChecks()
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
