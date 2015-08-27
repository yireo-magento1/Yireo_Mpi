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
 * Test check
 */
class Yireo_Mpi_Model_Resource_Test extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        return array(
            $this->getMetricFromCallback('test', 'getTest'),
        );
    }

    /**
     * Get simple test data
     *
     * @return array
     */
    public function getTest()
    {
        return 1;
    }
}
