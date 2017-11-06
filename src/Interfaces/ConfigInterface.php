<?php
namespace WDIP\WPPBuilder\Interfaces;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 13:54
 */
interface ConfigInterface {
    public function getProvider();

    public function parse($file);
}