<?php
    include "../config.php";

    $db = DB_NAME;
    $prefix = DB_TABLE_PREFIX;

    $sql = file_get_contents('create.sql');

    $sql = str_replace(
        array('[database]', '[prefix]'), 
        array(DB_NAME, DB_TABLE_PREFIX), 
        $sql
    );


echo '<pre>';
print_r($sql);
echo '</pre>';
exit;

    echo $db;
?>