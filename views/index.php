<p><?=lang('welcome')?></p>
<!--<p><?=lang('warning')?></p>-->

<?php
	$this->table->set_heading(
		lang('channel_name'),
		lang('status'),
		lang('action')
	);
	
	//if channel has workflow enabled, channel name is a link that takes you to Completion Status view channel
	foreach($channels as $channel_id=>$channel) {

    //disregard Pages channel
    if ($channel['channel_title'] == 'Page') continue;

		$this->table->add_row(
      $channel['channel_title'],
      $channel['has_status']? lang('has_status_field'): lang('does_not_have_status_field'),
      $channel['has_status']? "<a href='".$_base_url.AMP."method=viewStatus".AMP."channel_id=".$channel_id.AMP."channel_title=".$channel['channel_title']."'>".lang('view_status')."</a>": "<a href='".$channel_fields_url."'>".lang('add_status')."</a>"
		);
	}

?>

<?=$this->table->generate()?>
