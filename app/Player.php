<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function user(){
        return User::findOrFail($this->user_id);
    }
    public function server(){
        return Server::findOrFail($this->server_id);
    }
    public function get_permission_describle(){
        switch ($this->permission){
            case 0:
                return Server::findOrFail($this->server_id)->guest_permission;
            case 1:
                return Server::findOrFail($this->server_id)->player_permission;
            case 2:
                return Server::findOrFail($this->server_id)->admin_permission;
            default:
                return 'unknown';
        }
    }
}
