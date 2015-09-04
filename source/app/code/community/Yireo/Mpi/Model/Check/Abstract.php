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
 *
 */
class Yireo_Mpi_Model_Check_Abstract
{
    /**
     *
     */
    const RESULT_SUCCESS = 1;

    /**
     *
     */
    const RESULT_FAILED = 0;

    /**
     * @var array
     */
    protected $checks = array();

    /**
     * @param $name
     * @param $label
     * @param $result
     */
    public function addCheck($label, $resultText, $result)
    {
        if ($result == true) {
            $result = self::RESULT_SUCCESS;
        } else {
            $result = self::RESULT_FAILED;
        }

        $check = (object)null;
        $check->label = $label;
        $check->result_text = $resultText;

        // @todo: Implement images
        $check->result_image = ($result) ? '[ok]' : '[failed]';

        $this->checks[] = $check;
    }

    /**
     * @return array
     */
    public function getChecks()
    {
        return $this->checks;
    }
}
