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

		<div class="<?php echo $control_panel ?>" style="overflow: hidden;">

			<div class="panel-container-t" style="<?php echo $css_module_width ?>">
				<div class="panel-container-b">
					<div class="panel-container-l">
						<div class="panel-container-r">
							<div class="panel-container-tl">
								<div class="panel-container-tr">
									<div class="panel-container-bl">
										<div class="panel-container-br" style="<?php echo $css_panel_height ?>">

											<?php if ($control_panel == 'left') : ?>
											<ul class="tabs" style="<?php echo $css_tab_width . $css_panel_height ?>">
												<?php for ($i=0; $i < $items; $i++) : ?>
													<li class="button item<?php echo $i + 1 ?>">
														<a href="javascript:void(0)" title="<?php echo $list[$i]->title ?>">
															<span><span><?php echo $list[$i]->title ?></span></span>
														</a>
													</li>
												<?php endfor; ?>
											</ul>
											<?php endif; ?>
									
											<div class="frame" style="<?php echo $css_panel_width . $css_panel_height ?>">
							
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
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
		</div>
		
	</div>
</div>