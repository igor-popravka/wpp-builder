<?php
namespace WDIP\WPPBuilder;

use WDIP\WPPBuilder\Interfaces\ActionInterface;
use WDIP\WPPBuilder\Interfaces\ScriptInterface;

/**
 * @author: igor.popravka
 * Date: 07.11.2017
 * Time: 12:21
 */
class Script implements ScriptInterface, ActionInterface {
    private $handle;
    private $src = '';
    private $deps = array();
    private $ver = false;
    private $in_footer = false;
    private $page;
    
    public function __construct($handle, $src = '', $deps = array(), $ver = false, $in_footer = false) {
        $this->handle = $handle;
        $this->src = $src;
        $this->deps = $deps;
        $this->ver = $ver;
        $this->in_footer = $in_footer;
    }
    
    public function setPage($page){
        $this->page = $page;
        return $this;
    }

    public function save() {
        wp_enqueue_script(
            $this->handle, 
            plugins_url($this->src, $this->page), 
            $this->deps,
            $this->ver,
            $this->in_footer
        );
        return $this;
    }

    public function create() {
        return $this;
    }
}