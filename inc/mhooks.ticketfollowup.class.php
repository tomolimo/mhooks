<?php

/**
 * mhooks short summary.
 *
 * mhooks description.
 *
 * @version 1.0
 * @author MoronO
 */
class TicketFollowup {

    function showInTicketSumnary (Ticket $ticket, $rand, $showprivate) {
        Plugin::doHook('pre_show_item', $this) ;
        $this->plugin_mhooks_showInTicketSumnary_original( $ticket, $rand, $showprivate ) ;
        Plugin::doHook('post_show_item', $this) ;
    }

    function showFormButtons($options=array()) {
        $this->pluginOptions = $options ;
        Plugin::doHook('show_form_buttons', $this);
        $this->plugin_mhooks_showFormButtons_original($this->pluginOptions);
    }

    function showFormHeader($options=array()) {
        $this->pluginOptions = $options ;
        Plugin::doHook('show_form_header', $this);
        $this->plugin_mhooks_showFormHeader_original($this->pluginOptions);
    }
    
}
