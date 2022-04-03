<?php

spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});


$db = new Database();

#$db->query("DROP TABLE IF EXISTS hw5_user;");
$db->query("CREATE TABLE project_user (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                email TEXT NOT NULL,
                name TEXT NOT NULL,
                password TEXT NOT NULL
          );");
