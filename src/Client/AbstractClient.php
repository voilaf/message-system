<?php

namespace Voilaf\MessageSystem\Client;

abstract class AbstractClient
{
    /**
     * 检查发布的subject是否可用
     */
    protected function checkIfPubSubjectValid(string $subject) : bool
    {
        $list = app('config')->get('message.pub_subjects');
        return in_array($subject, $list) ? true : false;
    }
}
