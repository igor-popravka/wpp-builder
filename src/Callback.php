<?php
/**
 * Created by PhpStorm.
 * User: igor.popravka
 * Date: 07.11.2017
 * Time: 0:37
 */

namespace WDIP\WPPBuilder;


use WDIP\WPPBuilder\Interfaces\ActionInterface;
use WDIP\WPPBuilder\Interfaces\CallbackInterface;
use WDIP\WPPBuilder\Interfaces\ContextInterface;

class Callback implements CallbackInterface, ActionInterface, ContextInterface {
    private $context;
    private $method;

    public function __construct(ContextInterface $context, $method) {
        $this->context = $context;
        $this->method = $method;
    }

    public function create() {
        return [$this->context, $this->method];
    }
    
    public function save() {
    }
}