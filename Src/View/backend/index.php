<?php view('layouts.header', $params); ?>

<div class="row">
    <div class="col-sm-2" style="padding: 0 0 0 15px;">
        <?= view('backend.layouts.sidebar'); ?>
    </div><!-- end sidebar -->
    <div class="col-sm-10" style="padding-right: 10px;">
        <?php view($view, $params); ?>
    </div><!-- end content -->
</div>

<?php view('layouts.footer'); ?>