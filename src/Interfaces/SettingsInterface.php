<?php
namespace WDIP\WPPBuilder\Interfaces;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 15:50
 */
interface SettingsInterface {
    public function addSection($id, $title, CallbackInterface $notify = null);

    public function validator(CallbackInterface $validator);
}