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
 * Standalone PHP script for MPI
 * This script should be placed in the same folder as the Magento entry-file `index.php`
 */

// Display PHP errors
// ini_set('display_errors', 1);

// Initialize scan
$mpi = new YireoMpi();
$mpi->initialize();
$mpi->dispatch();

// Class YireoScan
class YireoMpi
{
    /**
     * Listing of metrics
     */
    protected $metrics = array();

    public function initialize()
    {
        // Start timing
        $startTime = microtime(true);

        // Initialize Magento
        if (is_file('app/Mage.php') == false) {
            die('No Mage.php file found');
        }

        // Start-up Magento
        require_once 'app/Mage.php';
        Mage::app();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        // Measure the elapsed time
        $endTime = microtime(true);
        $this->metrics[] = array(
            'name' => 'yireo_mpi/init/startup',
            'value' => round($endTime - $startTime, 4),
            'type' => 'seconds',
            'start_time' => $startTime,
            'end_time' => $endTime,
        );
    }

    public function dispatch()
    {
        if ($this->getHelper()->authenticate() == false) {
            die('Access denied');
        }

        $metrics = $this->getHelper()->getMetricsFromRequest();

        if (!empty($metrics)) {
            $data = $this->getResourceModel()->getDataFromModels($metrics);
        } else {
            $groups = $this->getHelper()->getGroupsFromRequest();
            $data = $this->getResourceModel()->getDataFromGroups($groups);
        }

        $data['init'] = $this->metrics;

        $format = Mage::app()->getRequest()->getParam('format');
        if (empty($format)) {
            $format = 'json';
        }

        if ($format == 'json') {
            header('Content-Type: application/json', true);
            echo Mage::helper('core')->jsonEncode($data);
            exit;

        } elseif ($format == 'dump') {
            Mage::app()->getResponse()->setHeader('Content-type', 'text/html', true);
            ini_set('xdebug.var_display_max_children', 1024);
            Zend_Debug::dump($data);
        }
    }

    protected function getResponse()
    {
        return Mage::app()->getResponse();
    }

    /**
     * @return Yireo_Mpi_Helper_Data
     */
    protected function getHelper()
    {   
        return Mage::helper('mpi');
    }

    /**
     * @return Yireo_Mpi_Model_Resource
     */
    protected function getResourceModel()
    {
        return Mage::getModel('mpi/resource');
    }
}
