<?php

namespace SimonMarcelLinden\LaravelMetaTags;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MetaTag {

    /**
     * @var array
     */
    private $config = [];

    /**
     * @var array
     */
    private $metas = [];

    /**
     * @param Request $request
     * @param array $config
     * @param string $defaultLocale
     */
    public function __construct(Request $request, array $config, string $defaultLocale) {
        $this->config   = $config ? $config : [];

        $this->set('title', $this->config['title']);
    }

    /**
     * @param  string $key
     * @param  string $value
     *
     * @return string
     */
    public function set($key, $value = null) {
        $method = 'set'.ucfirst($key);

        if (method_exists($this, $method)) {
            return $this->$method($value);
        }

        return $value;
    }

    /**
     * @param string $key
     * @param null $default
     *
     * @return string
     */
    public function get(string $key, $default = null) {
        return Arr::get($this->metas, $key, $default);
    }

    /**
     * @param  string $value
     *
     * @return string
     */
    private function setTitle( $title ) {
        $baseTitle = $this->config['title'];

        $title = $baseTitle.' '.$this->config['title_tab'].' '.$title;
        $title = substr($title, 0, ($this->config['title_limit']));

        return $this->metas['title'] = $title;
    }

}
