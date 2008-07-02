<?php
/**
* Alternative flexible Login-Module 1.0b
* $Id: mod_signallogin.php 100 2008-02-17 14:36:00 chris $
*
* @version 1.0 Beta
* @copyright (C) 2008 Chris Schafflinger
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::stylesheet('signal.css','modules/mod_signallogin/templates/'.$params->get('module_theme').'/');

if($type == 'logout') : 
	// Show Logout-Form    
	if ($params->get('name')) :
		$gname = $user->get('name');
	else :
		$gname = $user->get('username');
	endif;
	
    if($params->get('horizontal')) : ?>
		<div id="sl_horiz">
		<form action="index.php" method="post" name="login" id="form-login">
		<?php if ($params->get('greeting')) : ?>
        	<div id="greeting"><?php echo JText::sprintf( 'HINAME', $user->get('name') ); ?></div>
		<?php endif; ?>
            <div id="sl_submitbutton">
				<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" />
            </div>
        
            <input type="hidden" name="option" value="com_user" />
            <input type="hidden" name="task" value="logout" />
            <input type="hidden" name="return" value="<?php echo $return; ?>" />
        </form>
        </div>
    <?php else : ?>
		<div id="sl_vert">
		<form action="index.php" method="post" name="login" id="form-login">
		<?php if ($params->get('greeting')) : ?>
			<div id="greeting"><?php echo JText::sprintf( 'HINAME', $user->get('name') ); ?></div>
		<?php endif; ?>
            <div id="sl_submitbutton">
				<input type="submit" name="Submit" class="button" value="<?php echo JText::_( 'BUTTON_LOGOUT'); ?>" />
            </div>
        
            <input type="hidden" name="option" value="com_user" />
            <input type="hidden" name="task" value="logout" />
            <input type="hidden" name="return" value="<?php echo $return; ?>" />
        </form>
        </div>
    <?php endif; ?>
<?php else : ?>
	<?php if(JPluginHelper::isEnabled('authentication', 'openid')) : ?>
        <?php JHTML::_('script', 'openid.js'); ?>
    <?php endif; ?>
    <?php if($params->get('horizontal')) : ?>
		<div id="sl_horiz">
        <form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login" >
            <div id="sl_username">
                <input id="modlgn_username" type="text" name="username" alt="username" size="<?php echo $params->get('name_lenght'); ?>" value="<?php echo JText::_('Username'); ?>" onfocus="if (this.value=='<?php echo JText::_('Username'); ?>') this.value=''" onblur="if(this.value=='') { this.value='<?php echo JText::_('Username'); ?>'; return false; }" />
			</div>
            <div id="sl_pass">
                <input id="modlgn_passwd" type="password" name="passwd" alt="password" size="<?php echo $params->get('pass_lenght'); ?>" value="<?php echo JText::_('Password'); ?>" onfocus="if (this.value=='<?php echo JText::_('Password'); ?>') this.value=''" onblur="if(this.value=='') { this.value='<?php echo JText::_('Password'); ?>'; return false; }" />
			</div>
            <?php
			switch($params->get('remember_enabled')){
            	case 1:
					?>
                	<div id="sl_rememberme"><input type="checkbox" name="remember" id="modlogn_remember" class="inputbox" value="yes" alt="Remember Me" /> <?php echo JText::_('Remember me'); ?></div>
                	<?php
                    break;
            	case 2:
                	?>            
            		<input type="hidden" name="remember" value="yes" />
                	<?php
                    break;
            	case 3:
					?>            
                	<div id="sl_rememberme"><input type="checkbox" name="remember" id="modlogn_remember" class="inputbox" value="yes" alt="Remember Me" checked="checked" /> <?php echo JText::_('Remember me'); ?></div>
                	<?php
                    break;
				default:
					break;
            }
			?>
            <div id="sl_submitbutton"><input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" /></div>
            <?php if($params->get('show_lostpass')) : ?>
                    <div id="sl_lostpass"><a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>">
                    <?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a></div>
			<?php endif; ?>
            <?php if($params->get('show_lostname')) : ?>
                    <div id="sl_lostpass"><a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>">
                    <?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a></div>
			<?php endif; ?>
                <?php
                $usersConfig = &JComponentHelper::getParams( 'com_users' );
                if ($usersConfig->get('allowUserRegistration') && $params->get('show_newaccount')) : ?>
                    <div id="sl_register"><a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register' ); ?>">
					<?php echo JText::_('REGISTER'); ?></a></div>
                <?php endif; ?>
            </ul>
        
            <input type="hidden" name="option" value="com_user" />
            <input type="hidden" name="task" value="login" />
            <input type="hidden" name="return" value="<?php echo $return; ?>" />
            <?php echo JHTML::_( 'form.token' ); ?>
        </form>
        </div>
	<?php else : ?>
		<div id="sl_vert">
        <form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login" >
            <?php if($params->get('pretext')) : ?>
				<div id="sl_pretext"><?php echo $params->get('pretext'); ?></div>
			<?php endif; ?>
            <div id="sl_username">
                <input id="modlgn_username" type="text" name="username" alt="username" size="<?php echo $params->get('name_lenght'); ?>" value="<?php echo JText::_('Username'); ?>" onfocus="if (this.value=='<?php echo JText::_('Username'); ?>') this.value=''" onblur="if(this.value=='') { this.value='<?php echo JText::_('Username'); ?>'; return false; }" />
			</div>
            <div id="sl_pass">
                <input id="modlgn_passwd" type="password" name="passwd" alt="password" size="<?php echo $params->get('pass_lenght'); ?>" value="<?php echo JText::_('Password'); ?>" onfocus="if (this.value=='<?php echo JText::_('Password'); ?>') this.value=''" onblur="if(this.value=='') { this.value='<?php echo JText::_('Password'); ?>'; return false; }" />
			</div>
            <?php
			switch($params->get('remember_enabled')){
            	case 1:
					?>
                	<div id="sl_rememberme"><input type="checkbox" name="remember" id="modlogn_remember" class="inputbox" value="yes" alt="Remember Me" /> <?php echo JText::_('Remember me'); ?></div>
                	<?php
                    break;
            	case 2:
                	?>            
            		<input type="hidden" name="remember" value="yes" />
                	<?php
                    break;
            	case 3:
					?>            
                	<div id="sl_rememberme"><input type="checkbox" name="remember" id="modlogn_remember" class="inputbox" value="yes" alt="Remember Me" checked="checked" /> <?php echo JText::_('Remember me'); ?></div>
                	<?php
                    break;
				default:
					break;
            }
			?>
            <div id="sl_submitbutton"><input type="submit" name="Submit" class="button" value="<?php echo JText::_('LOGIN') ?>" /></div>
            <?php if($params->get('show_lostpass')) : ?>
                    <div id="sl_lostpass"><a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>">
                    <?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a></div>
			<?php endif; ?>
            <?php if($params->get('show_lostname')) : ?>
                    <div id="sl_lostpass"><a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>">
                    <?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a></div>
			<?php endif; ?>
                <?php
                $usersConfig = &JComponentHelper::getParams( 'com_users' );
                if ($usersConfig->get('allowUserRegistration') && $params->get('show_newaccount')) : ?>
                    <div id="sl_register"><a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register' ); ?>">
					<?php echo JText::_('REGISTER'); ?></a></div>
                <?php endif; ?>
            </ul>
            <?php if($params->get('posttext')) : ?>
				<div id="sl_posttext"><?php echo $params->get('posttext'); ?></div>
			<?php endif; ?>
        
            <input type="hidden" name="option" value="com_user" />
            <input type="hidden" name="task" value="login" />
            <input type="hidden" name="return" value="<?php echo $return; ?>" />
            <?php echo JHTML::_( 'form.token' ); ?>
       </form>
       </div>
       <?php endif; ?>
<?php endif; ?>