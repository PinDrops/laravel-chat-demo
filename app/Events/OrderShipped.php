<?php

namespace App\Events;

use App\Order;
use Illuminate\Queue\SerializesModels;

class OrderShipped
{
    use SerializesModels;

    public $order;

    /**
     * Create a new event instance.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function __construct( $power )
    {
        $this->power = $power;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('test-channel');
    }

}