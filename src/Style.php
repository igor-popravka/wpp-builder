<?php
namespace WDIP\WPPBuilder;

use WDIP\WPPBuilder\Interfaces\ActionInterface;
use WDIP\WPPBuilder\Interfaces\ScriptInterface;

/**
 * @author: igor.popravka
 * Date: 07.11.2017
 * Time: 12:31
 */
class Style implements ScriptInterface, ActionInterface {
    private $handle;
    private $src = '';
    private $deps = array();
    private $ver = false;
    private $media = 'all';
    private $page;

    public function __construct($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {
        $this->handle = $handle;
        $this->src = $src;
        $this->deps = $deps;
        $this->ver = $ver;
        $this->media = $media;
    }

    public function setPage($page) {
        $this->page = $page;
        return $this;
    }

    public function save() {
        wp_enqueue_style(
            $this->handle,
            plugins_url($this->src, $this->page),
            $this->deps,
            $this->ver,
            $this->media
        );
        return $this;
    }

    public function create() {
        return $this;
    }
}