<?
//die("<pre>".print_r($entries,true)."</pre>");
?>

<?php
	$this->table->set_heading(
		lang('entry_name'),
		lang('status')
	);
	
	//Status falls back to "Work in Progress" if not set
	foreach($entries as $entry) {
		$this->table->add_row(
			"<a href='".$_base_url.AMP."entry_id=".$entry['entry_id']."'>".$entry['title']."</a>",
			$entry['status']? '<span class="'.str_replace(" ","",strtolower($entry['status'])).'">'.$entry['status'].'</span>' : '<span class="workinprogress">'.lang('work_in_progress').'</span>' 
			
		);
	}

?>

<?=$this->table->generate()?>
