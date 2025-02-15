<?php

$auth = auth();
$role = get_role($auth->id);

if(strtolower($role->name) == 'kitchen')
{
    if($data->status == 'NEW')
    {
        return '<a href="'.routeTo('minicafe/orders/approve-item', ['id' => $data->id]).'" class="btn btn-sm btn-success" onclick="if(confirm(\'Apakah anda yakin akan mengerjakan pesanan ini?\')){return true}else{return false}"><i class="fas fa-check"></i> Approve</a>';
    }
    
    if($data->status == 'ON PROGRESS')
    {
        return '<a href="'.routeTo('minicafe/orders/done-item', ['id' => $data->id]).'" class="btn btn-sm btn-success" onclick="if(confirm(\'Apakah anda yakin telah menyelesaikan pesanan ini?\')){return true}else{return false}"><i class="fas fa-check"></i> Done</a>';
    }
}

if(strtolower($role->name) == 'waiter')
{
    if($data->status == 'DONE')
    {
        return '<a href="'.routeTo('minicafe/orders/close-item', ['id' => $data->id]).'" class="btn btn-sm btn-success" onclick="if(confirm(\'Apakah anda yakin telah menyajikan pesanan ini?\')){return true}else{return false}"><i class="fas fa-check"></i> Close</a>';
    }
}

return '';