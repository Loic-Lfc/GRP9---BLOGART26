<?php
//define ROOT_PATH
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('ROOT_URL', 'http://' . $_SERVER['HTTP_HOST']);

//Load env
require_once ROOT . '/includes/libs/DotEnv.php';

// Chercher le fichier .env au bon endroit
$env_path = ROOT . '/.env';
if (!file_exists($env_path)) {
    $env_path = dirname(ROOT . '/index.php') . '/.env';
}

if (file_exists($env_path)) {
    (new DotEnv($env_path))->load();
}

//defines
require_once ROOT . '/config/defines.php';

//debug
if (getenv('APP_DEBUG') == 'true') {
    require_once ROOT . '/config/debug.php';
}

//load functions
require_once ROOT . '/functions/global.inc.php';

//load security
require_once ROOT . '/config/security.php';
?>