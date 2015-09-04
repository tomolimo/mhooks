<?php

/**
 * Summary of Computer
 * This class is a patch for GLPI Computer default class
 * It is replacing the hooks that were previously used in Computer class
 * pre_show_item and post_show_item
 */
class Computer {
    /**
     * Summary of showForm
     * Hook for Computer::showForm()
     * It will be executed into the Computer class context
     * @param mixed $ID 
     * @param mixed $options 
     * @return mixed
     */
    function showForm( $ID, $options=array() ){
        if( $this->getFromDB($ID) && $this->can($ID,'w') ) {
            Plugin::doHook('pre_show_item', $this) ;
        }
        $ret = $this->plugin_mhooks_showForm_original( $ID, $options ) ;
        
        Plugin::doHook('post_show_item', $this) ; // previously was null: don't know why?
        
        return $ret ;
    }
}