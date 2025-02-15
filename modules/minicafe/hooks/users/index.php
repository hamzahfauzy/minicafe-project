<?php

use Core\Session;

$auth = auth();

if(get_role($auth->id)->name == 'Owner')
{
    $organization = Session::get('organization');
    $where = (empty($where) ? 'WHERE ' : ' AND ') . ' (mc_cafes.organization_id IN (SELECT id FROM saas_organizations WHERE id = '.$organization->id.' )) ';
}

if(get_role($auth->id)->name == 'Operator')
{
    $employee = Session::get('employee');
    $where = (empty($where) ? 'WHERE ' : ' AND ') . ' (mc_cafes.id = '.$employee->cafe_id.') ';
}

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

$where = $where ." GROUP BY users.id, users.name, users.username, mc_cafes.name ". $having;

$query = "SELECT 
            $this->table.id,
            $this->table.name,
            $this->table.username,
            GROUP_CONCAT(DISTINCT(roles.name) SEPARATOR ', ') role_name,
            mc_cafes.name cafe
          FROM $this->table 
          LEFT JOIN user_roles ON user_roles.user_id = users.id
          LEFT JOIN roles ON roles.id = user_roles.role_id
          LEFT JOIN mc_employees ON mc_employees.user_id = users.id
          LEFT JOIN mc_cafes ON mc_cafes.id = mc_employees.cafe_id
          $where";

$this->db->query = "$query ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');

$this->db->query = $query;
$total = $this->db->exec('exists');

return compact('data','total');