<?php

namespace Qifen\Route;

use Webman\Route\Route as WebmanRoute;

class Router extends WebmanRoute {
    /**
     * @var null 规则名称
     */
    protected $_rule = null;

    /**
     * 设置规则
     * @param string $name
     * @return $this
     */
    public function rule(string $name) {
        $this->_rule = $name;

        Route::addRule($this->_callback, $name);

        return $this;
    }
}