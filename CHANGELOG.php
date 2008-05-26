<?php
/**
* @version		$Id: CHANGELOG.php 10236 2008-04-22 20:47:06Z ircmaxell $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
1. Copyright and disclaimer
---------------------------
This application is opensource software released under the GPL.  Please
see source code and the LICENSE file


2. Changelog
------------
This is a non-exhaustive (but still near complete) changelog for
Joomla! 1.5, including beta and release candidate versions.
Our thanks to all those people who've contributed bug reports and
code fixes.


Legend:

* -> Security Fix
# -> Bug Fix
$ -> Language fix or change
+ -> Addition
^ -> Change
- -> Removed
! -> Note


-------------------- 1.5.3 Stable Release [22-April-2008] ---------------------

19-Apr-2008 Anthony Ferrara
 # [#10009] Search Function yields warning
 # [#10150] Installation minimum password length doesn't work
 # [#10725] Installation not xhtml compliant
 # [#10739] Spelling error in com_installer.ini
 # [#10092] Switcher hides nested divs
 # Fix for fatal error related to [#10638]

19-Apr-2008 Andrew Eddie
 ! Trailing white-space cleanup
 # [#9725] JFilterInput Infinite Loop

18-Apr-2008 Ian MacLennan
 # [#10732] Help screen updates for Menu Manager

18-Apr-2008 Sam Moffatt
 # [#10724] Custom user groups fail to display
 # [#10707] update link to forum in Sample content
 # [#10638] mod_newsflash renders article separator after last article

17-Apr-2008 Anthony Ferrara
 # [#9858] Flash Uploader not loading properly
 # [#10511] Print button showing Array Print Array
 # [#9775] Cache directory not writable causes warning
 # [#10588] QueryBatch executing empty queries
 # [#10675] Code Cleanup
 # [#10702] JURI::clean fix (not properly stripping out /'s) - Thanks Alex Stylianos
 # [#10308] Installer rejects valid DB names
 # [#10323] Wrong param count for class_exists in TCPDF

14-Apr-2008 Mati Kochen
 + Offline validation
 + Legacy-Marker - a marker to show (admin) extensions requiring Legacy-Mode ON

13-Apr-2008 Sam Moffatt
 # [#10639] mod_newsflash renders bad "read more" link text
 # [#10574] Problem with template rhuk_milkyway in white color variation.
 # [#10540] com_login not w3c valid
 # [#10539] Contacts string repeat twice in com_contacts language file
 # [#10510] /templates/beez/com_content/section/default.php
 # [#10302] Milky Way and Beez lack editor.css files
 # [#9984] Plugin parameters with pipes still not working perfectly
 # [#10402] Mainmenu Module issues
 # [#9977] Search module changing '-' to ':' in keywords
 # [#10097] Various XHTML fixes

10-Apr-2008 Anthony Ferrara
 # [#10508] Caching pathway and breadcrumbs fix
 # [#10329] Debug fails with version of Zend Optimizer

10-Apr-2008 Mati Kochen
 # [#10299] Added 'Use Global' as default value to weblink.xml

09-Apr-2008 Mati Kochen
 # [#10253] Better PDF coding

09-Apr-2008 Mati Kochen
 # [#10297] Fixed RTL in Offline message

04-Apr-2008 Toby Patterson
 # Fixed [#10307] "Select Article" breaks on change category refresh ( Thanks Michael )

03-Apr-2008 Toby Patterson
 # Fixed [#10197] component install error fails to reference left over folder in administrator/components folder
 # Fixed [#10200] jdoc:include type="module" not usable
 # Fixed [#10012] $task is not properly passed to extensions
 # Fixed [#10345] emailcloak is not removed if the article does not contain @

29-Mar-2008 Ian MacLennan
 # Fixed [#9335] Extra/Random table class (sectionentrytable0)

29-Mar-2008 Sam Moffatt
 ! Removed old TODO notice in installer

28-Mar-2008 Wilco Jansen
 # Fixed [9118] Uncaught Error message in Extension Manager when uninstalling deleted component
 ! Thanks Ian for the patch

26-Mar-2008 Toby Patterson
 # Fixed [9015] No .blank class in system general.css

-------------------- 1.5.2 Stable Release [22-March-2008] ---------------------

22-Mar-2008 Sam Moffatt
 $ Added ko-KR installation language files

21-Mar-2008 Sam Moffatt
 $ Added lt-LT, pl-PL and ca-ES installation language files

20-Mar-2008 Ian MacLennan
 $ Added bn-IN and th-TH installation language files

20-Mar-2008 Andrew Eddie
 # Fixed double-quoting bug in gacl_api::del_object

15-Mar-2008 Ian MacLennan
 # [#9816] Fixed openid toggle link doesn't appear on component.  Also fixes duplicate ids for com and mod.
 # [#9816] Fixed username cannot contain + or - characters
 # [#9816] Fixed css resulting from first patch above

15-Mar-2008 Sam Moffatt
 ^ Updated language XML files version to 1.5.2 and date to 2008-03-15 (pour JM)

12-Mar-2008 Ian MacLennan
 # [#10156] Param for disabling the Flash Uploader

11-Mar-2008 Anthony Ferrara
 # [#10077] Edit links for frontpage layout broken when not default menu item.

11-Mar-2008 Wilco Jansen
 # [10129] front-end message when article submitted not translated

10-Mar-2008 Wilco Jansen
 # [9971] Default parameter (global configuration) not stored in table
 # [9976] Invalid behavior after switching list length
 # [10112] Strings and tips added for 10019 editing options
 # [10124] Notice layout in milkyway is not right due to missing some css
 # [10071] Email alert for private message is confusing

09-Mar-2008 Mati Kochen
 # [#10083] Upgraded TCPDF Library to v2.6
 # [#10102] Removed unneeded IF clause for ICONV usage

08-Mar-2008 Andrew Eddie
 # [#10103] Additional Content Filtering

07-Mar-2008 Ian MacLennan
 # [#9808] JHTMLSelect::Options dies if empty array passed
 # [#10027] When bulit a menu with catalog list which catalog has no articles, error comes out when click this menu
 # [#10055] Administrator login not possible due to unmasked querys.

07-Mar-2008 Andrew Eddie
 # [#10032] JView::get() does not defer properly to JObject::get()
 # [#9641] Extra <ul /> added by mod_mainmenu in access restricted menus
 # [#10047] Size correction for some parameters pop-ups (patch)
 ^ Massmail BCC checkbox checked by default

05-Mar-2008 Ian MacLennan
 # [#9817] TableUser has sendEmail set to 1 by default instead of 0, while JUser has it set to 0 by default

04-Mar-2008 Anthony Ferrara
 # [#9964] lost password sends a bad link when Joomla is in a directory (Thanks Tomasz Dobrzynski)
 # [#10011] 2 Bugs in com_newsfeed
 # [#9828] Broken Links to blog items
 # [#8679] Incorrect anchors in pagination for admin template

01-Mar-2008 Alan Langford
 ^ Conditional load of JLoader to support unit test.
 + Add jexit() global exit function, also for unit test.
 ^ Replace all non-environment calls to die() and exit() with jexit() (except external libs).
 ^ Make die message on no _JEXEC defined consistent throughout.

29-Feb-2008 Toby Patterson
 # [#8775] Administration Toolbar translation issues

29-Feb-2008 Anthony Ferrara
 # Error Log Library overwriting $date var (fatal error)
 # [#9673] Media Manager + Global paths issues
 # [#9978] Alias URLs don't work when SEF enabled
 * Sanitization of image and media paths in global config
 # Fix for date in com_messages (Thanks Jens)

28-Feb-2008 Anthony Ferrara
 + JFactory::getDate
 + Support for locale based JDate override (for support of non-gregorian calendars)
 ^ Changed all calls from $date = new JDate() to $date =& JFactory::getDate();
 ^ JDate now does the translations on its own (it does not rely on setlocale()) for thread safe function.
 $ Added support for xx-XX.date.php in frontend language directories (to be used for non-gregorian calendars).
 ! all instances of JDate should now be retrieved via JFactory::getDate(); (to allow for overrides)
 # Notice with JTable::isCheckedOut when called statically
 # [#9832] [#9696] Invalid Itemid causes router to choke
 # [#7860] Cache Callback ID not reliable if callback is object
 # [#9715] Development info cached (also fixes tpl=1 case)
 # [#9421] Fix for INI parsing with | in the content
 $ [#9848] DESCNEWITEMSFIRST & LAST added to many places.
 # [#9377] Easier translation and localization
 # Upgrade TCPDF to 2.2.002 (Removes GD, libjpeg and libpng dependancies)
 # [#9968] Fix for router using default menu item vars if non-sef url passed when sef is enabled
 # [#9288] Title not escaped in link for section blog view

28-Feb-2008 Wilco Jansen
 # [9946] Page title issue for contents

28-Feb-2008 Sam Moffatt
 ^ Changed incorrect and misleading text in LDAP Authentication plugin

28-Feb-2008 Ian MacLennan
 # [#9402] Alternative read more
 # [#9909] Newsflash Module returns incorrect SEF URL
 # [#9847] JTable::isCheckedOut() can throw an undefined method error
 # [#9912] Error in sample data
 $ [#9967] 2 missing strings in admin
 # [#7960] JFilterInput

27-Feb-2008 Ian MacLennan
 # [#9648] Cache folder disapearing with legacy mode enabled
 # [#9805] bad url element for content pdf links]

26-Feb-2008 Ian MacLennan
 # [#9845] com_user Login form does not offer OpenId login option
 # [#9844] created date on openid created users is invalid
 # [#8676] OpenID related untranslated strings [js]

26-Feb-2008 Hannes Papenberg
 # [#9916] Saving Article Layout menu does not work

25-Feb-2008 Ian MacLennan
 # [#9932] Typo in file
 # [#9907] Code cleanup com_weblinks, <button> element improperly closed

25-Feb-2008Mati Kochen
 ^ [#9857] Updated TCPDF Library to support RTL - Thanks JM.

23-Feb-2008 Ian MacLennan
 # [#9778] Breadcrumb includes separators
 # [#9513] Search module in rhuk_milkyway - IE6
 # [#8547] Com_media: Unable to delete files with spaces
 # [#9862] Remember me can display confusing error message.


22-Feb-2008 Anthony Ferrara
 # Fix parse_str &amp; issues
 # [#9867] �Hardcoded strings + some errors (Thanks JM)

21-Feb-2008 Ian MacLennan
 # [#9840] •Hard coded string missing translation
 # [#9579] Contact Send-Email Form Routing to Wrong Address
 # [#9739] sefRelToAbs( 'http://localhost/index.php?option=com_content&view=frontpage&Itemid=1' ) returns wrong URL

20-Feb-2008 Ian MacLennan
 # [#9807] Notice error in lib/j/html/html/list.php, sign of bigger problem (thanks Jens)

19-Feb-2008 Anthony Ferrara
 # [#9534] Tooltips hidden behind some tabs
 # [#8800] Changing order of articles
 # [#9708] Styling of loadmodule plugin fix.
 # [#9710] mod_feed htmlentities issues.
 # [#9758] Frontend error message for checked out content partially translated

16-Feb-2008 Ian MacLennan
 # [9635] mod_random_image doesn't work as advertised
 # [8230] missing error handler on jfactory getxmlparser

15-Feb-2008 Ian MacLennan
 # [#8684] Errors not correctly trapped on login

14-Feb-2008 Ian MacLennan
 # [#9655] Cannot have more than 1 mootools tree on a page

13-Feb-2008 Ian MacLennan
 # [#9263] Bug in com_search: incorrect highliting of multiple search words
 # [#8738] Backend Login Problems--error message not shown when frontend or blocked user attempts login
 # [#9630] Language strings missing
 # [#9636] mod_banners cannot validate as XHTML 1.0 Strict
 # [#9289] reference to wrapper url produces errors when no modules are loaded
 # [#9719] JDate->toISO8601 suggestion/correction

12-Feb-2008 Ian MacLennan
 # [#9695] Invalid Token message received when trying to authenticate with OpenID
 # [#9006] Incorrect delete section message
 # [#9253] Incorrect caching time of the feed XML in mod_feed
 # [#9490] Fatal error: Call to a member function name() helper.php
 # [#8808] PDF from an article - "contributed by" isof "written by"
 # [#9555] Poll Manager poll's title sorting broken

12-Feb-2008 Anthony Ferrara
 # [#9697] Khepri has type="module" instead of type="modules" for Admin Submenu (Thanks Jens)

11-Feb-2008 Andrew Eddie
 $ Fixed string for XML-RPC server tip (default is no) in com_config.ini

10-Feb-2008 Ian MacLennan
 # Fixed [9371] h3 Title not translated at install step4 and 5
 # Fixed [9697] Khepri has type="module" instead of type="modules" for Admin Submenu

10-Feb-2008 Anthony Ferrara
 # Fixed issue with notice populating $live_site on upgrade from 1.5.0

10-Feb-2008 Sam Moffatt
 # Fixed [#9381] Misnamed variable errors in migration

09-Feb-2008 Ian MacLennan
 # Fixed [8602] Cookie error message in installation process
 # Fixed [9458] Email on new article - "from" is missing
 # Fixed [8368] Template preview shows only used module positions
 # Fixed [9434] Sample data: Two Resource Modules
 # Fixed [9690] Version number in administrator backend shows 1.5.0
 # Fixed [9312] Pre-installation Check wrongly recommends Display Errors ON
 # Fixed [9408] Articles don't change if you change a category to another section


-------------------- 1.5.1 Stable Release [8-February-2008] ---------------------

05-Feb-2008 Anthony Ferrara
 # Fixed [9552] Added missing DOMMIT files
 # Fixed [9620] When trying to login, the site returns 'Invalid Token'
 # Added live_site parameter to config, and JURI::base override (fixes SEF and proxy issues)

05-Feb-2008 Ian MacLennan
 # Fixed [9512] Removed superfluous references to JUser
 # Fixed [9596] Incorrect language string in Beez
 # Fixed [9257] Fixed comments in index.php and administrator/index.php
 # Fixed [9399] XMLRPC Blogger more_text tag problem
 * Fixed [9406] XMLRPC Blogger API

05-Feb-2008 Andrew Eddie
 # Turned XML-RPC server off by default

04-Feb-2008 Wilco Jansen
 # Fixed [9111] error.php contains a relative url to Home Page (Thanks Jens)
 # Fixed [9516] Links in archive module don't work with SEF (Thanks Jens)
 # Fixed [9211] Installation always falling back to joomla_backwards.sql (Thanks Jens)

01-Feb-2008 Ian MacLennan
 # Fixed [#9320] Problem with allowing HTML in requests [patch] (Thanks Jens)

01-Feb-2008 Anthony Ferrara
 * Fixed remote execution vulnerability in phpmailer
 # [#6730] batchQuery() Bug: Broken splitting function
 # [#8776] Mass Email BCC option (Thanks JM)

30-Jan-2008 Anthony Ferrara
 # Fixed htaccess instructions (refering to a second section that was removed)
 # [topic,257873] Fixed possible notice with com_content router
 # [#9518] When creating menu item for a poll, you cannot select poll (Thanks Ian MacLennan)
 # [#9383] Search for contacts generates bad links (Thanks Jens-Christian Skibakk)
 # [#9426] PopUp Url link broken

29-Jan-2008 Ian MacLennan
 # Fixed [#9342] Poll goes 404 after voting - fixed redirect URL.

28-Jan-2008 Anthony Ferrara
 # Fixed memcache session driver config param loading (changed it to work like cache driver)
 # [#9225] Typo in joomla_backwards.sql (Thanks Jens-Christian Skibakk)
 # [#8823] Modules don't show up when eAccelerator is enabled (Thanks Dalibor Karlovic)

28-Jan-2008 Robin Muilwijk
 # Fixed [#9472] Session not cleared properly
 # Fixed [#9291] Error in call method
 # Fixed [#9251] Additional double quote in weblink's template
 # Fixed [#8173] Problem with preg_quote in function utf8_ireplace

27-Jan-2008 Wilco Jansen
 ^ Remove the installation check
 # [9401] Help in backend showind 404 [Patch], thanks Jens-Christian Skibakk for the patch
 # [9412] publish_down is initialized to 1970 in some environments, thanks Kevin for the patch

-------------------- 1.5.0 Stable Release [21-January-2008] ---------------------

21-Jan-2008 Rob Schley
 ^ Updated COPYRIGHT.php to reference the new, consolidated CREDITS.php
 + Added LICENSES.php which will hold full text versions of other licenses.

17-Jan-2008 Anthony Ferrara
 + [8987] [8986] Added 3 Language strings to com_user and com_installer's language files (Thanks JM)
 # [9285] Administrators not being able to edit their own profile or change password

16-Jan-2008 Anthony Ferrara
 # Fixed session issues with Invalid Token randomly appearing
 # Fixed [9255] Error with Pagination and SEF (Thanks Jenscski)

15-Jan-2008 Wilco Jansen
 + Added language af-ZA and ar-DZ

15-Jan-2008 Andrew Eddie
 ^ Encapsulated public/non-public token logic into JUtility::getToken

14-Jan-2008 Wilco Jansen
 # Fixed [8874] Apostrophes transformed in html entities for page titles
 # Fixed [8673] Wrong encoding for "login redirection url" in user login parameters
 ^ Changed fa-IR langiage pack
 + Added tr-TR langiage pack
 ! Patch for 8874 and 8673 provided by Kevin Devine

14-Jan-2008 Andrew Eddie
 # Fixed inconsistend SQL in backward compat file (#__core_acl_aro_sections.section_id renamed to #__core_acl_aro_sections.id)

13-Jan-2008 Anthony Ferrara
 * [8739] Block user issues in administrator fix
 * [topic,252372] Security fix in com_users
 # [9126] [8702] Fixes for imagepath problems in categories:w
 # Fixed language issues
 # Added default alias for all items in core

12-Jan-2008 Wilco Jansen
 # Fixed [9194] No _JEXEC check in bigdump causes information disclosure if called directly

12-Jan-2008 Ian MacLennan
 # Fixed SEF issue for com_newsfeeds.
 # Removed incorrect line endings from some language files.
 # Fixed issue with page cache caching tokens.

11-Jan-2008 Ian MacLennan
 # Fixed SEF issue for com_poll, com_wrapper and com_search

11-Jan-2008 Wilco Jansen
 # Fixed [9032] cannot upload image
 # Fixed [9161] Media Manager - uploads doesn't work with flash tool
 ! Patch provided by Kevin Devine, thanks Kevin!
 ^ Changes language files for hr-HR, lt-LT, ro-RO, ru-RU
 + Added language files for eu-ES, hi-IN

11-Jan-2008 Ian MacLennan
 # Fixed bug in search where small words were not being filtered out properly
 # Fixed problem in search with regex using too many resources (related to above)
 # Fixed [#8404] Incorrect highlighting of search terms (as a byproduct)

10-Jan-2008 Sam Moffatt
 # Fixed error in backlink migration plugin
 # Fixed error with category/section search in front end
 # Fixed error with weblink search in back end
 # Fixed error with Legacy SEF incorrectly returning 404 page not found error

09-Jan-2008 Andy Miller
 # Fixed issues with pillmenu in both LTR and RTL directions

09-Jan-2008 Ian MacLennan
 # Fixed issue with incorrect building of section links in content router

07-Jan-2008 Johan Janssens
 # Fixed issue with JApplication::route wrongly assuming no route was found if no request variables are
   being returned and throwing a 404.

07-Jan-2008 Andrew Eddie
 # Changed form tokens to display different public and logged in values

05-Jan-2008 Rob Schley
 # Refactored routers for com_contact, com_weblinks, com_polls, and com_newsfeeds to be more reliable
   at finding configurations and to prevent duplicate content URL issues.

05-Jan-2008 Louis Landry
 # Fixed [#8228] Empty categories don't display when the show empty category parameter is selected (proposed solution)
 # Fixed [#8301] Memory consumption problems in com_search
 # Fixed [#8432] Mod_polls Validation: JS Unterminated String Literal--problems with quote marks in alias
 # Fixed [#8532] alias fields on menus and com_pool is not correctly sanitized can break links when sef on and cause other errors

05-Jan-2008 Charl van Niekerk
 # Fixed pagination in backend com_weblinks (similar issue as [#8718])
 # Fixed division by zero in com_weblinks frontend and backend if limit = 0

05-Jan-2008 Anthony Ferrara
 # [#8663] File path issues in media manager for IE6 and IE7 (Thanks Jens-Christian Skibakk)
 # [#8452] Mediamanager in IE6 shows one item in each row (Thanks Michal Sobkowiak)
 ^ Fix for pt-PT installation translation file error (from Translation team)

05-Jan-2008 Mati Kochen
 + Added missing POLL string
 - Removed unnecessary "
 ^ fixed locales again
 # [topic,249218] notice when showing subtree with no active parent (thanks trevornorth)

05-Jan-2008 Wilco Jansen
 ^ Updated the installer language files (thanks Ole for providing, thanks translators for creating these files)
 # Fixed [9019] Content of entryfield 'Style' of 'Image' -> 'Appearances' are not saved in Article Editor (Thanks Bruce Scherzinger)
 ! Make sure to save the plugin properties once of the tinymce editor!

05-Jan-2008 Andrew Eddie
 * SECURITY - Hardened escaping of user supplied text strings used in LIKE queries
 ^ Added extra arguments to JDatabase::Quote and JDatabase::getEscaped to facilitate hardening queries
 # Fixed [#8988] Legacy commonhtml.php bug
 # Fixed missing token in offline page

04-Jan-2008 Charl van Niekerk
 # Fixed pagination in backend com_content (similar issue as [#8718])

04-Jan-2008 Louis Landry
 # Fixed JDate issue with server offsets and daylight savings time as well as GMT output

04-Jan-2008 Jui-Yu Tsai
 # Fixed com_messages manager reset filter

04-Jan-2008 Mati Kochen
 ^ [topic,249292] Minor Typos in Sample Data
 # [topic,249199] Added 404 if no Route was found

04-Jan-2008 Alan Langford
 ^ Removed conditionals in loader.php, to revisit after upcoming release.

03-Jan-2008 Jui-Yu Tsai
 # Fixed [#8615][topic,240577] mod_newsflash "Read more..." parameter issue
 # Fixed [topic,248718] com_search gives an error under Beez template
 # Fixed [topic,248716] Author and date in beez template

03-Jan-2008 Anthony Ferrara
 # Fixed untranslated string in timezones (Thanks Ercan �zkaya)

03-Jan-2008 Andrew Eddie
 # Added JHTML::_( 'form.token' ) and JRequest::checkToken to assist in preventing CSRF exploits

03-Jan-2008 Alan Langford
 ^ Added conditionals to JLoader, __autoload(), jimport() to aid unit testing.

02-Jan-2008 Mati Kochen
 ^ Added UTF locales to en_GB.xml (admin/installation/site)

02-Jan-2008 Andrew Eddie
 # Fixed CSRF exploits in com_installer

02-Jan-2008 Toby Patterson
 # Fixed problem with JDocumentRendererAtom encoding links resulting in invalid urls ( & to &amp; )

02-Jan-2008 Robin Muilwijk
 # Fixed [#8969] Mod_sections missing parameter + patch
 # Fixed [#8828] htaccess does not include rewrite for .htm

02-Jan-2008 Sam Moffatt
 # Fixed radio button selection in com_installer
 ^ Removed administration/media tag from module installer

01-Jan-2008 Chris Davenport
 ^ Local help files replaced by dummy files containing links to online help.

01-Jan-2008 Johan Janssens
 ^ Changed JHTML::_() to support variable prefixes, type can now be prefix.class.function

01-Jan-2008 Wilco Jansen
 ^ Added also front-end language defaulting, see also #8307

01-Jan-2008 Mati Kochen
 # [#8750] Fixed Base URL sent by reminder mail

01-Jan-2008 Sam Moffatt
 ! Welcome to 2008, a great new year for Joomla!
 ^ Updates to the installation system to better handle some situations
 ^ Renamed a variable in the Joomla authentication plugin to make more sense
 # Fixes to prevent against uninitialised variable access in various locations

31-Dec-2007 Mati Kochen
 ^ [topic,247978] Added More Articles string, with corresponding fixes in files
 # [#8935] wrong comparisson for categories

31-Dec-2007 Charl van Niekerk
 # Fixed [#8516] xmlrpc throws errors when using third party blog/content entry tools
 ^ Changed mod_breadcrumbs individual module include to "breadcrumb" position include in rhuk_milkyway and beez
 ^ Renamed "breadcrumbs" position to "breadcrumb" in rhuk_milkyway

31-Dec-2007 Johan Janssens
 + Added scope variable to JApplication

30-Dec-2007 Wilco Jansen
 # Fixed [8307] Local distribs can't define default admin language

30-Dec-2007 Charl van Niekerk
 # Fixed [#8718] Frontend com_weblinks pagination error

30-Dec-2007 Mati Kochen
 # [#8568] Applied proposed fixes
 # [#8797] Added string to com_installer
 # [#7549] type of uninstall not translated
 # [#8901] changed copyright to 2008

30-Dec-2007 Anthony Ferrara
 ^ [#8901] Update copyright date needed in all trunk files
 # [#8736] 'limit' form field ignored in com_search
 ^ Added Istanbul to the timezone listings (Thanks Ercan �zkaya)

29-Dec-2007 Andy Miller
 # Fixed issue with admin login button with Safari

29-Dec-2007 Hannes Papenberg
 # [#8688] fixed pagination in com_categories

29-Dec-2007 Johan Janssens
 + Added transliterate function to JLanguage
 ^ JFilterOutput::stringURLSafe now calls JLanguage::transliterate

29-Dec-2007 Anthony Ferrara
 # [#8690] javascript popup: url not found (images directory incorrect)

29-Dec-2007 Mati Kochen
 ^ change width from 1000px to 960px (khepri)
 # [#8873] added BROWSE string
 # [#8867] fixed (Today) string
 # [#8576] added UNINSTALLLANGPUBLISHEDALREADY to com_installer with the correct call

28-Dec-2007 Hannes Papenberg
 # Fixed [#8229] If Intro Text is set to hide and no Fulltext is available, Intro Text is used as the fulltext

27-Dec-2007 Wilco Jansen
 ! Forgotten to credit Zinho for supplying us with information about the csrf exploit that was fixed
   during PBF weekend. Thanks Zinho for you issue report.

27-Dec-2007 Chris Davenport
 ^ Removed/renamed redundant local help screens.

26-Dec-2007 Nur Aini Rakhmawati
# Fixed [#6111] New button act as Edit when multiply select in Menu Item Manager
# Fixed [t,223403] Warning menu manager standardization for cancel button

25-Dec-2007 Nur Aini Rakhmawati
 # Fixed [#8557] language typo and ordering languange list (Thanks to Ole Bang Ottosen)

24-Dec-2007 Anthony Ferrara
 # Fixed [#8754] issue with SEF plugin rewriting raw anchors (Thanks Jens-Christian Skibakk)

24-Dec-2007 Jui-Yu Tsai
 # Fixed [#8568] language typo

23-Dec-2007 Rob Schley
 # Fixed JRegistryFormatINI::objectToString() method to build proper arrays again. Thanks Ian for testing.
 # Fixed view cache handler not storing module buffer.
 # Fixed JDocumentHTML::getBuffer() so that you can access the entire document buffer.

23-Dec-2007 Nur Aini Rakhmawati
 # Fixed [#8168] Removed Redundant code in Published Section. Thanks Alaattin Kahramanlar

22-Dec-2007 Johan Janssens
 + Added $params parameter to JEditor::display function. This allows to programaticaly set or override
   the editor plugin parameters.

22-Dec-2007 Andrew Eddie
 ^ Moved article edit icon into the print|pdf|email area
 + Added type property to JAuthenticationResponse which is set to the successful authenication method
 ^ Split diff.sql into steps for RC's

21-Dec-2007 Mati Kochen
 ^ [topic,245507] Better Styling with double classes & easier RTL

21-Dec-2007 Anthony Ferrara
 # [#8678] [#8675] [#8648] [topic,245507] Fixed min-width CSS issue forcing scrollbars

21-Dec-2007 Andrew Eddie
 # Fixed [topic,245313] Fatal error in Menu Manager when editing an item
 ! Lots of cosmetic commits (remove trailing ?> tags at EOF, white space, etc)

20-Dec-2007 Jui-Yu Tsai
 # [topic,245322] fixed missing "s" at string for more than one unit

20-Dec-2007 Mickael Maison
 # [#7617] Untranslated error message during authentication

20-Dec-2007 Mati Kochen
 ^ [topic,244583] added $rows = $this->items, and replaced all instaces
 ^ [topic,244213] added limitation to the return pagination only when there is one
 ^ [topic,244895] added missing content display
 ^ [topic,245291] refactor more links to use ContentHelperRoute

20-Dec-2007 Ian MacLennan
 # Fixed Topic 245155 Category Content Filter missing default parameter values in model

20-Dec-2007 Sam Moffatt
 # [#8444] Testing migration script on install - Scripts not executing (added display of current max PHP upload)
 # [#8517] com_installer: Installing from nonexisting URL generates technical error message
 ! SERVER_CONNECT_FAILED language added to com_installer
 ! MAXIMUM UPLOAD SIZE and UPLOADFILESIZE added to installation language
 # [#8628] Extension installer fails to remove media files (proposed solution)
 # [#8573] Google stuff still present in com_search

20-Dec-2007 Andrew Eddie
 # Fixed [t,243324] PHP 4 incompatible syntax in ContentModelArchive::_getList
 # Fixed extra <span> in Content Archive items layout
 # Fixed [#8667] bug in JDate

19-Dec-2007 Ian MacLennan
 # Fixed Content Router swallows up layout (checks to see if it matches Itemid)

19-Dec-2007 Ian MacLennan
 # Fixed topic 244449 XMLRPC Search plugin doesn't work with weblinks search plugin published

-------------------- 1.5.0 Release Candidate 4 Released [19-December-2007] ---------------------
