<?php

    if (!file_exists("../user/instance.inc.php")) {
        header("Location: /setup.php");
        exit;
    }

    require_once("../user/instance.inc.php");
    require_once("scripts/php/includes/settings.inc.php");

    if (IS_STOPPED) {
        echo file_get_contents("updating.html");
        exit;
    }

    require_once(APP_SCRIPTS_PHP_PATH . "includes/version.inc.php");
    require_once(APP_SCRIPTS_PHP_PATH . "includes/extensions.inc.php");
    require_once(APP_SCRIPTS_PHP_PATH . "libs/DefaultPhp.class.php");
    require_once(APP_SCRIPTS_PHP_PATH . "libs/DefaultWeb.class.php");

    session_start();

    $phpObject = new DefaultPhp();
    $webObject = new DefaultWeb();

    require_once(APP_SCRIPTS_PHP_PATH . "includes/postinit.inc.php");
    require_once(APP_SCRIPTS_PHP_PATH . "includes/autoupdate.inc.php");

    $webObject->processRequestNG();

?>