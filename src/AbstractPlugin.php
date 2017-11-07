<?php
namespace WDIP\WPPBuilder;

use WDIP\WPPBuilder\Interfaces\CallbackInterface;
use WDIP\WPPBuilder\Interfaces\ContextInterface;
use WDIP\WPPBuilder\Interfaces\PluginInterface;
use WDIP\WPPBuilder\Interfaces\ScriptInterface;
use WDIP\WPPBuilder\Interfaces\SettingsInterface;
use WDIP\WPPBuilder\Interfaces\StyleInterface;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 11:09
 */
abstract class AbstractPlugin implements PluginInterface, ContextInterface {
    /** @var string $path */
    private $path = "";

    /** @var string $plugin_folder */
    private $folder = "";

    /** @var Config $config */
    private $config;

    private $settings = [];

    private $scripts = [];

    private $styles = [];

    private static $instance;

    abstract protected function initAdminActions();

    abstract protected function initActions();

    abstract protected function initDeactivationActions();

    private function __construct() {
    }

    /**
     * @return mixed
     */
    public static function instance() {
        if (!isset(self::$instance)) {
            $class = get_called_class();
            self::$instance = new $class;
        }
        return self::$instance;
    }

    /**
     * @param string $plugin
     * @param string $config
     */
    public function build($plugin = "", $config = "") {
        $this->path = !empty($plugin) && file_exists($plugin) ? $plugin : __FILE__;
        $this->folder = pathinfo($this->path, PATHINFO_DIRNAME);

        if (!empty($config) && file_exists($config)) {
            $this->getConfig()->parse($config);
        }

        if (is_admin()) {
            $this->initAdminActions();
        } else {
            $this->initActions();
        }

        $this->initDeactivationActions();
    }

    /**
     * @return Config
     */
    public function getConfig() {
        if (!isset($this->config)) {
            $this->config = new Config();
        }
        return $this->config;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getFolder() {
        return $this->folder;
    }

    public function initAdminMenu(CallbackInterface $callback) {
        add_action('admin_menu', $callback->create());
        return $this;
    }

    public function initAdminSettings(CallbackInterface $callback) {
        add_action('admin_init', $callback->create());
        return $this;
    }

    public function initAdminEnqueueScripts(CallbackInterface $callback) {
        add_action('admin_enqueue_scripts', $callback->create());
        return $this;
    }

    public function initEnqueueScripts(CallbackInterface $callback) {
        add_action('wp_enqueue_scripts', $callback->create());
        return $this;
    }

    public function addAjaxAction($action, CallbackInterface $callback, $nopriv = true) {
        $nopriv = $nopriv ? '_nopriv' : '';
        add_action("wp_ajax{$nopriv}_{$action}", $callback->create());
        return $this;
    }

    public function addShortCode($code, CallbackInterface $callback) {
        add_shortcode($code, $callback->create());
        return $this;
    }

    public function registerDeactivation(CallbackInterface $callback) {
        register_deactivation_hook($this->getPath(), $callback->create());
        return $this;
    }

    public function addSetting(SettingsInterface $setting) {
        array_push($this->settings, $setting);
        return $this;
    }

    public function registerSettings() {
        foreach ($this->settings as $setting) {
            /** @var Settings $setting */
            $setting->save();
        }
        return $this;
    }

    public function addScript(ScriptInterface $script) {
        array_push($this->scripts, $script);
        return $this;
    }

    public function registerScripts() {
        foreach ($this->scripts as $script) {
            /** @var Script $script */
            $script->setPage($this->getPath())->save();
        }
        return $this;
    }

    public function addStyle(StyleInterface $style) {
        array_push($this->styles, $style);
        return $this;
    }

    public function registerStyles() {
        foreach ($this->styles as $style) {
            /** @var Style $style */
            $style->setPage($this->getPath())->save();
        }
        return $this;
    }
}