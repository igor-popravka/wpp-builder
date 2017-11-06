<?php
namespace WDIP\WPPBuilder\Interfaces;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 15:50
 */
interface SettingsInterface {
    public function __construct($group, $name, $page);
    public function validate();
    public function createSection($id, $title, CallbackInterface $callback);
}