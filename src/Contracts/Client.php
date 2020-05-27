<?php

namespace Voilaf\MessageSystem\Contracts;

/**
 * interface for message-system client
 */
interface Client
{
    /**
     * 事件发布
     * @param string $subject 订阅事件名
     * @param string $data 发布信息
     * @param string $desc 事件描述
     */
    public function pub(string $subject, string $data, string $desc);

    /**
     * 事件订阅
     */
    public function sub();
}
