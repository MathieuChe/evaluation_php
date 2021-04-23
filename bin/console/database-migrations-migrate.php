<?php

use eCommerce\Repository\DBA;

require_once 'config.php';
require_once 'src/eCommerce/Repository/DBA.php';

$db = new DBA();

$migrations = 'Migrations';

//migration_version
$query = $db->getPDO()->prepare(
    "SELECT COUNT(*) as `table_migration_version_exists` FROM information_schema.TABLES WHERE TABLE_SCHEMA=? AND TABLE_NAME='migration_version'"
);

$query->execute([ENV['database']['dbName']]);
$result = $query->fetch(PDO::FETCH_ASSOC);

$migration_version_exists = (bool) $result['table_migration_version_exists'];

try {
    if (!$migration_version_exists) {

        $sql = "CREATE TABLE `migration_version` (`version` VARCHAR(255) NOT NULL DEFAULT 0) ENGINE = InnoDB";
        $db->getPDO()->exec($sql);
        $sql = "INSERT INTO `migration_version` (version) VALUES (0)";
        $db->getPDO()->exec($sql);
    }
} catch (PDOException $e) {
    var_dump($e);
    die;
}

$lastExecutedVersion = $db->getPDO()->query(
    "SELECT `version`FROM `migration_version`LIMIT 1"
)->fetch(PDO::FETCH_ASSOC);
$lastExecutedVersion = (int) $lastExecutedVersion["version"];

$listSQLFiles = array_diff(scandir($migrations), ['.', '..']);
$listSQLFiles = array_map(function ($fileName) {
    return (int) str_replace('.sql', '', $fileName);
}, $listSQLFiles);

sort($listSQLFiles, SORT_NUMERIC);

$listSQLFiles = array_filter($listSQLFiles, function ($version) use ($lastExecutedVersion)
{
    return $version > $lastExecutedVersion;
});


if(empty($listSQLFiles)){
    echo "Pas de migrations à exécuter";
    exit;
}

foreach ($listSQLFiles as $file) {
    $sql = file_get_contents($migrations . '/' . $file . '.sql');


    try {
        $statement = $db->getPDO()->exec($sql);

        $db->getPDO()->exec("UPDATE `migration_version` SET version=" . $file . " WHERE TRUE");

        echo "Migration version $file est exécutée ";

    } catch (PDOException $exception) {
        var_dump($exception);
    }
}
