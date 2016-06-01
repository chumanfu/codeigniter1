<?php


class Installer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
 
        // can only be called from the command line
        if (!$this->input->is_cli_request())
        {
			exit('Direct access is not allowed');
        }

        $this->load->helper('file');
    }


    private function _setMaintenanceMode($pOn, $pInstallDirectory)
    {
    	$string = "['is_offline'] = ";
    	$oldString = "TRUE;";
    	$newString = "FALSE;";

    	if ($pOn)
    	{
	    	$oldString = "FALSE;";
	    	$newString = "TRUE;";
    	}

		$path_to_file = $pInstallDirectory  . 'CIProject1/application/config/config.php';

		if (file_exists($path_to_file))
		{
			$file_contents = file_get_contents($path_to_file);
			$file_contents = str_replace($string . $oldString, $string . $newString, $file_contents);
			write_file($path_to_file,$file_contents);
		}

    }

    public function install($pInstallDirectory, $pVersion)
    {
    	$this->_setMaintenanceMode(true);

    	chdir('../../');

    	$this->_setMaintenanceMode(false);
    }

}