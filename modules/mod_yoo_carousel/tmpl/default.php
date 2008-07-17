<?php
/**
* YOOcarousel Joomla! Module
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="<?php echo $style ?>">
	<div id="<?php echo $carousel_id ?>" class="yoo-carousel" style="<?php echo $css_module_width . $css_module_height ?>">

		<div class="<?php echo $control_panel ?>" style="overflow: hidden; <?php echo $css_module_height /* needed for IE6 */?>">

			<?php if ($control_panel == 'top') : ?>
			<ul class="tabs" style="<?php echo $css_panel_width ?>">
				<?php for ($i=0; $i < $items; $i++) : ?>
					<li class="button item<?php echo $i + 1 ?>">
						<a href="javascript:void(0)" title="<?php echo $list[$i]->title ?>">
							<span><span><?php echo $list[$i]->title ?></span></span>
						</a>
					</li>
				<?php endfor; ?>
			</ul>
			<?php endif; ?>
	
			<div class="frame" style="<?php echo $css_module_width ?>">
			
				<?php if ($buttons) : ?>
				<div class="prev">
					<a class="button-prev" href="javascript:void(0)" title="Previous slide">
						<span></span>
					</a>
				</div>
				<?php endif; ?>
			
				<div class="panel-container" style="<?php echo $css_panel_width ?>">
					<div class="panel-container-bl">
						<div class="panel-container-br" style="<?php echo $css_panel_height ?>">
							
							<div class="panel" style="<?php echo $css_panel_width ?>">
								<div style="<?php echo $css_total_panel_width ?>">
								<?php for ($i=0; $i < $items; $i++) : ?>
									<div class="slide" style="<?php echo $css_panel_width ?>">
										<?php modYOOcarouselHelper::renderItem($list[$i], $params, $access); ?>
									</div>
								<?php endfor; ?>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			
				<?php if ($buttons) : ?>
				<div class="next">
					<a class="button-next" href="javascript:void(0)" title="Next slide">
						<span></span>
					</a>
				</div>
				<?php endif; ?>
	
			</div>
	
			<?php if ($control_panel == 'bottom') : ?>
			<ul class="tabs" style="<?php echo $css_panel_width ?>">
				<?php for ($i=0; $i < $items; $i++) : ?>
					<li class="button">
						<a href="javascript:void(0)" title="<?php echo $list[$i]->title ?>">
							<span><span><?php echo $list[$i]->title ?></span></span>
						</a>
					</li>
				<?php endfor; ?>
			</ul>
			<?php endif; ?>
	
		</div>
		
	</div>
</div>