<?php
// JCal Admin Controller
jimport( 'joomla.application.component.controller' );

class JCalProController extends JController {
    function execute( $task ) {
        $option = JRequest::getVar('option');
        $cid = JRequest::getVar( 'cid', array(0), '', 'array' );
        JArrayHelper::toInteger($cid, array(0));
        switch ( $task ) {
            case 'theme':
                $theme = JRequest::getVar( 'theme' );

                $file  = JRequest::getVar( 'file' );
                $path  = 'plugins'.DS.'editors'.DS.'jce'.DS.'jscripts'.DS.'tiny_mce'.DS.'themes' .DS. $theme . '/' . $file;
                include_once JPATH_BASE . DS . $path;
                break;

            case 'main':
                // Look like this is never used (!?)
                $view = &$this->getView( 'Main' );
                $view->display();
                //HTML_JCEAdmin::showAdmin();

                break;

            case 'save':
                saveconfig();

                break;

            case 'config':
                global $client, $eid, $mainframe;

                $mainframe->redirect(
                    'index2.php?option=com_mambots&client=' . $client . '&task=editA&hidemainmenu=1&id=' . $eid . '' );
                break;

            case 'editlayout':
                global $client, $eid;

                editLayout( $option, $client );
                break;

            case 'savelayout':
                saveLayout( $option, $client );

                break;

            case 'applyaccess':
                applyAccess( $cid, $option, $client );

                break;

            case 'showthemes':
            case 'themes':
                global $client, $eid;
                include_once JPATH_COMPONENT_ADMINISTRATOR . DS . 'themes' . DS . 'themes.php';
                viewThemes( $option, $client );
                break;

            case 'default':
                defaultTemplate( $cid[0], $option, $client );

                break;

            case 'newtheme':
            case 'edittheme':
            //editThemes( $option, $id, $client );
            break;

            case 'savetheme':
            case 'applytheme':
                saveThemes( $option, $client, $task );

                break;

            case 'canceledit':
                cancelEdit( $option, $client );

                break;

            case 'removetheme':
                removeTheme( $cid[0], $option, $client );

                break;

            case 'installtheme':
                global $client, $mainframe;

                $mainframe->redirect( 'index2.php?option=com_jcalpro&client=' . $client . '&task=install&element=themes' );
                break;

            case 'install':
                global $client, $eid;

                $CONFIG_EXT['ADMIN_PATH'] = JPATH_COMPONENT_ADMINISTRATOR; // Your admin file system path

                extcalInstaller( $option, $client, 'show' );
                break;

            case 'uploadfile':
                extcalInstaller( $option, $client, 'uploadfile' );

                break;

            case 'installfromdir':
                extcalInstaller( $option, $client, 'installfromdir' );

                break;

            case 'remove':
                extcalInstaller( $option, $client, 'remove' );

                break;

            case 'categories':
                $this->switchToCategoriesPage();

                break;

            case 'newCategory':
                $this->newCategory( $option );
                break;

            case 'editCategory':
                $cat_id = JRequest::getInt('cat_id');
                $this->editCategory( $cat_id, $option );

                break;

            case 'saveCategory':
                $this->saveCategory( $option );

                break;

            case 'cancelEditCategory':
                $this->cancelEditCategory( $option );

                break;

            case 'showCategories':
                $this->showCategories( $option );

                break;

            case 'deleteCategories':
                $this->deleteCategories( $option, $cid );

                break;

            case 'publish':
                $this->publishCategories( $option, $cid, 1 );

                break;

            case 'unpublish':
                $this->publishCategories( $option, $cid, 0 );

                break;

            case 'editSettings':
                $this->editSettings( $option );
                break;

            case 'saveSettings':
                $this->saveSettings( $option );
                break;

            case 'cancelEditSettings':
                $this->cancelEditSettings( $option );
                break;

            case 'about':
                $this->showSettings( $option );
                break;

            case 'documentation':
                $this->documentation( $option );
                break;

            case 'import':
                $this->import( $option );

                break;

            case 'importCalendar':
                $this->importCalendar( $option );

                break;

            default:
                require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.jcalpro.html.php');
                HTML_extcalendar::showAdmin();

                break;
        }
        }

    function switchToCategoriesPage() {
        global $mainframe;
        $mainframe->redirect( 'index2.php?option=com_jcalpro&task=showCategories' );
    }

