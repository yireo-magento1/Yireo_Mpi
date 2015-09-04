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
 * System check class
 */
class Yireo_Mpi_Model_Check_EntryFile extends Yireo_Mpi_Model_Check_Abstract
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $entryFile = BP.'/yireo_mpi.php';

        if (!is_file($entryFile)) {
            $this->addCheck('Entry File', 'PHP file <code>yireo_mpi.php</code> does not exist', false);
            return false;
        }

        if (is_readable($entryFile) == false) {
            $this->addCheck('Entry File', 'PHP file <code>yireo_mpi.php</code> exists but is not readable', false);
            return false;
        }

        $this->addCheck('Entry File' , 'PHP file <code>yireo_mpi.php</code> exists', true);
    }
}
