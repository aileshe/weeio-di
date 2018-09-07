<?php
/**
 * Weeio - 简单、高效的PHP微框架 | 轻量级IOC (DI-依赖注入)   http://github.com/aileshe/weeio-di
 * Copyright (c) 2018 Dejan.He All rights reserved.
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * Author: Dejan.He <673008865@qq.com>
 */

namespace weeio\DI;

# Di依赖注入标准接口
interface DiAwareInterface
{
    public function setDI(DI $di);
    public function getDI();
}

class DI
{
    private static $_container = []; # 非共享实例对象, 每次调用重新构建
    private static $_sharedContainer = []; # 共享实例
    private static $_Di = NULL; # $this
    
    private function __construct(){} # 防止类构造函数初始化
    private function __clone(){}     # 防止克隆函数调用
    
    /**
     * DI容器初始化函数
     * @return $this
     */
    public static function Di()
    {
        if(self::$_Di === NULL){
            self::$_Di = new DI();
        }
        return self::$_Di;
    }
 
    /**
     * 添加一个实例对象到容器 - 已存在实例不进行构建
     * @param  $name        键名(对象名)
     * @param  $definition  实例对象(classObject)
     * @param  void
     */
    public static function set($name, $definition)
    {
        # 已存在实例不进行构建
        if(!isset(self::$_sharedContainer[$name])){
            self::$_sharedContainer[$name] = $definition;
        }
    }

    /**
     * 添加一个实例对象到容器 - 非共享实例, 每次调用重新构建
     * @param  $name        键名(对象名)
     * @param  $definition  实例对象(classObject)
     * @param  void
     */
    public static function _set($name, $definition)
    {
        # 非共享实例, 每次调用重新构建
        self::$_container[$name] = $definition;
    }
 
    /**
     * 获取DI容器里指定的实例对象 - 共享实例容器
     * @param  $name  键名(对象名)
     * @return InstanceObject
     */
    public static function get($name)
    {
        if(isset(self::$_sharedContainer[$name])){
            $instance = self::$_sharedContainer[$name];
        }else{
            throw new Exception("Instance '{$name}' wasn't found in the dependency injection container");
        }
        # 定义 DiAwareInterface 接口，自动注入 Di
        if (is_object(($instance = call_user_func($instance))) && ($instance instanceof \DiAwareInterface)){
            $instance->setDI(self::$_Di);
        }
        return $instance;
    }

    /**
     * 获取DI容器里指定的实例对象 - 非共享实例容器
     * @param  $name  键名(对象名)
     * @return InstanceObject
     */
    public static function _get($name)
    {
        if(isset(self::$_container[$name])){
            $instance = self::$_container[$name];
        }else{
            throw new Exception("Instance '{$name}' wasn't found in the dependency injection container");
        }
        # 定义 DiAwareInterface 接口，自动注入 Di
        if (is_object(($instance = call_user_func($instance))) && ($instance instanceof \DiAwareInterface)){
            $instance->setDI(self::$_Di);
        }
        return $instance;
    }

    /**
     * 判断实例对象是否在Di容器里 - 共享实例容器
     * @param  $name  键名(对象名)
     * @return Bool
     */
    public static function has($name)
    {
        return isset(self::$_sharedContainer[$name]);
    }

    /**
     * 判断实例对象是否在Di容器里 - 非共享实例容器
     * @param  $name  键名(对象名)
     * @return Bool
     */
    public static function _has($name)
    {
        return isset(self::$_container[$name]);
    }

    /**
     * 从Di容器中删除指定实例 - 共享实例容器
     * @param  $name  键名(对象名)
     * @param  void
     */
    public static function del($name)
    {
        unset(self::$_sharedContainer[$name]);
    }

    /**
     * 从Di容器中删除指定实例 - 非共享实例容器
     * @param  $name  键名(对象名)
     * @param  void
     */
    public static function _del($name)
    {
        unset(self::$_container[$name]);
    }
}