<?php
/**
 * Yireo DisableLog for Magento 
 *
 * @package     Yireo_DisableLog
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

/**
 * DisableLog helper
 */
class Yireo_DisableLog_Helper_Data extends Mage_Core_Helper_Abstract
{
    /*
     * Helper-method to determine whether this module is enabled or not
     *
     * @access public
     * @param null
     * @return bool
     */
    public function enabled()
    {
        return (bool)Mage::getStoreConfig('disablelog/settings/enabled');
    }
}
