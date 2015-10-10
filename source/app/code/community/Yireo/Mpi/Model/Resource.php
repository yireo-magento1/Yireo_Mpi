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
 * Main resource class to identify and collect resources from subclasses
 */
class Yireo_Mpi_Model_Resource
{
    /**
     * Associative array of resource classes, grouped by collector class
     *
     * @var array
     */
    protected $resourceModels = array(
        'test' => array(
            'test',
        ),
        'all' => array(
            'attribute_listing',
            'core_attribute',
            'core_cache',
            'core_catalog',
            'core_compiler',
            'core_configuration',
            'core_customer',
            'core_indexer',
            'core_module',
            'core_rules',
            'core_sales',
            'core_session',
            'core_store',
            'core_version',
            'environment_basics',
            'environment_log',
            'environment_report',
            'environment_session',
            'php_basics',
            'php_configuration',
            'php_module',
            'security_addhandler',
            'security_admin',
            'security_get',
            'security_shoplift',
            'security_phpinfo',
            'security_xmlrpc',
            'webserver_advanced',
            'webserver_basics',
            'database_basics',
            'database_status',
            'database_table',
            'database_variable',
        ),
        'poll_short' => array(
            'database_status',
        ),
        'poll_long' => array(
            'database_status',
        ),
    );

    /**
     * @return array
     */
    public function getResourceModels()
    {
        $resourceModelGroups = $this->resourceModels;

        foreach ($resourceModelGroups as $resourceModelGroupName => $resourceModelGroup) {
            foreach($resourceModelGroup as $resourceModel) {
                if (preg_match('/^([a-z]+)_/', $resourceModel, $match)) {
                    $newGroup = $match[1];
                    if (!isset($resourceModelGroups[$newGroup])) {
                        $resourceModelGroups[$newGroup] = array();
                    }

                    $resourceModelGroups[$newGroup][] = $resourceModel;
                }
            }
        }

        // Add an event to allow for third party extensions to extend this array
        Mage::dispatchEvent('mpi_list_resource_models', array('resourceModels' => $resourceModelGroups));

        return $resourceModelGroups;
    }

    /**
     * @param $resourceModels
     *
     * @return array
     */
    public function getDataFromModels($resourceModels)
    {
        $data = array();

        foreach ($resourceModels as $resourceModel) {
            $modelMetrics = $this->getDataFromModel($resourceModel);
            $data = array_merge($data, array($resourceModel => $modelMetrics));
        }

        return $data;
    }

    /**
     * @param $resourceModel
     *
     * @return array|mixed
     */
    public function getDataFromModel($resourceModel)
    {
        $modelName = 'mpi/resource_' . $resourceModel;
        $model = Mage::getModel($modelName);

        if (empty($model) || is_object($model) == false) {
            $this->log('Invalid resource-model %s', $modelName);
            return array();
        }

        if (method_exists($model, 'getData') == false) {
            $this->log('Resource-model %s has no getData() method', $modelName);
            return array();
        }

        //Mage::log('[Yireo_Mpi] '.$modelName);
        $modelMetrics = $model->getData();

        if (is_array($modelMetrics) == false) {
            return array();
        }

        foreach($modelMetrics as $modelMetricIndex => $modelMetric) {
            if (is_object($modelMetric)) {
                /** @var Yireo_Mpi_Model_Metric $modelMetric */
                $modelMetric = $modelMetric->export();
            }

            $modelMetrics[$modelMetricIndex] = $modelMetric;
        }

        return $modelMetrics;
    }

    /**
     * @param array $selectGroups
     *
     * @return array
     */
    public function getDataFromGroups($selectGroups = array())
    {
        $data = array();

        foreach ($this->getResourceModels() as $resourceModelGroupName => $resourceModelGroup) {

            if(!empty($selectGroups) && in_array($resourceModelGroupName, $selectGroups) == false) {
                continue;
            }

            $modelData = $this->getDataFromModels($resourceModelGroup);
            $data = array_merge($data, $modelData);
        }

        return $data;
    }

    /**
     * Shortcut for logging
     *
     * @param $string
     * @param null $variable1
     * @param null $variable2
     */
    public function log($string, $variable1 = null, $variable2 = null)
    {
        /** @var $helper Yireo_Mpi_Helper_Data */
        $helper = Mage::helper('mpi');
        $helper->log($string, $variable1, $variable2);
    }
}
