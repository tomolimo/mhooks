<?php

/**
 * mhooks short summary.
 *
 * mhooks description.
 *
 * @version 1.0
 * @author MoronO
 */
class CommonGLPI {
    
       static function displayStandardTab(CommonGLPI $item, $tab, $withtemplate=0) {

           if( $tab != -1 )  {// in case of all tabs then will not call the hooks
               Plugin::doHook('pre_show_item', $item);
           }
           
           $ret = CommonGLPI::plugin_mhooks_displayStandardTab_original( $item, $tab, $withtemplate ) ;
           
           if( $tab != -1 ) {// in case of all tabs then will not call the hooks
               Plugin::doHook('post_show_item', $item);
           }

           return $ret ;

       }
}
