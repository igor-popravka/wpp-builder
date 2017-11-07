<?php
namespace WDIP\WPPBuilder;

use WDIP\WPPBuilder\Interfaces\ActionInterface;
use WDIP\WPPBuilder\Interfaces\CallbackInterface;
use WDIP\WPPBuilder\Interfaces\ContextInterface;
use WDIP\WPPBuilder\Interfaces\SettingsInterface;

/**
 * @author: igor.popravka
 * Date: 07.11.2017
 * Time: 10:26
 */
class Settings implements SettingsInterface, ActionInterface, ContextInterface {
    private $sections = [];

    private $group;
    private $name;
    private $page;
    /** @var CallbackInterface */
    private $validator;

    public function __construct($group, $name, $page) {
        $this->group = $group;
        $this->name = $name;
        $this->page = $page;
    }

    public function &addSection($id, $title, CallbackInterface $notify = null) {
        $section = new SettingsSection($id, $title, $notify);
        $section->setPage($this->page);

        array_push($this->sections, $section);

        return $section;
    }

    public function validator(CallbackInterface $validator = null) {
        if (isset($validator)) {
            $this->validator = $validator;
        } else if (!isset($validator) && !isset($this->validator)) {
            $this->validator = new Callback($this, 'defaultValidator');
        }
        return $this->validator;
    }

    public function save() {
        register_setting(
            $this->group,
            $this->name,
            $this->validator()->create()
        );

        foreach ($this->sections as $section){
            /** @var SettingsSection $section */
            $section->save();
        }
    }

    protected function defaultValidator(array $options) {
    }

    public function create() {
    }
}