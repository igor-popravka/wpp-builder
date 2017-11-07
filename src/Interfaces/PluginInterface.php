<?php
namespace WDIP\WPPBuilder\Interfaces;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 11:12
 */
interface PluginInterface {
    public function build($plugin = "", $config = "");

    public function getFolder();

    public function getPath();

    public function initAdminMenu(CallbackInterface $callback);

    public function initAdminSettings(CallbackInterface $callback);

    public function initAdminEnqueueScripts(CallbackInterface $callback);

    public function initEnqueueScripts(CallbackInterface $callback);

    public function addAjaxAction($action, CallbackInterface $callback, $nopriv = true);

    public function addShortCode($code, CallbackInterface $callback);

    public function registerDeactivation(CallbackInterface $callback);

    public function addSetting(SettingsInterface $setting);

    public function registerSettings();

    public function addScript(ScriptInterface $script);

    public function registerScripts();

    public function addStyle(StyleInterface $style);
    
    public function registerStyles();

    public function getVersion();

    public function getConfig();
}