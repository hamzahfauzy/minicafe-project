<?php

use Core\Database;

$auth = auth();
$db = new Database;
if($auth)
{
    $_SESSION['organization'] = $db->single('saas_organizations', [
        'owner_id' => $auth->id
    ]);
}