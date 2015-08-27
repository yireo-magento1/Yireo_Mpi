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
class Yireo_Mpi_Model_Resource_Security_Addhandler extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
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
    }
}
