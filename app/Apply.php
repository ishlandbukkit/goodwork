<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    public function user(){
        return User::findOrFail($this->user_id);
    }
    public function server(){
        return Server::findOrFail($this->server_id);
    }
    public function answers(){
        return json_decode($this->data);
    }
}
