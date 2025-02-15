<?php

use Core\Session;

$having = "";

$where .= (empty($where) ? "WHERE " : "AND ") . " $this->table.status <> 'CLOSE'";

$auth = auth();
if(get_role($auth->id)->name == 'Operator')
{
    $filter['cafe_id'] = Session::get('employee')->cafe_id;
}

if(get_role($auth->id)->name == 'Owner')
{
    // $filter['cafe_id'] = Session::get('employee')->cafe_id;
    $where = " AND (mc_orders.cafe_id IN (SELECT id FROM mc_cafes WHERE organization_id = ".Session::get('organization')->id."))";
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

$this->db->query = "SELECT 
                        $this->table.*, 
                        CONCAT(mc_categories.name,' - ',mc_products.name) product_name,
                        mc_orders.code, 
                        mc_orders.table_name, 
                        mc_orders.floor_name, 
                        mc_customers.name customer_name 
                    FROM $this->table 
                    LEFT JOIN mc_products ON mc_products.id = $this->table.product_id
                    LEFT JOIN mc_categories ON mc_categories.id = mc_products.category_id
                    LEFT JOIN mc_orders ON mc_orders.id = $this->table.order_id 
                    LEFT JOIN mc_customers ON mc_customers.id = mc_orders.customer_id 
                    $where 
                    ORDER BY ".$col_order." ".$order[0]['dir']." LIMIT $start,$length";
$data  = $this->db->exec('all');

$total = $this->db->exists($this->table,$where);

return compact('data','total');