<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Check whether the site is offline or not.
 *
 */
class site_offline_hook {

    public function __construct()
    {
    	log_message('debug','Accessing site_offline hook!');
    }

    public function is_offline()
    {
	    if(file_exists(APPPATH.'config/config.php'))
	    {
	        include(APPPATH.'config/config.php');

	        if ((isset($config['is_offline'])) && ($config['is_offline']===TRUE) && (php_sapi_name() != "cli"))
	        {
		          $_error =& load_class('Exceptions', 'core');
		          echo $_error->show_error("", "", 'error_maintenance', 200);

		        exit;
	        }
	    }
    }

    private function show_site_offline()
    {
    	
    }

}