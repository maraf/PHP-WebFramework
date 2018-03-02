<?php

  /**
   *
   *  Web config.
   *
   */
   define("PHP_SCRIPTS", "scripts/php/");
   define("SCRIPTS", "scripts/");
   
   define("FS_ROOT", WEB_ROOT."files/");
   
   define("WEB_PATH", $_SERVER['DOCUMENT_ROOT'] . WEB_DOCUMENT_ROOT . WEB_ROOT);
   define("FS_PATH", $_SERVER['DOCUMENT_ROOT'] . WEB_DOCUMENT_ROOT . FS_ROOT);

   define("FILE_PAGE_PATH", "/file/");
   define("TEMPLATES_CACHE_DIR", "cache/templates/");
   define("SYSTEM_PROPERTY_CACHE_DIR", "cache/systemproperty/");

   define("WEB_R_READ", 101);
   define("WEB_R_WRITE", 102);
   define("WEB_R_DELETE", 103);
   define("WEB_R_ADDCHILD", 104);

   define("WEB_GROUP", "web");
   
   define("VIEW_ROOT", 'admin');


?>