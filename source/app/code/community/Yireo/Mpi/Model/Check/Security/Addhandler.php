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
 * Security check for the AddHandler security exploit
 *
 * @info        http://devdocs.magento.com/guides/m1x/other/appsec-900_addhandler.html
 */
class Yireo_Mpi_Model_Check_Security_Addhandler extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Return all checks of this class
     *
     * @return array
     */
    public function getChecks()
    {
        return array(
            $this->getMetricFromCallback('addhandler', 'getAddHandlerCheck'),
        );
    }

    /**
     * Perform the AddHandler check
     *
     * @return array
     */
    public function getAddHandlerCheck()
    {
        return false;
        // @todo: http://magento1.yireo-dev.com/test.php.csv
    }
}
