<?php
/*
 *
 *  */

// ----------------------------------------------------------------------
// Original Author of file: Olivier Moron
// Purpose of file: to provide runkit integration to GLPI plugins
// ----------------------------------------------------------------------

function initRunkit( $runkitDef ) {
    foreach($runkitDef as $classname => $fcts) {
        // not needed as method_exists is doing the autoload // $tkt = new $classname; // to force autoload of class
        // copy phase
        // copy the original methods to backups
        $ret = false ;
        foreach( $fcts as $fctname ) {
            $ret = method_exists( $classname, "plugin_mhooks_".$fctname."_original" ) ;
            if( !$ret ) // method doesn't exist must copy it
                $ret = runkit_method_copy( $classname, "plugin_mhooks_".$fctname."_original", $classname, $fctname ) ;
            if( !$ret ) // either can't copy method either an error occured during copy
                break ;
        }
        // load new class definition only ther is no error at copy phase
        if( $ret ) {
            $ret = runkit_import( strtolower( "inc/mhooks.$classname.class.php" ), RUNKIT_IMPORT_CLASSES | RUNKIT_IMPORT_OVERRIDE ) ;
        }

    }
} 


function plugin_init_mhooks() {
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS['csrf_compliant']['mhooks'] = true;

   $plug = new Plugin ;
   if ($plug->isActivated('mhooks')) {
       initRunkit(   array( 'Ticket' => array( 'showForm' ),
                            'Computer' => array( 'showForm' ) ,
                            'Reminder' => array( 'showForm' ) 
                          ) 
                 ) ;
   }

}

// Get the name and the version of the plugin - Needed
function plugin_version_mhooks() {
   return array(
      'name' => "More Hooks",
      'version' => "1.0.0",
      'license' => "GPLv2+",
      'author' => "Olivier Moron",
      'minGlpiVersion' => "0.83+"
   );
}

// Optional : check prerequisites before install : may print errors or add to message after redirect
function plugin_mhooks_check_prerequisites() {
   if (version_compare(GLPI_VERSION, '0.83', 'lt')) {
      echo "This plugin requires GLPI >= 0.83";
      return false;
   }
   if (!extension_loaded('runkit')) { // Your configuration check
       echo "PHP 'runkit' module is needed to run 'mhooks' plugin, please add it to your php config.";
       return false;
   }
   return true;
}

// Check configuration process for plugin : need to return true if succeeded
// Can display a message only if failure and $verbose is true
function plugin_mhooks_check_config($verbose = false) {
   global $LANG;

   if (extension_loaded('runkit')) { // configuration check
      return true;
   } 

   if ($verbose) {
      echo "PHP 'runkit' module is needed to run 'mhooks' plugin, please add it to your php config.";
   }

   return false;
}

