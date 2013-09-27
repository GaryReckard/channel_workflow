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
      $entry['status']? $entry['status'] : lang('work_in_progress') 
		);
	}

?>

<?=$this->table->generate()?>
