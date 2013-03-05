<?php

$infinitive_enabled = can_infinitive_scroll();
$infinitive_value = 'no';
if ($infinitive_enabled) {
    $infinitive_value = 'yes';
}

?>

<p>
    <label for=""><?php echo elgg_echo('watch_my_pages:infinite_scroll:label'); ?></label>
    <?php echo elgg_view('input/dropdown', array('name' => 'params[infinite_scroll]', 'value' => $infinitive_value, 'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')))); ?>
</p>
