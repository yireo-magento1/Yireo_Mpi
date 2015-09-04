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
class Yireo_Mpi_Model_Resource_Abstract
{
    /**
     * Logging level: Notice
     */
    const MPI_LOGLEVEL_NOTICE = 'notice';

    /**
     * Logging level: Warning
     */
    const MPI_LOGLEVEL_WARNING = 'warning';

    /**
     * Logging level: Error
     */
    const MPI_LOGLEVEL_ERROR = 'error';

    /**
     * Collected metrics
     */
    protected $metrics = array();

    /**
     * @param $name
     * @param $callback
     * @param null $type
     *
     * @return false|Mage_Core_Model_Abstract
     */
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

    /**
     * @param $name
     * @param $value
     * @param null $type
     *
     * @return null
     */
    public function addMetric($name, $value, $type = null)
    {
        $this->metrics[] = $this->getMetric($name, $value, $type);
    }

    /**
     * @param $name
     * @param $value
     * @param null $type
     *
     * @return false|Mage_Core_Model_Abstract
     */
    public function getMetric($name, $value, $type = null)
    {
        $className = get_class($this);
        preg_match('/(.*)_Model_Resource_(.*)/', $className, $classMatch);
        $prefix = strtolower($classMatch[1]) . '/' . strtolower($classMatch[2]);
        $name = $prefix.'/'.$name;

        return $this->getGlobalMetric($name, $value, $type);
    }

    /**
     * @param $name
     * @param $value
     * @param null $type
     *
     * @return false|Mage_Core_Model_Abstract
     */
    public function getGlobalMetric($name, $value, $type = null)
    {
        /** @var Yireo_Mpi_Model_Metric $metric */
        $metric = Mage::getModel('mpi/metric');

        $metric->setName($name);
        $metric->setValue($value);

        if (!empty($type)) {
            $metric->setType($type);
        }

        return $metric;
    }

    /**
     * @param $name
     * @param null $filters
     *
     * @return int
     */
    protected function countCollection($name, $filters = null)
    {
        $collection = Mage::getModel($name)->getCollection();

        if(is_array($filters) && !empty($filters)) {
            foreach($filters as $filterName => $filterValue) {
                if (empty($filterName)) {
                    continue;
                }
                $collection->addAttributeToFilter($filterName, $filterValue);
            }
        }

        return $collection->getSize();
    }

    /**
     * @param $dir
     *
     * @return int
     */
    public function countFilesInDir($dir)
    {
        $dir = MAGENTO_ROOT.'/'.$dir;

        return count(glob($dir.'/*', GLOB_NOSORT));
    }

    /**
     * @param $file
     *
     * @return int
     */
    public function getFileSize($file)
    {
        $file = MAGENTO_ROOT.'/'.$file;

        if (file_exists($file) == false) {
            return 0;
        }

        return filesize($file);
    }

    /**
     * @param $string
     * @param null $variable1
     * @param null $variable2
     */
    public function log($string, $variable1 = null, $variable2 = null)
    {
        Mage::helper('mpi')->log($string, $variable1, $variable2);
    }
}
