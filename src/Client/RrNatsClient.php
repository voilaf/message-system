<?php

namespace Voilaf\MessageSystem\Client;

use Voilaf\MessageSystem\Contracts\Client as ClientInterface;
use Voilaf\MessageSystem\Support\RrRpc;

/**
 * Roadrunner nats-client
 */
class RrNatsClient extends AbstractClient implements ClientInterface
{
    /**
     * 发布
     */
    public function pub(string $subject, string $data, string $desc = 'No subject desc')
    {
        // check subject
        if (!$this->checkIfPubSubjectValid($subject)) {
            return ['code' => 422, 'message' => 'subject错误，请查看是否已配置'];
        }

        $rpc = RrRpc::getConn();
        $body = compact('subject', 'desc', 'data');
        // 规范rr返回报文
        $response = $rpc->call('natsgo.Pub', json_encode($body));
        if (empty($response)) {
            return ['code'=>500, 'message'=>'无响应报文'];
        }
        return json_decode($response, true);
    }

    public function sub() { }
}
