# mhooks
To provide more hooks to GLPI plugins using runkit integration.
In particular currently providing pre_show_item and post_show_item for Ticket, Computer and Reminder items

Added pre_show_item and post_show_item to TicketFollowup and CommonGLPI.
Added show_form_buttons and show_form_header to TicketFollowup (this is used by plugin TicketDocument: to come).

Currently tested with:
  GLPI 0.83, 0.85 and 0.90
  
  PHP 5.3, 5.4


# Pre-requisites:
This plugin needs 'runkit' PHP module.
For Windows you may refer to: https://github.com/Crack/runkit-windows (this is the one I'm using).
For others, you may find this PHP module in your distro (or you may re-compile it, refer to: https://github.com/zenovich/runkit).
