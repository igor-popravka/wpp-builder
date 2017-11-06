<?php
/**
 * Created by PhpStorm.
 * User: igor.popravka
 * Date: 07.11.2017
 * Time: 0:37
 */

namespace WDIP\WPPBuilder;


use WDIP\WPPBuilder\Interfaces\CallbackInterface;
use WDIP\WPPBuilder\Interfaces\PluginInterface;

class Callback implements CallbackInterface {
    private $plugin;
    private $method;
    
    public function __construct(PluginInterface $plugin, $method) {
        $this->plugin = $plugin;
        $this->method = $method;
    }

    public function create() {
        return [$this->plugin, $this->method];
    }
}