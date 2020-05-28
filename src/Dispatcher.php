<?php

namespace Voilaf\MessageSystem;

use Voilaf\MessageSystem\Contracts\Subscribe;

class Dispatcher
{
    // 订阅回调类实例
    private $proxyHandler = [];

    /**
     * 订阅消息转发到实际业务处理回调类
     * @param string $subject 主题
     * @param string $data 报文
     * @param string $desc 描述
     */
    public function proxyPass(string $subject, string $data, string $desc)
    {
        // 检查订阅的subject是否可用，并获取对应的订阅回调类
        $list = app('config')->get('message.sub_subjects');
        if (!isset($list[$subject])) {
            // 未订阅
            \Log::debug($subject.":未订阅主题");
            return false;
        }

        $subHandle = $list[$subject];
        if (empty($subHandle)) {
            \Log::debug($subject.":未定义回调类");
            return false;
        }

        // 判断执行类是否已存在
        if (!in_array($subHandle, $this->proxyHandler)) {
            if (!class_exists($subHandle)) {
                \Log::debug($subject.":消息回调类不存在:".$subHandle);
                return false;
            }
            $handler = new $subHandle();
            if (!$handler instanceof Subscribe) {
                \Log::debug($subject.":未实现订阅接口:".$subHandle);
                return false;
            }
            $this->proxyHandler[$subHandle] = $handler;
        }

        return $this->proxyHandler[$subHandle]->callback($subject, $data, $desc);
    }
}
