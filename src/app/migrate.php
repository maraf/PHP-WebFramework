<?php

    if (!file_exists("../user/instance.inc.php")) {
        header("Location: /setup.php");
        exit;
    }

    require_once("../user/instance.inc.php");
    require_once("scripts/php/includes/settings.inc.php");

    require_once(APP_SCRIPTS_PHP_PATH . "libs/Database.class.php");

    $db = new Database(false);
    $db->disableCache();
    $db->getDataAccess()->connect(WEB_DB_HOSTNAME, WEB_DB_USER, WEB_DB_PASSWORD, WEB_DB_DATABASE, false);
    $db->getDataAccess()->transaction();
    
    $dbObject = $db;
    
    require_once(APP_SCRIPTS_PHP_PATH . "includes/autoupdate.inc.php");
    
    $db->getDataAccess()->disconnect();

?>