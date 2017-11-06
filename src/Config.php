<?php
/**
 * Created by PhpStorm.
 * User: igor.popravka
 * Date: 07.11.2017
 * Time: 0:06
 */

namespace WDIP\WPPBuilder;


use WDIP\WPPBuilder\Interfaces\ConfigInterface;

class Config implements ConfigInterface {
    /** @var \IniParser $provider */
    private static $provider;

    private $parsed_data = [];

    public function getProvider() {
        if (!isset(self::$provider)) {
            self::$provider = new \IniParser();
        }
        return self::$provider;
    }

    public function parse($file) {
        $this->parsed_data = $this->getProvider()->parse($file);
    }

    function __get($name) {
        return $this->parsed_data[$name];
    }

    function __set($name, $value) {
        if ($this->__isset($name)) {
            $this->parsed_data[$name] = $value;
        }
    }

    function __isset($name) {
        return isset($this->parsed_data[$name]);
    }

    function __unset($name) {
        unset($this->parsed_data[$name]);
    }
}