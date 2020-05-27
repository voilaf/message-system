<?php

namespace Voilaf\MessageSystem\Support;

class RrRpc
{
    /**
     * PHP主动通信RR RPC-Conn
     */
    private static $rpc = null;

    /**
     * 建立与Roadrunner的rpc通道
     */
    public static function getConn()
    {
        if (is_null(self::$rpc)) {
            $address = env('ROADRUNNER_RPC_ADDRESS', '127.0.0.1');
            $port = env('ROADRUNNER_RPC_PORT', 6001);
            $relay = new \Spiral\Goridge\SocketRelay($address, $port);
            self::$rpc = new \Spiral\Goridge\RPC($relay);
        }
        return self::$rpc;
    }
}
