<?php






defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT','xampp'.DS.'localhost'.DS.'REST-API');
defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');



//load the config file first
require_once("../includes/config.php");

//core classes
require_once("post.php");



?>