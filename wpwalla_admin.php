<?
if(isset($_POST['updatewpwalla'])) {
	$wpwallaUsername = trim($_POST['wpwallausername']);
	$wpwallaCheckins = trim($_POST['wpwallacheckins']);
	$wpwallaCache = trim($_POST['wpwallacache']);
	$wpwallaTitle = trim($_POST['wpwallatitle']);
	if(!isset($_POST['wpwalladisplaymode'])) {
		$wpwalladisplay = 'off';
	} else {
		$wpwalladisplay = $_POST['wpwalladisplaymode'];
	}
	if(!isset($_POST['wpwallaicons'])) {
		$wpwallaicons = 'off';
	} else {
		$wpwallaicons = $_POST['wpwallaicons'];
	}
	
	$wpwallaData = array(
			'wpwallausername' 		=> $wpwallaUsername,
			'wpwallacache' 			=> $wpwallaCache,
			'wpwallaicons' 			=> $wpwallaicons,
			'wpwalladisplaymode' 	=> $wpwalladisplay,
			'wpwallatitle' 			=> $wpwallaTitle, 
			'numbercheckins' 		=> $wpwallaCheckins	
	);
	update_option('widget_wpwalla', $wpwallaData);
	
	$message = $wpwallaUsername;
	$updated = true;
}
$wpwallaData = get_option('widget_wpwalla');
if(strlen($wpwallaData['wpwallausername']) < 3) : ?>
	<div id="message" class="updated fade"><p><strong><?php _e('Please enter your Gowalla username.') ?></strong></p></div>
<?php endif; ?>

<div class="wrap">
<h2>WP-Walla</h2>
<p>
	WP-Walla is a plugin that allows you to display your checkins from <a href="http://www.gowalla.com">Gowalla</a>.
	WP-Walla is design as a sidebar widget for Wordpress but you can also insert a code snippet directly
	in your template. (See bottom of this page)
</p>
<?php if(isset($updated) && $updated == true) : ?>
		<div id="message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
<?php endif; ?>


<form method="post">
	
	<h3><?php _e('WP-Walla settings') ?></h3>
	<label for="wpwallausername"><?php _e('Gowalla Username'); ?></label><br />
	<input type="text" name="wpwallausername" id="wpwallausername" size="45" value="<?php echo $wpwallaData['wpwallausername']; ?>" />
	<br /><br />
	<label for="wpwallacache"><?php _e('Time to Cache Gowalla data (Minutes)'); ?></label><br />
	<input type="text" name="wpwallacache" id="wpwallacache" value="<?php echo $wpwallaData['wpwallacache']; ?>" />
	<br /><br />
	
	<h3><?php _e('WP-Walla blog settings') ?></h3>
	<label for="wpwallatitle"><?php _e('Sidebar title'); ?></label><br />
	<input type="text" name="wpwallatitle" id="wpwallatitle" value="<?php echo $wpwallaData['wpwallatitle']; ?>" />
	<br /><br />
	<label for="wpwallacheckins"><?php _e('Checkins to display (Max 20)'); ?></label><br />
	<input type="text" name="wpwallacheckins" id="wpwallacheckins" value="<?php echo $wpwallaData['numbercheckins']; ?>" />
	<br /><br />
	<label for="wpwallaicons"><?php _e('Show Gowalla icons?'); ?></label><br />
	<input type="checkbox" name="wpwallaicons" id="wpwallaicons" <?php if($wpwallaData['wpwallaicons'] == 'on') echo 'checked="checked"'; ?>" />
	<br /><br />
	<label for="wpwalladisplaymode"><?php _e('Show Gowalla link?'); ?></label><br />
	<input type="checkbox" name="wpwalladisplaymode" id="wpwalladisplaymode" <?php if($wpwallaData['wpwalladisplaymode'] == 'on') echo 'checked="checked"'; ?>" />
	<br /><br />
	<input type="submit" name="updatewpwalla" value="Update" />
</form>


<h2>WP-Walla Snippet</h2>
<p>
	If you want to use WP-Walla directly on your template use this snippet.
	<br />
	<code>
		&lt;?php <br />
			$wpwalla = new WP_Walla();<br />
			$wpwalla->widget();<br />
		&gt;?
	</code>
</p>
</div>