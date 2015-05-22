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
class Yireo_Mpi_Model_Check
{
    protected $checkModels = array(
        'basic' => array(
            //'test',
            //'environment_basics',
            //'core_version',
            //'core_compiler',
            //'core_cache',
            //'core_session',
            'core_indexer',
        ),
        'database' => array(
            //'catalog',
        ),
        'security' => array(
            //'security_addhandler',
            //'security_shoplift',
        ),
    );

    public function getCheckModels()
    {
        return $this->checkModels;
    }

    public function getDataFromModels($checkModels)
    {
        $data = array();

        foreach ($checkModels as $checkModel) {
            $modelMetrics = $this->getDataFromModel($checkModel);
            $data = array_merge($data, array($checkModel => $modelMetrics));
        }

        return $data;
    }

    public function getDataFromModel($checkModel)
    {
        $modelName = 'mpi/check_' . $checkModel;
        $model = Mage::getModel($modelName);

        if (empty($model) || is_object($model) == false) {
            $this->log('Invalid check-model %s', $modelName);
            return array();
        }

        if (method_exists($model, 'getChecks') == false) {
            $this->log('Check-model %s has no getChecks() method', $modelName);
            return array();
        }

        $modelMetrics = $model->getChecks();

        if (is_array($modelMetrics) == false) {
            return array();
        }

        foreach($modelMetrics as $modelMetricIndex => $modelMetric) {
            if (is_object($modelMetric)) {
                $modelMetric = $modelMetric->export();
            }

            $modelMetrics[$modelMetricIndex] = $modelMetric;
        }

        return $modelMetrics;
    }

    public function getDataFromGroups($selectGroups = array())
    {
        $data = array();

        foreach ($this->checkModels as $checkModelGroupName => $checkModelGroup) {

            if(!empty($selectGroups) && in_array($checkModelGroupName, $selectGroups) == false) {
                continue;
            }

            $modelData = $this->getDataFromModels($checkModelGroup);
            $data = array_merge($data, $modelData);
        }

        return $data;
    }

    public function log($string, $variable1 = null, $variable2 = null)
    {
        $string = Mage::helper('mpi')->__($string, $variable1, $variable2);

        // @todo: Add option for debugging

        $logger = Mage::getModel('core/log_adapter', 'mpi.log');
        $logger->log($string);
    }
}