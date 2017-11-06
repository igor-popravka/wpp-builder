<?php
namespace WDIP\WPPBuilder\Interfaces;

/**
 * @author: igor.popravka
 * Date: 06.11.2017
 * Time: 11:12
 */
interface PluginInterface {
    public function build($plugin_path = "", $plugin_config = "");

    public function getPluginFolder();

    public function getPluginFile();

    public function addAdminMenu(CallbackInterface $callback);

    public function addAdminSettings(CallbackInterface $callback);

    public function addAdminEnqueueScripts(CallbackInterface $callback);

    public function addAjax($action, CallbackInterface $callback, $nopriv = true);

    public function addEnqueueScripts(CallbackInterface $callback);

    public function addShortCode($code, CallbackInterface $callback);

    public function registerDeactivation(CallbackInterface $callback);

    public function addOptionsPage(OptionsPageInterface $page);

    public function addJScript(ScriptInterface $script);

    public function addStyle(StyleInterface $style);

    public function getVersion();

}