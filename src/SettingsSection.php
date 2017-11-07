<?php
namespace WDIP\WPPBuilder;

use WDIP\WPPBuilder\Interfaces\ActionInterface;
use WDIP\WPPBuilder\Interfaces\CallbackInterface;
use WDIP\WPPBuilder\Interfaces\ContextInterface;
use WDIP\WPPBuilder\Interfaces\SettingsSectionInterface;

/**
 * @author: igor.popravka
 * Date: 07.11.2017
 * Time: 11:28
 */
class SettingsSection implements SettingsSectionInterface, ActionInterface, ContextInterface {
    private $fields = [];
    private $id;
    private $title;
    private $notify;
    private $page;

    public function __construct($id, $title, CallbackInterface $notify = null) {
        $this->id = $id;
        $this->title = $title;
        $this->notify = $notify;
    }

    public function &addField($id, $title, CallbackInterface $render = null, $args = array()) {
        $field = new SettingsField($id, $title, $render, $args);
        $field->setSection($this->id);
        $field->setPage($this->page);
        
        array_push($this->fields, $field);
        
        return $field;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page) {
        $this->page = $page;
    }

    public function notify(CallbackInterface $notify = null) {
        if (isset($notify)) {
            $this->notify = $notify;
        } else if (!isset($notify) && !isset($this->notify)) {
            $this->notify = new Callback($this, 'defaultNotify');
        }
        return $this->notify;
    }

    protected function defaultNotify(array $options) {
    }

    public function save() {
        add_settings_section(
            $this->id,
            $this->title,
            $this->notify()->create(),
            $this->page
        );

        foreach ($this->fields as $field){
            /** @var SettingsField $field */
            $field->save();
        }
    }

    public function create() {
    }
}