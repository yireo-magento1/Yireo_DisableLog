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
    /**
     * Helper-method to determine whether this module is enabled or not
     *
     * @return bool
     */
    public function enabled()
    {
        if ((bool)Mage::getStoreConfig('advanced/modules_disable_output/Yireo_DisableLog')) {
            return false;
        }

        return (bool)Mage::getStoreConfig('disablelog/settings/enabled');
    }
}
