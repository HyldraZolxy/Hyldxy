<?php
namespace hyldxyCore\system;

/**
 *  PHP Version 7.3.1
 *
 *  Class Notifications
 *  @package hyldxyCore
 *
 *  @comment This class stock and return all notifications. (User and PHP errors)
 *
 *  @link /hyldxyCore/system
 *  @author Kévin "Hyldra Zolxy" Robic <kevin.robic@outlook.fr>
 */

class Notifications
{
    /**
     *  @var Notifications|null
     */
    static private $_instance = null;

    /**
     *  @var array
     */
    private $_notifArray = array();

    /**
     *  Notifications constructor.
     */
    public function __construct()
    {}

    // SETTERS //

    /**
     *  Function for add a notification
     *
     *  @param int $type
     *  @param string $text
     *  @param null $file
     *  @param null $line
     */
    public function add($type, $text, $file = null, $line = null) {
        if (is_int($type) && !empty($text)) {
            $this->_notifArray[] = array($type, $text, $file, $line);
        }
    }

    // GETTERS //

    /**
     *  Return the content of $_notifArray variable
     *
     *  @return array
     */
    public function returnNotification() {
        return $this->_notifArray;
    }

    /**
     *  @return Notifications
     */
    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
}
