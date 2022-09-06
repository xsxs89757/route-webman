<?php

namespace Qifen\Route;

use Webman\Route as WebmanRoute;

class Route extends WebmanRoute {
    /**
     * @var array 权限列表
     */
    protected static $_rules = [];

    protected static $_hasRoute;

    /**
     * @param $methods
     * @param $path
     * @param $callback
     * @return Router
     */
    protected static function addRoute($methods, $path, $callback) {
        static::$_hasRoute = true;

        $route = new Router($methods, static::$_groupPrefix . $path, $callback);

        static::$_allRoutes[] = $route;

        if ($callback = static::convertToCallable($path, $callback)) {
            static::$_collector->addRoute($methods, $path, ['callback' => $callback, 'route' => $route]);
        }

        if (static::$_instance) {
            static::$_instance->collect($route);
        }

        return $route;
    }

    /**
     * 添加权限
     *
     * @param $callBack
     * @param $name
     * @return void
     */
    public static function addRule($callBack, $name) {
        self::$_rules[$callBack] = $name;
    }

    /**
     * 获取权限
     *
     * @param $callBack
     * @return mixed|string
     */
    public static function getRule($callBack) {
        return self::$_rules[$callBack] ?? '';
    }
}