<?php
$hidden_paginator = elgg_extract('hidden_paginator', $vars);
$time = time();

?>

<div class="wmpPaginatorWrapper">
    <div class="wmpLoadMoreBtn">
        <a href="javascript:void(0)" data-pagination="<?php echo $time ?>">
            <?php echo elgg_echo('wmp:link:load_more') ?>
        </a>
        <span class="wmpAjaxLoader hidden">
            <img src="<?php echo $vars['url'] ?>mod/watch_my_pages/graphics/ajax-loader.gif" alt="loading ..."/>
            Loading ...
        </span>
    </div>

    <div class="wmpHiddenPaginator" data-pager="<?php echo $time ?>">
        <?php echo $hidden_paginator; ?>
    </div>

</div>