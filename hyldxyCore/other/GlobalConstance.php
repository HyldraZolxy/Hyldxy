<?php
namespace hyldxyCore\other;

/**
 *  PHP Version 7.3.1
 *
 *  @package hyldxyCore
 *  @comment Contains all Global constants
 *
 *  @link /hyldxyCore/other
 *  @author Kévin "Hyldra Zolxy" Robic <kevin.robic@outlook.fr>
 */

// General
define("DS", DIRECTORY_SEPARATOR);

// Folder
define("ORIGIN", substr(__DIR__, 0, strlen(__DIR__) - 17)); // -17 = \hyldxyCore\other
define("HYLDXYCORE", join(DS, array(ORIGIN, "hyldxyCore")));
define("HYLDXYCONFIG", join(DS, array(HYLDXYCORE, "config")));
define("HYLDXYLOGS", join(DS, array(ORIGIN, "logsFiles")));
define("WWW", join(DS, array(ORIGIN, "www")));
