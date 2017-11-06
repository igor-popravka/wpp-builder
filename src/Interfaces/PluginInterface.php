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

    public function addOptionsPage(OptionsPageInterface $page);

    public function addJS(ScriptInterface $script);

    public function addCSS(StyleInterface $style);

    public function getVersion();

    public function getConfig();
}