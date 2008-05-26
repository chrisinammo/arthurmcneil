<?php // @version $Id: _item.php 9718 2007-12-20 22:35:36Z eddieajau $
defined('_JEXEC') or die('Restricted access');
?>

<?php if ($params->get('item_title')) : ?>
<h4>
	<?php if ($params->get('link_titles') && $linkOn != '') : ?>
	<a href="<?php echo JRoute::_($linkOn); ?>" class="contentpagetitle<?php echo $params->get('moduleclass_sfx'); ?>">
		<?php echo $item->title; ?></a>
	<?php else :
		echo $item->title;
	endif; ?>
</h4>
<?php endif; ?>

<?php if (!$params->get('intro_only')) :
	echo $item->afterDisplayTitle;
endif; ?>

<?php echo $item->beforeDisplayContent;
echo JFilterOutput::ampReplace($item->text);
if (isset($item->linkOn) && $item->readmore) : ?>
<a href="<?php $item->linkOn; ?>" class="readon">
	<?php echo JText::_('Read more'); ?></a>
<?php endif; ?>
<span class="article_separator">&nbsp;</span>
