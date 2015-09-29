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
 * Security check to check for possible phpinfo() files
 */
class Yireo_Mpi_Model_Resource_Security_Phpinfo extends Yireo_Mpi_Model_Resource_Abstract
{
    public function getData()
    {
        return array(
            $this->getMetricFromCallback('phpinfo_files', 'scanPhpInfoFiles', 'array'),
        );
    }

    public function scanPhpInfoFiles()
    {
        $phpInfoFiles = array();
        $phpFiles = glob(BP.'/*.php');

        foreach($phpFiles as $phpFile) {
            $phpContents = file_get_contents($phpFile);
            if (strstr($phpContents, 'phpinfo()')) {
                $phpInfoFiles[] = $phpFile;
            }
        }

        return $phpInfoFiles;
    }
}
