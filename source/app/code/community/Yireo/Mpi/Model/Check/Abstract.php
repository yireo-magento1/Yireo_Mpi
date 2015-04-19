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
class Yireo_Mpi_Model_Check_Abstract
{
    const MPI_LOGLEVEL_NOTICE = 'notice';
    const MPI_LOGLEVEL_WARNING = 'warning';
    const MPI_LOGLEVEL_ERROR = 'error';

    /**
     * Return an error-string as check-data
     *
     * @param $string
     *
     * @return array
     */
    public function getErrorData($string)
    {
        $data = array(
            'level' => self::MPI_LOGLEVEL_ERROR,
            'type' => 'string',
            'value' => $string,
        );

        return $data;
    }
}
