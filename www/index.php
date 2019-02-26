<?php
use hyldxyCore\Autoloader;
use hyldxyCore\system\Application;
use hyldxyCore\system\ErrorsHandler;

/**
 *  PHP Version 7.3.1
 *
 *  @link /www
 *  @author Kévin "Hyldra Zolxy" Robic <kevin.robic@outlook.fr>
 */

/**
 *  Global constance of this application
 */
require_once join(DIRECTORY_SEPARATOR, array("..", "hyldxyCore", "other", "GlobalConstance.php"));

/**
 *  Autoloader
 */
require_once join(DS, array(HYLDXYCORE, "Autoloader.php"));
Autoloader::register();

/**
 *  Errors Handler
 */
new ErrorsHandler();

/**
 *  TODO: Remove that after ErrorsHandler module work properly
 */
$qzdhb->qzd();

/**
 *  Application core
 */
$app = Application::getInstance();
echo $app->temp();
