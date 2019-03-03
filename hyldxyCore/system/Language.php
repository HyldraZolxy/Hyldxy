<?php
namespace hyldxyCore\system;

/**
 *  PHP Version 7.3.1
 *
 *  Class Language
 *  @package hyldxyCore
 *
 *  @comment This class display the good language for user/visitor
 *
 *  @link /hyldxyCore/system
 *  @author Kévin "Hyldra Zolxy" Robic <kevin.robic@outlook.fr>
 */

class Language
{
    /**
     *  @var Language|null
     */
    static private $_instance = null;

    /**
     *  @var array
     */
    private $_translationArray = array();

    /**
     *  @var string
     */
    private $_userLanguage;

    /**
     *  Language constructor.
     */
    public function __construct()
    {
        $this->userLanguage();
    }

    // SETTERS //

    /**
     *  Define the good language for user/visitor
     */
    private function userLanguage() {
        if (isset($_SESSION["language"])) {
            if (!empty($_SESSION["language"])) {
                if (in_array($_SESSION["language"], Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["language"]["languageAllow"])) {
                    $this->_userLanguage = $_SESSION["language"];
                } else {
                    $this->_userLanguage = Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["language"]["default"];
                }
            }
        } else if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
            if (!empty($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
                $TEMPLanguage = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"])[0];
                if (in_array($TEMPLanguage, Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["language"]["languageAllow"])) {
                    $this->_userLanguage = $TEMPLanguage;
                } else {
                    $this->_userLanguage = Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["language"]["default"];
                }
            }
        } else {
            $this->_userLanguage = Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["language"]["default"];
        }
    }

    // GETTERS //

    /**
     *  load the translation
     *  @param array $content
     *  @return mixed
     */
    public function translate($content) {
        if (is_array($content)) {
            if (isset($content[$this->_userLanguage])) {
                return $content[$this->_userLanguage][0]; // [0], un petit système pour faire du random pour la page 404 ? :3
                                                          // Mais aussi pour les versions debug des textes
            }
        }

        return false; // =X
    }

    /**
     *  Return the content of $_translationArray variable
     *
     *  @return array
     */
    public function returnTranslation() {
        return $this->_translationArray;
    }

    /**
     *  @return Language
     */
    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
}
