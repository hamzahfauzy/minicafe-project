<?php

if($data->status == 'NON ACTIVE')
{
    return '<a href="'.routeTo('minicafe/products/activate-price', ['id' => $data->id]).'" class="btn btn-sm btn-success" onclick="if(confirm(\'Apakah kamu yakin akan mengaktifkan harga ini ?\')){return true}else{return false}"><i class="fas fa-check"></i> '.__('minicafe.label.activate').'</a> ';
}

return '';