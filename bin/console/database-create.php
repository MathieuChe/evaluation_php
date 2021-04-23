<?php



// bin/console/database-create.php

require_once 'config.php';

try {

    $conn =  new \PDO(
        'mysql:host=' . ENV['database']['host'], ENV['database']['user'], ENV['database']['password']
    );

    $sql = 'CREATE DATABASE IF NOT EXISTS ' .
        ENV['database']['dbName'] .
        ' DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci';

    $conn->exec($sql);
    echo "Database " . ENV['database']['dbName'] . " created successfully";

} catch (PDOException $e) {

    var_dump($e);
}

$conn = null;