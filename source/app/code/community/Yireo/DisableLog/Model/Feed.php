<?php
/**
 * Yireo Common
 *
 * @author Yireo
 * @package Yireo_Common
 * @copyright Copyright 2016
 * @license Open Source License (OSL v3) (OSL)
 * @link https://www.yireo.com
 */

/**
 * Feed Model
 */
class Yireo_DisableLog_Model_Feed extends Mage_AdminNotification_Model_Feed
{
    /**
     * Helper name
     */
    const HELPER_NAME = 'disablelog';

    /**
     * Return the feed URL
     */
    protected $customFeedUrl = 'https://www.yireo.com/extfeed?format=feed&platform=magento&extension=disablelog';

    /**
     * @var Mage_Admin_Model_Session
     */
    protected $session;

    /**
     * @var Yireo_DisableLog_Helper_Data
     */
    protected $helper;

    /**
     * @var Mage_Core_Model_Store
     */
    protected $store;

    /**
     * Init model
     *
     */
    protected function _construct()
    {
        $this->store = Mage::app()->getStore();
        $this->session = Mage::getSingleton('admin/session');
        $this->helper = Mage::helper(self::HELPER_NAME);
    }

    /**
     * Return the feed URL
     *
     * @return string
     */
    public function getFeedUrl()
    {
        return $this->customFeedUrl;
    }

    /**
     * Try to update feed
     *
     * @return bool
     */
    public function updateIfAllowed()
    {
        // Is this the backend
        if ($this->store->isAdmin() == false) {
            return false;
        }

        // Is the backend-user logged-in
        if ($this->session->isLoggedIn() == false) {
            return false;
        }

        // Is the feed disabled?
        if ((bool)$this->helper->getStoreConfig('yireo/common/disabled')) {
            return false;
        }

        // Update the feed
        $this->checkUpdate();
        return true;
    }

    /**
     * Override the original method
     *
     * @return SimpleXMLElement
     */
    public function getFeedData()
    {
        // Get the original data
        $feedXml = parent::getFeedData();

        if ($feedXml && $feedXml->channel && $feedXml->channel->item) {
            foreach ($feedXml->channel->item as $item) {

                // Add the severity to each item
                $feedXml->channel->item->severity = Mage_AdminNotification_Model_Inbox::SEVERITY_NOTICE;
            }
        }

        return $feedXml;
    }
}
