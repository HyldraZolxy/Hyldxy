<?php
namespace hyldxyCore\system;

/**
 *  PHP Version 7.3.1
 *
 *  Class ErrorsHandler
 *  @package hyldxyCore
 *
 *  @comment This class manage all PHP errors
 *  @TODO: Template system 0%
 *
 *  @link /hyldxyCore/system
 *  @author Kévin "Hyldra Zolxy" Robic <kevin.robic@outlook.fr>
 */

class ErrorsHandler
{
    protected $_lastErrors,
              $_errorTypeString,
              $_errorText; // Temporary, see the TODO in the hyldxyErrors function

    /**
     *  ErrorsHandler constructor.
     */
    public function __construct()
    {
        /**
         *  PHP function initialization
         */
        error_reporting(0); // 0 for prod, -1 for dev
        set_error_handler(array($this, "hyldxyErrors"));
        register_shutdown_function(array($this, "hyldxyFatalErrors"));
    }

    /**
     *  @param $type int
     *  @param $text string
     *  @param null $file string
     *  @param null $line int
     */
    public function hyldxyErrors($type, $text, $file = NULL, $line = NULL)
    {
        switch ($type) {
            // Fatal errors
            case 1:
            case 4:
            case 64:
                $this->_errorTypeString = "Fatal";

                if (Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["errors"]["debug"]
                    && Parser::IP_comparison(Parser::IP_parser(), Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["errors"]["ipAllow"])) {
                    $this->_errorText = "Une erreur est arrivé, voici le détail:<br />
                                                 <br />
                                                 Fichier: " . $file . "<br />
                                                 Ligne en cause: " . $line . "<br />
                                                 Le message d'erreur: " . $text . "<br />
                                                 <br />
                                                 Merci de corriger cela au plus vite";
                } else {
                    $this->_errorText = Language::getInstance()->translate(Parser::JSON_parser(join(DS, array(HYLDXYTRADS, "basicLanguage.json")), true)["errors"]["fatalErrors"]);
                }

                echo $this->_errorText;
                break;
            default:
                // 2 - 8 - 2048 - 4096
                $this->_errorTypeString = "Normal";

                if (Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["errors"]["debug"]
                    && Parser::IP_comparison(Parser::IP_parser(), Parser::JSON_parser(join(DS, array(HYLDXYCONFIG, "basic.json")), true)["errors"]["ipAllow"])) {
                    Notifications::getInstance()->add($type, $text, $file, $line);
                } else {
                    Notifications::getInstance()->add($type, Language::getInstance()->translate(Parser::JSON_parser(join(DS, array(HYLDXYTRADS, "basicLanguage.json")), true)["errors"]["notificationsErrors"]));
                }

                break;
        }

        file_put_contents(join(DS, array(HYLDXYLOGS, "hyldxy_errors_logs.txt")), "[" . date("D d/m/Y H:i:s") . "][" . $this->_errorTypeString . " error type°" . $type . " in \"" . $file . "\" on the line n°" . $line . "] " . $text . "\r\n\n", FILE_APPEND);
    }

    /**
     *  Function for catch fatal error
     */
    public function hyldxyFatalErrors()
    {
        $this->_lastErrors = error_get_last();
        $this->hyldxyErrors($this->_lastErrors["type"], $this->_lastErrors["message"], $this->_lastErrors["file"], $this->_lastErrors["line"]);
    }
}