    function import() {
        global $mainframe, $mosConfig_lang, $mosConfig_db, $mosConfig_dbprefix;
        $database =&JFactory::getDBO();
        $registery =& JFactory::getConfig();
        $mosConfig_lang = $registery->lang;
        $mosConfig_db = $registery->db;
        $mosConfig_dbprefix = $registery->dbprefix;
        

        $query = "show tables";
        $database->setQuery( $query );

        $database->query();

        $rows = $database->loadObjectList();

        $cals = array();

        foreach ( $rows as $key => $value ) {
            $name = "Tables_in_$mosConfig_db";

            if ( $value->$name == $mosConfig_dbprefix . 'extcal_categories' ) {
                $cals[$key]['id']   = 'extcal';
                $cals[$key]['name'] = 'Ext Calendar';
            }
        }
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.jcalpro.html.php');
        HTML_extcalendar::import( $cals );
        }

    function importCalendar() {
        global $mainframe;
        $database = & JFactory::getDBO();
        $registery = & JFactory::getConfig();
        $mosConfig_lang = $registery->lang;

        if ( !function_exists( 'htmlspecialchars_decode' ) ) {
            function htmlspecialchars_decode( $str ) {
                $trans = get_html_translation_table( HTML_SPECIALCHARS );

                $decode = ARRAY();

                foreach ( $trans AS $char => $entity ) {
                    $decode[$entity]=$char;
                }

                $str = strtr( $str, $decode );

                return $str;
            }
        }

        $id = JRequest::getVar( 'id','',$_GET );

        if ( $id='extcal' ) {
            $cal[0]['newTable'] = 'categories';
            $cal[0]['oldTable'] = 'categories';

            $cal[0]['fields'] = array
                (
                'cat_id'           => 'cat_id',
                'cat_parent'       => 'cat_parent',
                'cat_name'         => 'cat_name',
                'description'      => 'description',
                'color'            => 'color',
                'bgcolor'          => 'bgcolor',
                'options'          => 'options',
                'published'        => 'published',
                'checked_out'      => 'checked_out',
                'checked_out_time' => 'checked_out_time'
                );

            /*$cal[1]['newTable'] = 'config';
            $cal[1]['oldTable'] = 'config';
            $cal[1]['fields'] = array ( 
                'name' => 'name', 
                'value' => 'value',
                'checked_out' => 'checked_out', 
                'checked_out_time' => 'checked_out_time'            
            );
            */

            $cal[2]['newTable'] = 'events';
            $cal[2]['oldTable'] = 'events';

            $cal[2]['fields'] = array
                (
                'extid'          => 'extid',
                'title'          => 'title',
                'description'    => 'description',
                'contact'        => 'contact',
                'url'            => 'url',
                'email'          => 'email',
                'cat'            => 'cat',
                'day'            => 'day',
                'month'          => 'month',
                'year'           => 'year',
                'approved'       => 'approved',
                'start_date'     => 'start_date',
                'end_date'       => 'end_date',
                'recur_type'     => 'recur_type',
                'recur_val'      => 'recur_val',
                'recur_end_type' => 'recur_end_type',
                'recur_count'    => 'recur_count',
                'recur_until'    => 'recur_until'
                );
        }

        foreach ( $cal as $calKey => $calValue ) {
            $query = "
                        SELECT 
                            * 
                        FROM
                            #__" . $id . "_" . $cal[$calKey]['oldTable'] . "
                    ";

            $database->setQuery( trim( $query ) );

            $database->query();

            $vals = $database->loadObjectList();

            foreach ( $vals as $valsKey => $valsValue ) {
                $notFirst = 0;

                $query    = "INSERT INTO #__jcalpro_" . $cal[$calKey]['newTable'] . "
                        ";

                foreach ( $cal[$calKey]['fields'] as $fieldsKey => $fieldsValue ) {
                    if ( preg_match( "/default\(([[:alnum:]]*)\)/", $fieldsValue, $matches ) ) {
                        $setValue=$matches[1];
                    } else {
                        $setValue=$valsValue->$fieldsValue;
                    }

                    $setValue = preg_replace( '@\[B\](.*)\[/B\]@', '<strong>${1}</strong>', $setValue );
                    $setValue = preg_replace( '@\[I\](.*)\[/I\]@', '<i>${1}</i>', $setValue );
                    $setValue = preg_replace( '@\[U\](.*)\[/U\]@', '<u>${1}</u>', $setValue );

                    $setValue = preg_replace( '@\[LEFT\](.*)\[/LEFT\]@', '<div align="left">${1}</div>', $setValue );
                    $setValue = preg_replace( '@\[CENTER\](.*)\[/CENTER\]@', '<div align="center">${1}</div>',
                                              $setValue );
                    $setValue = preg_replace( '@\[RIGHT\](.*)\[/RIGHT\]@', '<div align="right">${1}</div>', $setValue );

                    $setValue = preg_replace( '@\[URL=(.*)\](.*)\[/URL\]@', '<a href="${1}">${2}</a>', $setValue );
                    $setValue = preg_replace( '@\[IMG\](.*)\[/IMG\]@', '<img src="${1}">', $setValue );

                    $setValue = htmlspecialchars_decode( $setValue );

                    if ( $notFirst == 1 ) {
                        $query.=", " . $fieldsKey . " = '" . addslashes( $setValue ) . "'";
                    } else {
                        $query.=" SET " . $fieldsKey . " = '" . addslashes( $setValue ) . "'";
                    }

                    $notFirst = 1;
                }

                $database->setQuery( $query );

                $database->query();

                echo mysql_error();

                $queries["jos_jcalpro_" . $cal[$calKey]['newTable']][] = $query;
            }
        }
        require_once(JPATH_ADMINISTRATOR.DS.'admin.jcalpro.html.php');
        HTML_extcalendar::importCalendar( $queries );
        }

