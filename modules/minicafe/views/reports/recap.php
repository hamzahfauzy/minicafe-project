<?php

use Core\Session;

 get_header() ?>
<style>
table td img {
    max-width:150px;
}
table.table td, table.table th {
    white-space:nowrap;
}
tr td:nth-child(10), tr td:nth-child(11) {
    text-align: right;
}
</style>
<div class="card mb-3">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?=get_title()?></p>
    </div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <form action="" onsubmit="window.reportOrder.draw(); return false" class="d-flex flex-wrap" style="gap:10px;">
            <div class="form-group mb-1">
                <label for="">Dari Tgl</label>
                <input type="date" name="start_date" id="" class="form-control w-100" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group mb-1">
                <label for="">Sampai Tgl</label>
                <input type="date" name="end_date" id="" class="form-control w-100" value="<?= date('Y-m-d') ?>">
            </div>
            <?php if(get_role(auth()->id)->name == 'Owner'): ?>
            <div class="form-group mb-1">
                <label for="">Cafe</label><br>
                <?= \Core\Form::input('options-obj:mc_cafes,id,name|organization_id,'.Session::get('organization')->id, 'cafe', ['class' => 'form-control w-100']) ?>
            </div>
            <?php elseif(get_role(auth()->id)->name == 'Operator'): ?>
            <input type="hidden" name="cafe" value="<?=Session::get('employee')->cafe_id?>">
            <?php endif ?>
            <div class="form-group mb-1">
                <label for="">&nbsp;</label>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary w-100">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped datatable-report-order" style="width:100%">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <?php 
                        foreach($fields as $field): 
                            $label = $field;
                            if(is_array($field))
                            {
                                $label = $field['label'];
                            }
                            $label = _ucwords($label);
                        ?>
                        <th><?=$label?></th>
                        <?php endforeach ?>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>
