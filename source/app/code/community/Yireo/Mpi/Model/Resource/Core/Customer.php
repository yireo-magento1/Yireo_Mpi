<?php
/**
 * Yireo Mpi for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 *
 */
class Yireo_Mpi_Model_Resource_Core_Customer extends Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $this->addMetric('customer_count', $this->countCollection('customer/customer'));

        return $this->metrics;
    }
}
