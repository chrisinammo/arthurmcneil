<?php
/**
 * Events Component for Joomla 1.0.x
 *
 * @version     $Id: README_en.php 854 2007-07-24 06:56:59Z geraint $
 * @package     Events
 * @copyright   Copyright (C) 2006 JEvents Project Group
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

// Readme Events - english language

defined( '_VALID_MOS' ) or die( 'No Direct Access'); 

// required during install!
global $mosConfig_absolute_path;
include_once($mosConfig_absolute_path."/administrator/components/com_events/lib/version.php");

$version = EventsVersion::getInstance();
?>
<style type="text/css" media="screen">
    <!--
    h1 {
        color           : #30559C;
        font-size       : 112%;
        border-left     : 25px solid #30559C;
        border-bottom   : 1px solid #30559C;
        padding         : 0 0 2px 5px;
        width			: 95%;
        text-align		: left;
    }
    pre {
        color   		: #FF0000;
    }
    .text {
    	color			: #666666;
    	text-align		: left;
    	margin			: 10px;
    }
    hr {
    	border-bottom   : 1px solid #30559C;
    }
    .tip {
    	color			: #FF0000;
    	font-weight     : bold;
    }
    .ads {
        white-space 	: pre;
        border      	: 1px solid #336699;
        padding     	: 5px;
        margin      	: auto;
        width       	: 750px;
        background  	: #F9FDFF;
        text-align  	: center;
        clear			: both;
    }
    .hint {
        background  	: #FFDDDD;
        border      	: 1px solid #FF0000;
        margin      	: 5px;
        padding     	: 5px;
    }
    .highlight {
    	color           : #30559C;
    	font-weight     : bold;
    }
    .docinfo {
    	font-size		: 9pt;
    	color			: #666666;
    }
    -->
</style>
<h1>JEvents - Event Managment at its easiest!</h1>
<div class="text">
	<ul>
		<li>Version <?php echo $version->getShortVersion();?> - <a href="http://developer.joomla.org/sf/projects/jevents" target="_blank" title="Project Website">Project Website</a></li>
		<li><?php echo $version->getLongCopyright();?></li>
		<li>Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell</li>
		<li>Requirement: <a href="http://developer.joomla.org" target="_blank" title="Joomla">Joomla</a> 1.x</li>
		<li>License: GNU/GPL <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank" title="License">License</a></li>
		<li>Website: <a href="http://developer.joomla.org/sf/projects/jevents" target="_blank" title="JEvents">JEvents</a></li>
		<li>Support: <a href="http://developer.joomla.org/sf/projects/jevents" target="_blank" title="JEvents">JEvents</a></li>
		<li>Email: <a href="http://developer.joomla.org/sf/projects/jevents" target="_blank" title="JEvents">JEvents</a></li>
	</ul>
	<hr />

    <div>
    	JEvents is an add-on for Joomla! to manage and display Events. The key features are:
    	<ol>
    		<li>Easy to manage from the backend</li>
    		<li>Create as many events as you want</li>
    		<li>Events categorised in customisable categories</li>
    		<li>Highly effective visual representation of events and categories as calendars or lists</li>
    		<li>Events can be one-off or repeat daily, weekly, monthly and yearly with many specialised options available</li>
    	</ol>
    </div>
    <div>
        <span class="highlight">JEvents</span> consists of 3 parts:
        <ul>
        	<li>Component        	</li>
        	<li>Modules
        		<ul>
        			<li>Events Calendar</li>
        			<li>Latest/Upcoming Events</li>
        			<li>Events Legend</li>
        		</ul>
        	</li>
        	<li>Mambots
        		<ul>
        			<li>Search bot : To allow Joomla to search through your events</li>
        			<li>Event Report bot : To automatically create links to event reports or photo albums after an event has occured</li>
        		</ul>
        	</li>
        </ul>
    </div>
    <div class="hint">
        <span class="tip">Tip</span>To display your events in the sidebar, you have to install the additional
        JEvents-Module (Minicalender), otherwise the events can only be displayed in the mainframe
    </div>
    <div>
    	The Modules and Mambots are additional downloads which must be installed separately.
    </div>
    <div>
    	<span class="highlight">Changelog</span>
   		<div style='font-weight:bold'>version 1.4.0</div>
    	<ul>
            <li>Backend now multilingual</li>
            <li>Backend changed to latest core routines</li>
            <li>Title of events can be truncated if too long (Frontend)</li>
            <li>Additional help texts (Backend)</li>
            <li>Menutext in userlanguage (Backend</li>
            <li>Many bugfixes</li>
            <li>XHTML-Conform display</li>
        </ul>
    	<div style='font-weight:bold'>version 1.3.x_beta</div>
    	<ul>
            <li>Activation of cache (performance)</li>
            <li>Joomfish compatible</li>
            <li>Slovene, Finnish, Danish, Greek added</li>
            <li>Spanish improved</li>
            <li>Allow publishing of events from frontend</li>
            <li>Description of activity not required any more</li>
            <li>Publish events from the frontend</li>
            <li>some bugfixes</li>
        </ul>
    </div>
    <div>
    	Contributors:<br />
		Sven-Erik Andersen, Sasho Dimitrov, Eva Estevez, Luis Guerra, Dainius Jarutis, Ivo Larys, Mat Leinmueller,
		Arthur van der Molen, Thomas Nilsson, sakara, Markku Suominen, Martin Welen, David A. Quirantes Garcia,
		Pedro Lopez Penalosa, Geraint Edwards, Thoma Stahl, mic and many more .....
	</div>
    <hr />
    <div class="docinfo">Doc.Revision: 1.0.1 - 04 Sep 2006</div>
</div>
