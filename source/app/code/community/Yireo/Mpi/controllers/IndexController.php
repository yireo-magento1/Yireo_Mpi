<?php
/**
 * Mpi extension for Magento
 *
 * @package     Yireo_Mpi
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

//print_r(Mage::app()->getRequest());

/**
 * Mpi admin controller
 *
 * @category   Mpi
 * @package     Yireo_Mpi
 */
class Yireo_Mpi_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Show some details
     */
    public function collectAction()
    {
        $this->authenticate();

        $groups = $this->getRequest()->getParam('group');
        if (!empty($groups)) {
            $groups = explode(',', $groups);
        }

        $metric = $this->getRequest()->getParam('metric');
        if (!empty($metric)) {
            $metric = preg_replace('/([^a-zA-Z0-9\-\_]+)/', '', $metric);
        }

        if (empty($metric)) {
            $data = Mage::getModel('mpi/check')->getCheckData($metric);
        } else {
            $data = Mage::getModel('mpi/check')->gatherCheckData($groups);
        }

        $this->sendOutput($data);
    }

    public function noRouteAction()
    {
        $data = array('error' => 'Action not found');
        $this->sendOutput($data);
    }

    public function indexAction()
    {
        $checkModels = Mage::getModel('mpi/check')->getCheckModels();

        $this->sendOutput($checkModels);
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
            $this->sendOutputAsJson($data);
        } elseif ($format == 'dump') {
            $this->sendOutputAsDump($data);
        }

        $this->getResponse()->sendResponse();
        $this->getRequest()->setDispatched(true);
    }

    /**
     * Print output as PHP dump
     *
     * @param $data
     */
    protected function sendOutputAsDump($data)
    {
        $this->getResponse()->setHeader('Content-type','text/html',true);
        Zend_Debug::dump($data);
    }

    /**
     * Print output as JSON
     *
     * @param $data
     */
    protected function sendOutputAsJson($data)
    {
        $this->getResponse()->setHeader('Content-type','application/json',true);
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($data));
    }

    /**
     * Authenticate access to this API
     *
     * @return bool
     */
    protected function authenticate()
    {
        if(Mage::helper('mpi')->authenticate()) {
            return true;
        }

        $data = array('error' => 'Access denied');

        $this->getResponse()->clearHeaders();
        $this->getResponse()->setHeader('HTTP/1.0','403 Forbidden',true);
        $this->getResponse()->setHeader('Content-type','application/json',true);
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($data));
        $this->getResponse()->sendResponse();
        $this->getRequest()->setDispatched(true);
    }
}
