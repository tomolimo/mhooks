<?php

/**
 * Summary of Reminder
 * This class is a patch for GLPI Reminder default class
 * It is replacing the hooks that were previously used in Reminder class
 * pre_show_item and post_show_item
 */
class Reminder {
    /**
     * Summary of showForm
     * Hook for Reminder::showForm()
     * It will be executed into the Reminder class context
     * @param mixed $ID 
     * @param mixed $options 
     * @return mixed
     */
    function showForm( $ID, $options = array() ){
        if( $this->getFromDB($ID) && $this->can($ID,'w') ) {
            Plugin::doHook('pre_show_item', $this) ;
        }
        $ret = $this->plugin_mhooks_showForm_original( $ID, $options ) ;
        
        Plugin::doHook('post_show_item', $this) ;
        
        return $ret ;
    }
}