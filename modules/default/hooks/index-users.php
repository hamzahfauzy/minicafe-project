<?php

$having = "";

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

$where = $where ." GROUP BY users.id, users.name, users.username ". $having;

$query = "SELECT 
            $this->table.id,
            $this->table.name,
            $this->table.username,
            GROUP_CONCAT(DISTINCT(roles.name) SEPARATOR ', ') role_name
          FROM $this->table 
          LEFT JOIN user_roles ON user_roles.user_id = users.id
          LEFT JOIN roles ON roles.id = user_roles.role_id
          $where";

$this->db->query = "$query ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');

$this->db->query = $query;
$total = $this->db->exec('exists');

return compact('data','total');