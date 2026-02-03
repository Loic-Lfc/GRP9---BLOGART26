<?php
// Configuration pour WAMP - connexion à la base de données
// Si tu as un .env, les valeurs ci-dessous seront remplacées par getenv()
// Sinon, les valeurs par défaut seront utilisées

$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pwd = getenv('DB_PASSWORD');
$db_database = getenv('DB_DATABASE');

// Valeurs par défaut si les variables d'env ne sont pas chargées
if (!$db_host) $db_host = 'localhost';
if (!$db_user) $db_user = 'root';
if (!$db_pwd) $db_pwd = '';
if (!$db_database) $db_database = 'BLOGART26';

define('SQL_HOST', $db_host);
define('SQL_USER', $db_user);
define('SQL_PWD', $db_pwd);
define('SQL_DB', $db_database);
?>