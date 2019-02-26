<?php
namespace hyldxyCore;

/**
 *  PHP Version 7.3.1
 *
 *  Class Autoloader
 *  @package hyldxyCore
 *
 *  @comment This class auto-load all page with class name
 *
 *  @link /hyldxyCore
 *  @author Kévin "Hyldra Zolxy" Robic <kevin.robic@outlook.fr>
 */


class Autoloader
{
    static public function register()
    {
        spl_autoload_register(array(__CLASS__, "autoload"));
    }

    /**
     *  @param $class string
     *  TODO: This function search in the namespace "hyldxyCore", so just the hyldxyCore folder
     */
    static public function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . "\\") === 0) {
            $class = str_replace(__NAMESPACE__ . "\\", "", $class);
            $class = str_replace("\\",                 DS, $class);

            require_once $class . ".php";
        }
    }
}
