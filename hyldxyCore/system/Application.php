<?php
namespace hyldxyCore\system;

/**
 *  PHP Version 7.3.1
 *
 *  Class Application
 *  @package hyldxyCore
 *
 *  @comment This class manage the web site entirely
 *
 *  @link /hyldxyCore/system
 *  @author Kévin "Hyldra Zolxy" Robic <kevin.robic@outlook.fr>
 */

class Application
{
    /**
     *  @var Application|null
     */
    static private $_instance = null;

    /**
     *  Application constructor.
     */
    public function __construct()
    {}

    // SETTERS //
    // GETTERS //

    /**
     *  @return Application
     */
    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     *  TODO: Delete this after all work properly
     *  @return string
     */
    public function temp()
    {
        return "Coucouw from Application class !";
    }
}
