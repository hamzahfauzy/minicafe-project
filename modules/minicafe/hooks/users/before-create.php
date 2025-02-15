<?php

$_POST['cafe'] = $data['cafe'];
$data['password'] = md5($data['password']);
unset($data['cafe']);