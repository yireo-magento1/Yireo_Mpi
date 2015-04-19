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
class Yireo_Mpi_Model_Check_Test extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Return all checks of this class
     *
     * @return array
     */
    public function getChecks()
    {
        return array(
            $this->getTestCheck(),
        );
    }

    /**
     * Get simple test data
     *
     * @return array
     */
    public function getTestCheck()
    {
        return $this->getErrorData('Hello World');
    }
}
