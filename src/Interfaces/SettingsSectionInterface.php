<?php
namespace WDIP\WPPBuilder\Interfaces;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 16:13
 */
interface SettingsSectionInterface {
    public function addField($id, $title, CallbackInterface $callback, $args = array());
}