<?php
/**
 * Weeio - 简单、高效的PHP微框架 | 轻量级IOC (DI-依赖注入)   http://github.com/aileshe/weeio-di
 * Copyright (c) 2018 Dejan.He All rights reserved.
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * Author: Dejan.He <673008865@qq.com>
 */

 
# Di依赖注入标准接口
interface DiAwareInterface
{
    public function setDI($di);
    public function getDI();
}

# 应用层接口
interface BackendInterface {
    public function find($key, $lifetime);
    public function save($key, $value, $lifetime);
    public function delete($key);
}

class redisDB implements BackendInterface, DiAwareInterface
{
    public $_DI;

    public function setDI($di){
        $this->_DI = $di;
    }
    public function getDI(){
        return $this->_DI;
    }
    public function find($key, $lifetime) 
    {
        echo 'find($key, $lifetime)'.PHP_EOL;
    }
    public function save($key, $value, $lifetime)
    { 
        echo 'save($key, $value, $lifetime)'.PHP_EOL;
    }
    public function delete($key)
    {
        echo 'delete($key)'.PHP_EOL;
    }
}
 
class mongoDB implements BackendInterface, DiAwareInterface
{
    public $_DI;

    public function setDI($di){
        $this->_DI = $di;
    }
    public function getDI(){
        return $this->_DI;
    }
    public function find($key, $lifetime) 
    {
        echo 'find($key, $lifetime)'.PHP_EOL;
    }
    public function save($key, $value, $lifetime)
    { 
        echo 'save($key, $value, $lifetime)'.PHP_EOL;
    }
    public function delete($key)
    {
        echo 'delete($key)'.PHP_EOL;
    }
}
 
class mysql implements BackendInterface, DiAwareInterface
{
    public $_DI;

    public function setDI($di){
        $this->_DI = $di;
    }
    public function getDI(){
        return $this->_DI;
    }
    public function find($key, $lifetime) 
    {
        echo 'find($key, $lifetime)'.PHP_EOL;
    }
    public function save($key, $value, $lifetime)
    { 
        echo 'save($key, $value, $lifetime)'.PHP_EOL;
    }
    public function delete($key)
    {
        echo 'delete($key)'.PHP_EOL;
    }
}
