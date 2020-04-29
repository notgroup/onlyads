<?php



namespace App\Events;



use Illuminate\Broadcasting\Channel;

use Illuminate\Queue\SerializesModels;

use Illuminate\Broadcasting\PrivateChannel;

use Illuminate\Broadcasting\PresenceChannel;

use Illuminate\Foundation\Events\Dispatchable;

use Illuminate\Broadcasting\InteractsWithSockets;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\User;

use Log;



class ItemEvent

{

    use Dispatchable, InteractsWithSockets, SerializesModels;



    /**

     * Create a new event instance.

     *

     * @return void

     */

    public function __construct()

    {

    }



    /**

     * Get the channels the event should broadcast on.

     *

     * @return \Illuminate\Broadcasting\Channel|array

     */

    public function itemCreated(User $item)

    {

        Log::info("Item Created Event Fire: ".$item);

    }



    /**

     * Get the channels the event should broadcast on.

     *

     * @return \Illuminate\Broadcasting\Channel|array

     */

    public function itemUpdated(User $item)

    {

        Log::info("Item Updated Event Fire: ".$item);

    }



    /**

     * Get the channels the event should broadcast on.

     *

     * @return \Illuminate\Broadcasting\Channel|array

     */

    public function itemDeleted(Item $item)

    {

        Log::info("Item Deleted Event Fire: ".$item);

    }

}