    function showSettings( $option ) {
        global $mainframe;
        $database = & JFactory::getDBO();
        $registery = & JFactory::getConfig();
        $mosConfig_lang = $registery->lang;

        $query = "SELECT * FROM #__jcalpro_config";
        $database->setQuery( $query );

        if ( !$result=$database->query() ) {
            echo $database->stderr();
            return;
        }

        $rows = $database->loadObjectList();
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.jcalpro.html.php');
        HTML_extcalendar::showSettings( $rows, $option );
        }

    function documentation( $option ) {
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.jcalpro.html.php');
        HTML_extcalendar::documentation();
    }

    function editSettings( $option ) {
        global $mainframe, $CONFIG_EXT,
        $THEME_DIR, $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data,
        $lang_info, $theme_info, $lang_general, $lang_config_data, $comp_path;
        
        $database =& JFactory::getDBO();
        $mosConfig_absolute_path = JPATH_SITE;
        $language = &JFactory::getLanguage();
        $mosConfig_lang = $language->getBackwardLang();
        $mosConfig_live_site = JURI::root();
        $my =& JFactory::getUser();
        
                   
        $query = "SELECT ec.*, u.name as editor FROM #__jcalpro_config as ec "
            . "\n LEFT JOIN #__users AS u ON u.id = ec.checked_out";
        $database->setQuery( $query );

        if ( !$result=$database->query() ) {
            echo $database->stderr();
            return;
        }

        require_once( $CONFIG_EXT['ADMIN_PATH'] . DS . 'admin.config.inc.php' );
        require_once( JPATH_COMPONENT_SITE . DS . 'jcalpro.class.php' );

        foreach ( $lang_config_data as $element ) {
            if ( ( is_array( $element )) ) {
                $row = new mosExtCalendarSettings( $database );
                $row->load( $element[1] );
                $row->checkout( $my->id );
            }
        }
        require_once(JPATH_COMPONENT_ADMINISTRATOR . DS . 'admin.jcalpro.html.php');
        include( JPATH_COMPONENT_ADMINISTRATOR . DS . 'admin_settings.php' );
        HTML_extcalendar::editSettings( $option );
        }

