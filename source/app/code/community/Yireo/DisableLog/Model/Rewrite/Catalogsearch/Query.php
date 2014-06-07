<?php
/**
 * Yireo DisableLog for Magento 
 *
 * @package     Yireo_DisableLog
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (C) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_DisableLog_Model_Rewrite_Catalogsearch_Query extends Mage_CatalogSearch_Model_Query
{
    /**
     * Onject initialization
     */
    protected function setPopularity($popularity)
    {
        // If module is disabled
        if((bool)Mage::getStoreConfig('disablelog/settings/enabled') == false) {
            return parent::setPopularity($popularity);
        }
        
        // Disable search-hitting for user-agents
        $userAgent = Mage::helper('core/http')->getHttpUserAgent();
        $ignoreAgents = Mage::getConfig()->getNode('global/skip_user_agents');
        if ($ignoreAgents) {
            $ignoreAgents = $ignoreAgents->asArray();
            foreach($ignoreAgents as $ignoreAgent) {
                if (stristr($userAgent, $ignoreAgent)) {
                    return false;
                }
            }
        }

        return parent::setPopularity($popularity);
    }
}
