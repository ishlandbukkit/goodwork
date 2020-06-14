<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const Wait_Pay=0;
    const Finist_pay=1;
    /**
     * @return User
     */
    public function user(){
        return User::findOrFail($this->user_id);
    }

    /**
     * @return Server
     */
    public function server(){
        return Server::findOrFail($this->server_id);
    }
    public function paid(){
        $player=$this->server()->get_player($this->user());
        $player->count+=$this->count;
        $player->saveOrFail();
        $this->status=Order::Finist_pay;
        $this->saveOrFail();
    }
    //
}
