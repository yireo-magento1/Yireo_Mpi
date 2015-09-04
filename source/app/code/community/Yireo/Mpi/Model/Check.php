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
class Yireo_Mpi_Model_Check
{
    public function getResults()
    {
        $results = array();

        $checkDir = BP . '/app/code/community/Yireo/Mpi/Model/Check/';
        $checkFiles = scandir($checkDir);

        foreach($checkFiles as $checkFile) {
            if (preg_match('/\.php$/', $checkFile) == false) {
                continue;
            }

            if ($checkFile == 'Abstract.php') {
                continue;
            }

            $checkModelName = preg_replace('/\.php$/', '', $checkFile);

            /** @var Yireo_Mpi_Model_Check_Abstract $checkModel */
            $checkModel = Mage::getModel('mpi/check_'.$checkModelName);

            if (empty($checkModel)) {
                continue;
            }

            $checks = $checkModel->getChecks();

            if (is_array($checks)) {
                $results = array_merge($results, $checks);
            }
        }

        return $results;
    }
}
