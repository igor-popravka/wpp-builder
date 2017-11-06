<?php
namespace WDIP\WPPBuilder\Interfaces;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 14:17
 */
interface CallbackInterface extends CreatorInterface{
    public function __construct(PluginInterface $plugin, $method);
}