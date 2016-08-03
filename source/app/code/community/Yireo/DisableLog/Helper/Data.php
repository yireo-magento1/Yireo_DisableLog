<?php
/**
 * Yireo DisableLog for Magento
 *
 * @package     Yireo_DisableLog
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2016 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * DisableLog helper
 */
class Yireo_DisableLog_Helper_Data extends Mage_Core_Helper_Abstract
{
    /** @var Mage_Core_Model_App */
    protected $app;
    
    /**
     * Yireo_EmailTester_Helper_Data constructor.
     */
    public function __construct()
    {
        $this->app = Mage::app();
    }
    
    /**
     * Helper-method to determine whether this module is enabled or not
     *
     * @return bool
     */
    public function enabled()
    {
        if ((bool)$this->getStoreConfig('advanced/modules_disable_output/Yireo_DisableLog')) {
            return false;
        }

        return (bool)$this->getStoreConfig('disablelog/settings/enabled');
    }

    /**
     * @param $value
     *
     * @return null|string
     */
    public function getStoreConfig($value)
    {
        return $this->app->getStore()->getConfig($value);
    }
}
