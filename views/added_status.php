<?
//die("<pre>".print_r($entries,true)."</pre>");
if ($success == FALSE) {?>
	<p><?=$channel_title?> already has a status field.</p>
<?} 
else { ?>
	<p>Added! Field id is <?=$id?></p>
<?}
