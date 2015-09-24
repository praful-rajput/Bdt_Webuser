<?php

class Bdt_Webuser_Helper_Data extends Mage_Core_Helper_Abstract
{
    
   public function getLoggedUserRole(){

       $adminUserId = Mage::getSingleton('admin/session')->getUser()->getUserId();
       $storeIds = array();
       foreach(Mage::app()->getWebsites() as $website){

           if(trim(strtolower($website->getName())) == strtolower(trim(Mage::getModel('admin/user')->load($adminUserId)->getRole()->getRoleName())))
           {
               foreach ($website->getGroups() as $group) {
                   $stores = $group->getStores();
                   foreach ($stores as $store) {
                     $storeIds[] =  $store->getId();
                   }
               }
           }
       }
       if(count($storeIds))
           return $storeIds;
       else
           return false;
   }
}