    function saveSettings( $option ) {
        global $mainframe, $CONFIG_EXT,
        $THEME_DIR, $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data,
        $lang_info, $theme_info, $lang_general, $lang_config_data;
        
        $database =& JFactory::getDBO();
        $registery =& JFactory::getConfig();
        $mosConfig_absolute_path = $registery->absolute_path;
        $mosConfig_lang = $registery->lang;
        $mosConfig_live_site = $registery->live_site;
        $my =& JFactory::getUser();

        require_once( $CONFIG_EXT['ADMIN_PATH'] . DS . 'admin.config.inc.php' );

        foreach ( $lang_config_data as $element ) {
            if ( ( is_array( $element )) ) {
                //if ((!isset($_POST[$element[1]]))) die("Missing config value for '{$element[1]}'". __FILE__ . __LINE__);
                $value = addslashes( $_POST[$element[1]] );
                extcal_db_query( "UPDATE #__jcalpro_config SET value = '$value' WHERE name = '{$element[1]}'" );
                require_once( JPATH_COMPONENT_SITE . '/jcalpro.class.php' );
                $row = new mosExtCalendarSettings( $database );
                $row->load( $element[1] );
                $row->checkin();
            }
        }

        $msg = 'Saved New Settings';

        $mainframe->redirect( 'index2.php?option=com_jcalpro', $msg );
        }

    function cancelEditSettings() {
        global $mainframe;
        
        $database =& JFactory::getDBO();

        $checkInQuery = "SELECT * FROM #__jcalpro_config";
        $database->setQuery( $checkInQuery );
        $rows = $database->loadObjectList();

        foreach ( $rows as $key => $value ) {
            $row = new mosExtCalendarSettings( $database );
            $row->load( $value->name );
            $row->checkin();
        }

        $mainframe->redirect( 'index2.php?option=com_jcalpro', 'Cancelled Settings Change' );
        }

    function showCategories( $option ) {
        global $mainframe;
        
        $database =& JFactory::getDBO();
        $registery =& JFactory::getConfig();
        $mosConfig_absolute_path = $registery->absolute_path;
        $mosConfig_lang = $registery->lang;
        $mosConfig_list_limit = $registery->list_limit;
        

        $limit      = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
        $limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

        // get the total number of records
        $database->setQuery( "SELECT count(*) FROM #__jcalpro_categories" );
        $total = $database->loadResult();

        jimport('joomla.html.pagination');
        $pageNav = new JPagination($total, $limitstart, $limit);
        //$pageNav = new mosPageNav( $total, $limitstart, $limit );

        $query   = "SELECT c.*, u.name as editor FROM #__jcalpro_categories as c "
            . "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
            . "\nORDER BY c.cat_name LIMIT $pageNav->limitstart,$pageNav->limit";
        $database->setQuery( $query );

        if ( !$result=$database->query() ) {
            echo $database->stderr();
            return;
        }

        $rows = $database->loadObjectList();
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.jcalpro.html.php');
        HTML_extcalendar::showCategories( $rows, $pageNav, $option );
        }

    function newCategory( $option ) {
        global $mainframe, $CONFIG_EXT,
        $THEME_DIR, $form, $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format,
        $lang_settings_data, $lang_info, $theme_info, $lang_general, $lang_config_data, $template_cat_form,
        $lang_cat_admin_data, $errors;
        
        $database = &JFactory::getDBO();
        $registery = &JFactory::getConfig();
        $mosConfig_absolute_path = JPATH_BASE;
        $language = &JFactory::getLanguage();
        $mosConfig_lang = $language->getBackwardLang();
        $mosConfig_live_site = JURI::root();
        $my = &JFactory::getUser();

        require_once( $CONFIG_EXT['ADMIN_PATH'] . DS . 'admin.config.inc.php' );
        require_once(JPATH_COMPONENT_ADMINISTRATOR . DS . 'admin.jcalpro.html.php');
        HTML_extcalendar::editCategory( $option );

        $form['published']     = 1;
        $form['adminapproved'] = true;
        $form['userapproved']  = false;

        $form['color']         = "#505054";

        pageheader( '', '', false );
        display_cat_form( 'index2.php', 'add', $form );
        echo '
                   <input type="hidden" name="option" value="' . $option . '">
                   <input type="hidden" name="task" value="initial">
                 </form>
            ';

        // footer
        //pagefooter();
        }

    function editCategory( $cat_id, $option ) {
        global $mainframe, $CONFIG_EXT,
        $THEME_DIR, $form, $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format,
        $lang_settings_data, $lang_info, $theme_info, $lang_general, $lang_config_data, $template_cat_form,
        $lang_cat_admin_data, $errors;
                   
        $database = &JFactory::getDBO();
        
        $mosConfig_absolute_path = JPATH_BASE;
        $language = &JFactory::getLanguage();
        $mosConfig_lang = $language->getBackwardLang();
        
        $mosConfig_live_site = JURI::root();
        $my = &JFactory::getUser();

        require_once( $CONFIG_EXT['ADMIN_PATH'] . DS . 'admin.config.inc.php' );
        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'admin.jcalpro.html.php');
        HTML_extcalendar::editCategory( $option );

