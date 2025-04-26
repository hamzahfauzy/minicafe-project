<?php

$btn = '<a href="'.routeTo('crud/index', ['table' => 'mc_product_prices', 'filter' => ['product_id'=>$data->id]]).'" class="btn btn-sm btn-info"><i class="fas fa-dollar-sign"></i> '.__('minicafe.label.price').'</a> ';

return $btn;