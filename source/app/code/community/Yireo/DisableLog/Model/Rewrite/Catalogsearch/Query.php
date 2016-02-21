<?php
/**
 * Yireo DisableLog for Magento 
 *
 * @package     Yireo_DisableLog
 * @author      Yireo (https://www.yireo.com/)
 * @copyright   Copyright 2016 Yireo (https://www.yireo.com/)
 * @license     Open Source License (OSL v3)
 */

class Yireo_DisableLog_Model_Rewrite_Catalogsearch_Query extends Mage_CatalogSearch_Model_Query
{
    /**
     * Onject initialization
     */
    public function setPopularity($popularity)
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
