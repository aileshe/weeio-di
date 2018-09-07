<?php
/**
 * Weeio - 简单、高效的PHP微框架 | 轻量级IOC (DI-依赖注入)   http://github.com/aileshe/weeio-di
 * Copyright (c) 2018 Dejan.He All rights reserved.
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * Author: Dejan.He <673008865@qq.com>
 */

include '../vendor/autoload.php';
include './instance.php';


$di = \weeio\DI\DI::di(); # 获得di实例对象

# 添加 redis 实例到 共享DI容器中, 如果 redis实例已存在不重新构建返回找到的实例
$di::set('redis', function(){
    return new redisDB([
        'host' => '127.0.0.1',
        'port' => 6379
    ]);
});

# 添加 redis 实例到 非共享DI容器中, 如果 redis实例已存在会重新构建
$di::_set('redis', function(){
    return new redisDB([
        'host' => '127.0.0.1',
        'port' => 6388
    ]);
});

var_dump($di::get('redis'));
var_dump($di::_get('redis'));

$di::get('redis')->find('123',123);
$di::_get('redis')->find('123',123);