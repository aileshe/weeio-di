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