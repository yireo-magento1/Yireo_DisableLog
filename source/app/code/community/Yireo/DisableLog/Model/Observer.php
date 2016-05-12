<?php
/**
 * Yireo DisableLog
 *
 * @author Yireo
 * @package DisableLog
 * @copyright Copyright 2016
 * @license Open Source License (OSL v3)
 * @link https://www.yireo.com
 */

/**
 * DisableLog observer to various Magento events
 */
class Yireo_DisableLog_Model_Observer extends Mage_Core_Model_Abstract
{
    /**
     * Method fired on the event <controller_action_predispatch>
     *
     * @param Varien_Event_Observer $observer
     * @return Yireo_DisableLog_Model_Observer
     */
    public function controllerActionPredispatch($observer)
    {
        // Run the feed
        if (Mage::helper('core')->isModuleEnabled('adminnotification')) {
            Mage::getModel('disablelog/feed')->updateIfAllowed();
        }
    }
}
