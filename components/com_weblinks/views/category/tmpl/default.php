<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
	<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<?php echo $this->category->title; ?>
	</div>
<?php endif; ?>

<table width="100%" cellpadding="4" cellspacing="0" border="0" align="center" class="contentpane<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php if ( @$this->category->image || @$this->category->description ) : ?>
<tr>
	<td valign="top" class="contentdescription<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php
		if ( isset($this->category->image) ) :  echo $this->category->image; endif;
		echo $this->category->description;
	?>
	</td>
</tr>
<?php endif; ?>
<tr>
	<td width="60%" colspan="2">
	<?php echo $this->loadTemplate('items'); ?>
	</td>
</tr>
</table>