<?php
/**
 * Mpi extension for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * MPI frontend controller
 *
 * @category   Mpi
 * @package     Yireo_Mpi
 */
class Yireo_Mpi_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Action to display a listing of resource models
     */
    public function indexAction()
    {
        if ($this->getHelper()->authenticate()) {
            return true;
        }

        $resourceModels = $this->getResourceModel()->getResourceModels();

        $this->sendOutput($resourceModels);
    }

    /**
     * Action to display of listing of collected resource metrics
     */
    public function collectAction()
    {
        $this->authenticate();

        $groups = Mage::helper('mpi')->getGroupsFromRequest();
        $metrics = Mage::helper('mpi')->getMetricsFromRequest();

        if (!empty($metrics)) {
            $data = $this->getResourceModel()->getDataFromModels($metrics);
        } else {
            $data = $this->getResourceModel()->getDataFromGroups($groups);
        }

        $this->sendOutput($data);
    }

    /**
     * Action to display a PHP info page
     */
    public function phpinfoAction()
    {
        if ($this->getHelper()->authenticate()) {
            return true;
        }

        echo phpinfo();
        exit;
    }

    /**
     * Action to handle unroutable actions
     *
     * @param null $coreRoute
     */
    public function norouteAction($coreRoute = null)
    {
        $data = array('error' => 'Route "'.$coreRoute.'" not found');
        $this->sendOutput($data);
    }

    /**
     * Print output
     *
     * @param $data
     */
    protected function sendOutput($data)
    {
        $this->getResponse()->clearHeaders();

        $format = $this->getRequest()->getParam('format');
        if (empty($format)) {
            $format = 'json';
        }

        if ($format == 'json') {
            return $this->sendOutputAsJson($data);
        } elseif ($format == 'dump') {
            return $this->sendOutputAsDump($data);
        }
    }

    /**
     * Print output as PHP dump
     *
     * @param $data
     */
    protected function sendOutputAsDump($data)
    {
        $this->getResponse()->setHeader('Content-type', 'text/html', true);
        ini_set('xdebug.var_display_max_children', 1024);
        Zend_Debug::dump($data);
    }

    /**
     * Print output as JSON
     *
     * @param $data
     */
    protected function sendOutputAsJson($data)
    {
        $this->getResponse()->setHeader('Content-type', 'application/json', true);
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($data));
    }

    /**
     * Authenticate access to this API
     *
     * @return bool
     */
    protected function authenticate()
    {
        if ($this->getHelper()->authenticate()) {
            return true;
        }

        $data = array('error' => 'Access denied');

        $this->getResponse()->clearHeaders();
        $this->getResponse()->setHeader('HTTP/1.0', '403 Forbidden', true);
        $this->getResponse()->setHeader('Content-type', 'application/json', true);
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($data));
        $this->getResponse()->sendResponse();
        $this->getRequest()->setDispatched(true);
        exit;
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
