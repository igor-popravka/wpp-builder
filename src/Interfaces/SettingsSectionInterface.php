<?php
namespace WDIP\WPPBuilder\Interfaces;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 15:30
 */
interface SettingsSectionInterface {
    public function addField($id, $title, CallbackInterface $render = null, $args = array());
}