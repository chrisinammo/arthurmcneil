<?php
/**
 * Category Management Library for JEvents Component
 *
 * @version     $Id: categoryHTML.php 952 2008-02-13 20:24:42Z tstahl $
 * @package     Events
 * @copyright   Copyright (C) 2006-2007 JEvents Project Group
 * @copyright   Copyright (C) 2000 - 2003 Eric Lamette, Dave McDonnell
 * @licence     http://www.gnu.org/copyleft/gpl.html
 * @link        http://joomlacode.org/gf/project/jevents
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

class HTML_category_admin {


	/**
	 * Category Management code
	 *
	 * Author: Geraint Edwards
	 * Copyright: 2007 Geraint Edwards
	 * 
	 */
	function showCategories($cats, $pageNav, $option) {
		global   $task,$mainframe;
		$db	=& JFactory::getDBO();
		$user =& JFactory::getUser();
		JHTML::_('behavior.tooltip');
		$pathIMG = $mainframe->getSiteURL() . '/administrator/images/';

		global $task;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		?>
			<script>			
			function saveCategoryOrder( n ) {
				for ( var j = 0; j <= n; j++ ) {
					box = eval( "document.adminForm.cb" + j );
					if ( box ) {
						if ( box.checked == false ) {
							box.checked = true;
						}
					} else {
						alert("You cannot change the order of items, as an item in the list is `Checked Out`");
						return;
					}
				}
				submitform('saveCategoryOrder');
			}
			</script>
			<table cellpadding="4" cellspacing="0" border="0" width="100%">
				<tr>
					<td width="100%">
						&nbsp;
					</td>
				</tr>
			</table>

			<table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
				<tr>
					<th width="20" nowrap="nowrap">
						<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $cats ); ?>);" />
					</th>
					<th class="title" width="75%" nowrap="nowrap"><?php echo _CAL_CATEGORY_TITLE; ?></th>
					<th class="title" width="25%" nowrap="nowrap"><?php echo _CAL_CATEGORY_PARENT; ?></th>
					<th width="2%">	Order</th>
					<th width="1%">
					<a href="javascript: saveCategoryOrder( <?php echo count( $cats )-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a>
					</th>

					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_PUBLISHED; ?></th>
					<th width="10%" nowrap="nowrap"><?php echo _CAL_LANG_ACCESS; ?></th>
				</tr>

                <?php
                $k=0;
                $i=0;
                foreach ($cats as $cat) {
                	?>
                    <tr class="row<?php echo $k; ?>">
                    	<td width="20" style="background-color:<?php echo $cat->getColor();?>">
                            <input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $cat->id; ?>" onclick="isChecked(this.checked);" />
                    	</td>
                      	<td >
                      		<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editCategory')" title="<?php echo _CAL_LANG_CLICK_TO_EDIT; ?>">
                      		<?php echo $cat->title; ?>
                      		</a>
                      	</td>
                      	<td>
						<?php 
						if ($cat->parent_id>0){
							echo $cats[$cat->parent_id]->title;
						}
						else {
							echo "-";
						}
                      		?></a>
                      	</td>
						<td align="center" colspan="2">
						<input type="text" name="order[]" size="5" value="<?php echo $cat->ordering; ?>" class="text_area" style="text-align: center" />
						</td>
                      	<td align="center">
                      	<?php                      	
                      	$img = $cat->published?'publish_y.png':'publish_x.png';
                      	?>
                      	<a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','<?php echo $cat->published ? 'unpublishCategory' : 'publishCategory'; ?>')"><img src="<?php echo $pathIMG . $img; ?>" width="12" height="12" border="0" alt="" /></a>
                      	</td>
                      	<td align="center"><?php echo $cat->_groupname;?></td>
                    </tr>
                    <?php
                    $i++;
                    $k = 1 - $k;
                } ?>
            </table>
            <table  width="100%">
            	<tr>
            		<th style="text-align:center!important" ><?php echo $pageNav->getListFooter(); ?></th>
            	</tr>
            </table>
            <input type="hidden" name="boxchecked" value="0" />
        <?php
	}

	/**
	 * Category Editing code
	 *
	 * Author: Geraint Edwards
	 * Copyright: 2007 Geraint Edwards
	 * 
	 */
	function editCategory($cat, $plist, $glist, $component_name){
		global $task, $mainframe,  $Itemid;
		$cfg = & EventsConfig::getInstance();
		$option = $cfg->get("com_componentname", "com_events");
		$db	=& JFactory::getDBO();
		$editor =& JFactory::getEditor();

		include_once(dirname(__FILE__)."/../colorMap.php");

		?>		
		<input type="hidden" name="cid[]" value="<?php echo $cat->id;?>">

		<input type="hidden" name="published" id="published" value="<?php echo $cat->published;?>">
		<input type="hidden" name="id" id="id" value="<?php echo $cat->id;?>">
		<script type="text/javascript" language="Javascript">

		function submitbutton(pressbutton) {
			if (pressbutton == 'cancel' || pressbutton == 'categories') {
				submitform( pressbutton );
				return;
			}
			var form = document.adminForm;
			<?php echo $editor->getContent( 'description' ); ?>
			// do field validation
			if (form.title.value == "") {
				alert ( "<?php echo html_entity_decode( _E_WARNTITLE ); ?>" );
			}
			else {
				submitform(pressbutton);
			}
		}

		</script>
        <div class="adminform" align="left">
       	<div style="margin-bottom:20px;">
	        <table cellpadding="5" cellspacing="0" border="0" >
    			<tr>
                	<td align="left"><?php echo _CAL_CATEGORY_TITLE; ?>:</td>
                    <td >
                    	<input class="inputbox" type="text" name="title" size="50" maxlength="100" value="<?php echo mosEventsHtml::special($cat->title); ?>" />
                    </td>
                    <td colspan="2">
                         <table id="pick1064797275" align="right" style="background-color:<?php echo $cat->getColor().';color:'.mapColor($cat->getColor()); ?>;border:solid 1px black;">
                            <tr>
                                <td width="80">
  									<div><?php echo _CAL_LANG_EVENT_COLOR; ?></div>
									<input type="hidden" id="pick1064797275field" name="color" value="<?php echo $cat->getColor();?>"/>
									</td>

									<td  nowrap>
										<a id="colorPickButton" name ="colorPickButton" href="javascript:void(0)"  onclick="document.getElementById('fred').style.visibility='visible';"	  style="visibility:visible;color:<?php echo mapColor($cat->getColor()); ?>;font-weight:bold;"><?php echo _CAL_LANG_COLOR_PICKER; ?></a>
										</td>
										<td>
			                    	<div style="position:relative;z-index:9999;">
									<iframe id="fred" frameborder="0" src="<?php echo $mainframe->getSiteURL()."/administrator/components/$component_name/lib/colours.html?id=fred";?>" style="position:absolute;width:300px!important;height:250px!important;visibility:hidden;z-index:9999;right:0px;top:0px;overflow:visible!important;"></iframe>
									</div>
                                </td>
                            </tr>
                        </table>
					</td>
      			</tr>
                <tr>
                	<td valign="top" align="left"><?php echo _CAL_CATEGORY_PARENT; ?></td>
                    <td  >
                    <?php echo $plist;?>
                    </td>
                    <?php if (isset($glist)) {?>
                    <td align="right"><?php echo _CAL_LANG_EVENT_ACCESSLEVEL; ?></td>
                    <td align="right"><?php echo $glist; ?></td>
                    <?php } 
                    else echo "<td/><td/>\n";?>
                 </tr>
                 <tr>
                 	<td valign="top" align="left">
                    <?php echo _CAL_LANG_DESCRIPTION; ?>
                    </td>
                    <td style="width:600px"colspan="3">
                    <?php
                    // parameters : areaname, content, hidden field, width, height, rows, cols
                    echo $editor->display( 'description',  mosEventsHtml::special($cat->description) , "100%", 250, '70', '10' ) ;
                    ?>
                    </td>
                 </tr>
            </table>
			<?php

	}

}
?>
