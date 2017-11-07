<?php
namespace WDIP\WPPBuilder;

use WDIP\WPPBuilder\Interfaces\ActionInterface;
use WDIP\WPPBuilder\Interfaces\CallbackInterface;
use WDIP\WPPBuilder\Interfaces\ContextInterface;
use WDIP\WPPBuilder\Interfaces\SettingsFieldInterface;

/**
 * @author: igor.popravka
 * Date: 07.11.2017
 * Time: 11:50
 */
class SettingsField implements SettingsFieldInterface, ActionInterface, ContextInterface {
    private $id;
    private $title;
    private $render;
    private $page;
    private $section = 'default';
    private $args = array();

    public function __construct($id, $title, CallbackInterface $render = null, $args = array()) {
        $this->id = $id;
        $this->title = $title;
        $this->render = $render;
        $this->args = $args;
    }

    public function setPage($page){
        $this->page = $page;
    }

    public function setSection($section){
        $this->section = $section;
    }

    public function render(CallbackInterface $render = null) {
        if (isset($render)) {
            $this->render = $render;
        } else if (!isset($render) && !isset($this->render)) {
            $this->render = new Callback($this, 'defaultRender');
        }
        return $this->render;
    }

    protected function defaultRender(array $options) {
    }

    public function save() {
        add_settings_field(
            $this->id,
            $this->title,
            $this->render()->create(),
            $this->page,
            $this->section,
            $this->args
        );
    }

    public function create() {
    }

}