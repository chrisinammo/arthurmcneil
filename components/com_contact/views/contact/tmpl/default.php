<?php
/**
 * $Id: default.php 10094 2008-03-02 04:35:10Z instance $
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

$cparams = JComponentHelper::getParams ('com_media');
?>
<?php if ( $this->params->get( 'show_page_title' ) && !$this->contact->params->get( 'popup' ) ) : ?>
<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php echo $this->params->get( 'page_title' ); ?>
</div>
<?php endif; ?>
<div id="component-contact">
<table width="100%" cellpadding="0" cellspacing="0" border="0" class="contentpaneopen<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php if ( $this->params->get( 'show_contact_list' ) && count( $this->contacts ) > 1) : ?>
<tr>
	<td colspan="2" align="center">
		<br />
		<form action="<?php echo JRoute::_('index.php') ?>" method="post" name="selectForm" id="selectForm">
		<?php echo JText::_( 'Select Contact' ); ?>:
			<br />
			<?php echo JHTML::_('select.genericlist',  $this->contacts, 'contact_id', 'class="inputbox" onchange="this.form.submit()"', 'id', 'name', $this->contact->id);?>
			<option type="hidden" name="option" value="com_contact" />
		</form>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->name && $this->contact->params->get( 'show_name' ) ) : ?>
<tr>
	<td width="100%" class="contentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<?php echo $this->contact->name; ?>
	</td>
</tr>
<?php endif; ?>
<?php if ( $this->contact->con_position && $this->contact->params->get( 'show_position' ) ) : ?>
<tr>
	<td colspan="2">
	<?php echo $this->contact->con_position; ?>
		<br /><br />
	</td>
</tr>
<?php endif; ?>
<tr>
	<td>
		<table border="0" width="100%">
		<tr>
			<td></td>
			<td rowspan="2" align="right" valign="top">
			<?php if ( $this->contact->image && $this->contact->params->get( 'show_image' ) ) : ?>
				<div style="float: right;">
					<?php echo JHTML::_('image', $cparams->get('image_path') . '/'.$this->contact->image, JText::_( 'Contact' ), array('align' => 'middle')); ?>
				</div>
			<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $this->loadTemplate('address'); ?>
			</td>
		</tr>
		</table>
	</td>
	<td>&nbsp;</td>
</tr>
<?php if ( $this->contact->params->get( 'allow_vcard' ) ) : ?>
<tr>
	<td colspan="2">
	<?php echo JText::_( 'Download information as a' );?>
		<a href="<?php echo JURI::base(); ?>index.php?option=com_contact&amp;task=vcard&amp;contact_id=<?php echo $this->contact->id; ?>&amp;format=raw&amp;tmpl=component">
			<?php echo JText::_( 'VCard' );?></a>
	</td>
</tr>
<?php endif;
if ( $this->contact->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id))
	echo $this->loadTemplate('form');
?>
</table>
</div>