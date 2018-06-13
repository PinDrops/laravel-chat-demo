<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
use App\Http\Controllers\Controller;

class OrderController extends Controller {

    /**
     * Ship the given order.
     *
     * @param  int  $orderId
     * @return Response
     */
    public function ship( $orderId = 1 ) {

        event( new \App\Events\Event() );

        event( new \App\Events\EventName() );

        event( new OrderShipped( 1 ) );

        $chatroomId = 1;

        $data = [
            'event' => $chatroomId,
            'data' => [
                'power'     => 1,
                'message'   => date('r'),
            ]
        ];

        $ev = \Redis::publish( 'chatroom', json_encode( $data ) );

        $data[ 'event' ] = 'nothing';

        $ev = \Redis::publish( 'dead-channel', json_encode( $data ) );

        return "event fired";

    }

    public function saveMessage() {

        $chatroomId = 1;

        $data = [
            'event' => $chatroomId,
            'data' => [
                'power'     => 1,
                'message'   => date('r'),
            ]
        ];

        $ev = \Redis::publish( 'chatroom', json_encode( $data ) );

        return "good";

    }

}