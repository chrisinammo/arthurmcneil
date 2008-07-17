<?php 
/*
**********************************************
JCal Pro v1.5.3
Copyright (c) 2006-2007 Anything-Digital.com
**********************************************
JCal Pro is a fork of the existing Extcalendar component for Joomla!
(com_extcal_0_9_2_RC4.zip from mamboguru.com). 
Extcal (http://sourceforge.net/projects/extcal) was renamed 
and adapted to become a Mambo/Joomla! component by 
Matthew Friedman, and further modified by David McKinnis
(mamboguru.com) to repair some security holes. 

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version.

This header must not be removed. Additional contributions/changes
may be added to this header as long as no information is deleted.
**********************************************

$File: theme.php - All templates and other theme related codes$

Revision date: 02/20/2007

**********************************************
Get the latest version of JCal Pro at:
http://dev.anything-digital.com/
**********************************************
*/

/** ensure this file is being included by a parent file */
defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );

require( $CONFIG_EXT['LIB_DIR']."class.phpmailer.php" );

class extcalMailer extends phpmailer {
    // Set default variables for all new objects

    var $Mail = false;
    var $Host = "";

    var $From     = "";
    var $FromName = "";
    var $CharSet = "";

    var $Mailer   = ""; // Method to send mail: ("mail", "sendmail", or "smtp").

    var $WordWrap = 75;
		var $Sender = "";

		function extcalMailer() {
      // defining the constructor
	    global $CONFIG_EXT, $global_vars, $lang_info;
	    
      $this->CharSet = $CONFIG_EXT['charset'] == 'language-file' ? $lang_info['charset'] : $CONFIG_EXT['charset'];
      $this->From = $CONFIG_EXT['calendar_admin_email'];
      $this->FromName = $CONFIG_EXT['app_name'];

      $this->WordWrap = 0;
      $this->Helo = "localhost.localdomain";

			switch($CONFIG_EXT['mail_method']) {
				case 'smtp':
					$this->IsSMTP();
					break;
				case 'mail':
					$this->IsMail();
					break;
				case 'sendmail':
					$this->IsSendmail();
					break;
				case 'qmail':
					$this->IsQmail();
					break;
				default:
					$this->IsMail(); // use php mail() by default
			}

      $this->Host = $CONFIG_EXT["mail_smtp_host"];
      //$this->Port = 25;
      $this->SMTPAuth = (int)$CONFIG_EXT['mail_smtp_auth']?true:false; // Sets SMTP authentication. 
      												 //Utilizes the Username and Password variables if set to true
      $this->Username = $CONFIG_EXT['mail_smtp_username'];
      $this->Password = $CONFIG_EXT['mail_smtp_password'];
      //$this->PluginDir = $INCLUDE_DIR;
			
			$this->Sender = $CONFIG_EXT['calendar_admin_email'];
			
			$this->SMTPDebug = (int)$CONFIG_EXT['debug_mode']>0?true:false;
 			
			
		}

		/*
    // Replace the default error_handler
    function error_handler($msg) {
        echo "Site Error";
        echo "Description:";
        printf("%s", $msg);
        exit;
    }
    */

}

?>