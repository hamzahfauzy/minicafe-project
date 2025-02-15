<?php

use Core\Session;

$having = "";

$auth = auth();
if(get_role($auth->id)->name == 'Operator')
{
    $filter['cafe_id'] = Session::get('employee')->cafe_id;
}

if(get_role($auth->id)->name == 'Owner')
{
    // $filter['cafe_id'] = Session::get('employee')->cafe_id;
    $where = (empty($where) ? 'WHERE ' : ' AND ') . "(cafe_id IN (SELECT id FROM mc_cafes WHERE organization_id = ".Session::get('organization')->id."))";
}

if($filter)
{
    $filter_query = [];
    foreach($filter as $f_key => $f_value)
    {
        $filter_query[] = "$f_key = '$f_value'";
    }

    $filter_query = implode(' AND ', $filter_query);

    $having = (empty($having) ? 'HAVING ' : ' AND ') . $filter_query;
}

$where = $where ." ". $having;

$this->db->query = "SELECT * FROM $this->table $where ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');

$total = $this->db->exists($this->table,$where);

return compact('data', 'total');