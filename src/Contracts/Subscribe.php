<?php

namespace Voilaf\MessageSystem\Contracts;

/**
 * interface for Subscription callback handler
 */
interface Subscribe
{
    /**
     * 事件订阅回调方法
     * @param string $subject 订阅事件名
     * @param string $data 发布信息
     * @param string $desc 事件描述
     * @return bool
     * */
    public function callback(string $subject, string $data, string $desc) : bool;
}
