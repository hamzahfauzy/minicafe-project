<?php

use Core\Database;
use Core\Session;

$auth = auth();

if(get_role($auth->id)->name == 'Owner')
{
    $organization = Session::get('organization');
    $fields['category_id']['type'] .= '|organization_id,'.$organization->id;
    $fields['cafe_id']['type'] .= '|organization_id,'.$organization->id;
    
    $db = new Database;
    $db->query = "SELECT 
                    mc_employees.user_id,
                    concat(users.name,' - ',mc_cafes.name) employee_name 
                FROM mc_employees 
                LEFT JOIN users ON users.id = mc_employees.user_id 
                LEFT JOIN user_roles ON user_roles.user_id = users.id 
                LEFT JOIN roles ON roles.id = user_roles.role_id
                LEFT JOIN mc_cafes ON mc_cafes.id = mc_employees.cafe_id
                WHERE mc_employees.cafe_id IN (SELECT id FROM mc_cafes WHERE organization_id = $organization->id) AND roles.name = 'Kitchen'";
    $employees = $db->exec('all');
    $employeeOptions = [];
    foreach($employees as $employee)
    {
        $employeeOptions[$employee->employee_name] = $employee->user_id;
    }

    $fields['target_id']['type'] = 'options:'.json_encode($employeeOptions);
}

if(get_role($auth->id)->name == 'Operator')
{
    $employee = Session::get('employee');
    $fields['category_id']['type'] .= '|organization_id,'.$employee->cafe->organization_id;
    unset($fields['cafe_id']);
    
    $db = new Database;
    $db->query = "SELECT 
                    mc_employees.user_id,
                    concat(users.name,' - ',mc_cafes.name) employee_name 
                FROM mc_employees 
                LEFT JOIN users ON users.id = mc_employees.user_id 
                LEFT JOIN user_roles ON user_roles.user_id = users.id 
                LEFT JOIN roles ON roles.id = user_roles.role_id
                LEFT JOIN mc_cafes ON mc_cafes.id = mc_employees.cafe_id
                WHERE mc_employees.cafe_id = $employee->cafe_id AND roles.name = 'Kitchen'";
    $employees = $db->exec('all');
    $employeeOptions = [];
    foreach($employees as $employee)
    {
        $employeeOptions[$employee->employee_name] = $employee->user_id;
    }

    $fields['target_id']['type'] = 'options:'.json_encode($employeeOptions);
}


return $fields;