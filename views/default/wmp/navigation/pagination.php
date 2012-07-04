<?php
$hidden_paginator = elgg_extract('hidden_paginator', $vars);
$time = time();

?>

<div class="wmpPaginatorWrapper">
    <div class="wmpLoadMoreBtn">
        <a href="javascript:void(0)" data-pagination="<?php echo $time ?>">Load More</a>
    </div>

    <div class="wmpHiddenPaginator" data-pager="<?php echo $time ?>">
        <?php echo $hidden_paginator; ?>
    </div>

</div>