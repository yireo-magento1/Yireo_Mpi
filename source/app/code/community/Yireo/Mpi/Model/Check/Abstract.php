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
 * Abstract class for checks
 */
class Yireo_Mpi_Model_Check_Abstract
{
    const MPI_LOGLEVEL_NOTICE = 'notice';
    const MPI_LOGLEVEL_WARNING = 'warning';
    const MPI_LOGLEVEL_ERROR = 'error';

    public function getMetricFromCallback($name, $callback, $type = null)
    {
        $startTimer = microtime(true);

        $value = null;
        if (method_exists($this, $callback)) {
            $value = call_user_func(array($this, $callback));
        }

        $endTimer = microtime(true);

        $metric = $this->getMetric($name, $value, $type);
        $metric->setStartTime($startTimer);
        $metric->setEndTime($endTimer);

        return $metric;
    }

    public function getMetric($name, $value, $type = null)
    {
        $metric = Mage::getModel('mpi/metric');

        $metric->setName($name);
        $metric->setValue($value);

        if (!empty($type)) {
            $metric->setType($type);
        }

        return $metric;
    }

    public function initMagento()
    {
        // When Mage is found, assume Magento is already initialized
        if (class_exists('Mage')) {
            return true;
        }

        if (is_file('app/Mage.php') == false) {
            throw new Exception('Magento file not found');
        }

        $startTime = microtime(true);

        require_once 'app/Mage.php';
        Mage::app();
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

        $metric = $this->metric('magento::startup', round(microtime(true) - $startTime, 4));
        $metric->setGroup('group');
        $metric->setType('seconds');

        return $metric;
    }
}