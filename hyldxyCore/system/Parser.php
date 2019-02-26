<?php
namespace hyldxyCore\system;

/**
 *  PHP Version 7.3.1
 *
 *  Class Parser
 *  @package hyldxyCore
 *
 *  @comment This class parse all data
 *
 *  @link /hyldxyCore/system
 *  @author Kévin "Hyldra Zolxy" Robic <kevin.robic@outlook.fr>
 */

class Parser
{
    /**
     *  @param null $jsonParam boolean
     *  @return mixed
     */
    static public function JSON_parser($jsonParam = null)
    {
        return json_decode(file_get_contents(join(DS, array(HYLDXYCONFIG, "basic.json"))), $jsonParam);
    }

    /**
     * @return string
     */
    static public function IP_parser() {
        $argsServerVar = array(
            "HTTP_CLIENT_IP",
            "HTTP_X_FORWARDED_FOR",
            "REMOTE_ADDR"
        );

        for ($i = 0; $i < count($argsServerVar); $i++) {
            if (isset($_SERVER[$argsServerVar[$i]])) {
                return $_SERVER[$argsServerVar[$i]];
            }
        }

        return "0.0.0.0";
    }

    /**
     *  @param $ipClient string
     *  @param $ipArray array
     *  @return bool
     */
    static public function IP_comparison($ipClient, $ipArray) {
        for ($i = 0; $i < count($ipArray); $i++) {
            if ($ipClient === $ipArray[$i]) {
                return true;
            }
        }

        return false;
    }
}
