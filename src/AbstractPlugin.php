<?php
namespace WDIP\WPPBuilder;

use WDIP\WPPBuilder\Interfaces\PluginInterface;
use WDIP\WPPBuilder\Interfaces\ConfigInterface;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 11:09
 */
abstract class AbstractPlugin implements PluginInterface {
    /** @var string $plugin_file */
    private $plugin_file = "";

    /** @var string $plugin_folder */
    private $plugin_folder = "";

    /** @var ConfigInterface $config */
    private $config;
}