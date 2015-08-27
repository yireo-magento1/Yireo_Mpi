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
 * Get core versioning
 */
class Yireo_Mpi_Model_Resource_Core_Module extends Yireo_Mpi_Model_Resource_Abstract
{
    protected $modulesCount = 0;

    protected $modulesCountActive = 0;

    protected $modulesCountActiveNoncore = 0;

    /**
     * Return all data of this class
     *
     * @return array
     */
    public function getData()
    {
        $modules = $this->getModules();

        $this->addMetric('extensions', $modules, 'array');
        $this->addMetric('extensions_count_total', $this->modulesCount);
        $this->addMetric('extensions_count_active', $this->modulesCountActive);
        $this->addMetric('extensions_count_active_3po', $this->modulesCountActiveNoncore);

        return $this->metrics;
    }

    /**
     * @return array
     */
    public function getModules()
    {
        $modules = Mage::getConfig()->getNode('modules')->children();

        $modulesResult = array();

        foreach ($modules as $moduleName => $module) {

            $this->modulesCount++;
            $module = (array)$module;
            $module['name'] = $moduleName;

            if (empty($module['codePool'])) {
                $module['codePool'] = 'unknown';
            }

            if ($module['active'] == true) {
                $this->modulesCountActive++;
                if ($module['codePool'] != 'core') {
                    $this->modulesCountActiveNoncore++;
                }
            }

            if (isset($module['depends'])) {
                unset($module['depends']);
            }

            $modulesResult[] = $module;
        }

        return $modulesResult;
    }
}