        $query = "SELECT * FROM #__jcalpro_categories WHERE cat_id = '$cat_id'";
        $database->setQuery( $query );
        $formObject            = $database->loadObjectList();
        $form                  = get_object_vars( $formObject[0] );

        $form['userapproved']  = $form['options'] & 1;
        $form['adminapproved'] = $form['options'] & 2;

        pageheader( '', '', false );
        display_cat_form( 'index2.php', 'edit', $form );
        echo '
                   <input type="hidden" name="option" value="' . $option . '">
                   <input type="hidden" name="task" value="initial">
                 </form>
            ';

        // footer
        pagefooter();
        }

    function cancelEditCategory( $option ) {
        global $mainframe;
        
        $database = & JFactory::getDBO();
        require_once( JPATH_COMPONENT_SITE . DS . 'jcalpro.class.php' );
        $row = new mosExtCalendarCategories( $database );
        $row->bind( $_POST );
        $row->checkin();

        $mainframe->redirect( "index2.php?option=$option&task=showCategories", 'Cancelled Categories Change' );
        }

    function saveCategory( $option ) {
        global $mainframe;
        
        $database =& JFactory::getDBO();
        require_once( JPATH_COMPONENT_SITE . DS . 'jcalpro.class.php' );
        $row = new mosExtCalendarCategories( $database );

        if ( !$row->bind( $_POST ) ) {
            echo "<script> alert('" . $row->getError() . "'); window.history.go(-1); </script>\n";
            exit();
        }

        if ( !$row->check() ) {
            echo "<script> alert('" . $row->getError() . "'); window.history.go(-1); </script>\n";
            exit();
        }

        $admin_auto_approve = ( isset( $_POST['adminapproved'] )) ? 1 : 0;
        $user_auto_approve  = ( isset( $_POST['userapproved'] )) ? 1 : 0;
        $row->options       = $user_auto_approve + $admin_auto_approve * 2;

        if ( !$row->store() ) {
            echo "<script> alert('" . $row->getError() . "'); window.history.go(-1); </script>\n";
            exit();
        }

        $row->checkin();

        $mainframe->redirect( "index2.php?option=$option&task=showCategories", 'Saved Categories Change' );
        }


    /**
    * Publishes or Unpublishes one or more categories
    * @param array An array of unique category id numbers
    * @param integer 0 if unpublishing, 1 if publishing
    * @param string The name of the current user
    */
    function publishCategories( $option, $cid = null, $publish = 1 ) {
        global $mainframe;
        $database =& JFactory::getDBO();
        $my =& JFactory::getUser();

        if ( !is_array( $cid ) ) {
            $cid=array();
        }

        if ( count( $cid ) < 1 ) {
            $action = $publish ? 'publish' : 'unpublish';
            echo "<script> alert('Select a category to $action'); window.history.go(-1);</script>\n";
            exit;
        }

        $cids  = implode( ',', $cid );

        $query = "UPDATE #__jcalpro_categories SET published='$publish'"
            . "\nWHERE cat_id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))";
        $database->setQuery( $query );

        if ( !$database->query() ) {
            echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            exit();
        }

        if ( count( $cid ) == 1 ) {
            $row = new mosExtCalendarCategories( $database );
            $row->checkin( $cid[0] );
        }

        $mainframe->redirect( 'index2.php?option=' . $option . '&task=showCategories' );
        }

    function deleteCategories( $option, $cid ) {
        global $mainframe;
        
        $database =& JFactory::getDBO();

        if ( count( $cid ) ) {
            $cids = implode( ',', $cid );
            $database->setQuery( "DELETE FROM #__jcalpro_categories WHERE cat_id IN ($cids)" );

            if ( !$database->query() ) {
                echo "<script> alert('" . $database->getErrorMsg() . "'); window.history.go(-1); </script>\n";
            }
        }

        $mainframe->redirect( 'index2.php?option=' . $option . '&task=showCategories', 'Delete Successful' );
        }
}
?>