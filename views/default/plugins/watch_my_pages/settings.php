<?php
    $can_infinitive = can_infinitive_scroll();
    $infinitive_value = 'no';
    
    if ($can_infinitive) {
        $infinitive_value = 'yes';
    }
?>

<p>
    <label for="">Infinit Scroll</label>
    <?php echo elgg_view('input/dropdown', array('name' => 'params[infinite_scroll]', 'value' => $infinitive_value, 'options_values' => array('yes' => elgg_echo('option:yes'), 'no' => elgg_echo('option:no')))); ?>
</p>
