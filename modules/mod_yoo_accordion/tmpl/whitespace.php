<?php
/**
* YOOaccordion Joomla! Module
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="<?php echo $style ?>">
	<div id="<?php echo $accordion_id ?>" class="yoo-accordion">
	
		<dl>
		<?php for ($i=0; $i < $items; $i++) : ?>
	
			<?php
			$listitem = $list[$i];
			$item_class = "item" . ($i + 1);
			if ($i == 0) $item_class .= " first";
			if ($i == $items - 1) $item_class .= " last";
			?>
			<dt class="toggler <?php echo $item_class; ?>">
				<span class="header-l">
					<span class="header-r">
						<?php echo $listitem->title ?>
					</span>
				</span>
			</dt>
			<dd class="content <?php echo $item_class; ?>">
				<?php modYOOaccordionHelper::renderItem($listitem, $params, $access); ?>
			</dd>
				
		<?php endfor; ?>
		</dl>

	</div>
</div>