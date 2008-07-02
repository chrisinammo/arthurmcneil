<?php
// security check - no direct access
defined('_JEXEC') or die('Restricted access');

//error handling: output any error message to admin users only
$user =& JFactory::getUser();
if(count($slick_rss['error']) && in_array($user->gid, array(24,25))){
        // only show errors to admin group users
        print '<div style="color:red;"><b>Error(s):</b><ul style="margin-left:4px;padding-left:4px;">';
        foreach($slick_rss['error'] as $error){
              print '<li>'.$error.'</li>';  
        }
        print '</ul></div>';
}

//check to enable tooltip js for slickTip classed elements
if($params->get('enable_tooltip') == 'yes'){
        JHTML::_('behavior.tooltip','.slickTip'); 
        $tooltips = true;
}
//begin output
?>
<!-- slick rss http://joomla.daveslist.co.nz -->
<div class="slick-rss-container" style="direction: <?php echo $rssrtl ? 'rtl' :'ltr'; ?>; text-align: <?php echo $rssrtl ? 'right' :'left'; ?>">
<?php
//feed title
if($params->get(rsstitle, 1) && $slick_rss['title']['link']){
        print '<div><a href="'.$slick_rss['title']['link'].'" target="'.$slick_rss['target'].'">'.$slick_rss['title']['title'].'</a></div>';
}
//feed desc
if($params->get(rssdesc, 1) && $slick_rss['description']){
        print '<div class="slick-rss-desc">'.$slick_rss['description'].'</div>';
}
//feed image
if($params->get(rssimage, 0) && $slick_rss['image']['url']){
        print '<img src="'.$slick_rss['image']['url'].'" title="'.$slick_rss['image']['title'].'" class="slick-rss-img">';
}
?>
<ul class="slick-rss-list<?php echo $params->get('moduleclass_sfx'); ?>" style="margin-left:0px;padding-left:0px;">
<?php
if($slick_rss['items']){
foreach($slick_rss['items'] as $item){
        if($tooltips){
                $title = $item['tooltip']['title'] .'::'. $item['tooltip']['description'];
        }else{
                $title = $item['description'];
        }
        //item desc
        if($params->get(rssitemdesc, 0) && $item['description']){
                $desc = $item['description'];
        }        
        print '
        <li class="slick-rss-item'.$params->get('moduleclass_sfx').'">
        <a href="'.$item['link'].'" title="'.$title.'" class="slickTip" target="'.$slick_rss['target'].'" '.$slick_rss['nofollow'].'>'.$item['title'].'</a>';
        print '<div class="slick-rss-item-desc">'.$desc.'</div>';
        print '</li>'; 
}
}
?>
</ul>
</div>
<!-- /slick-rss -->