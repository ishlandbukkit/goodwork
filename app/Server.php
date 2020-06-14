<?php

namespace App;

use App\Model\Question;
use DebugBar\DebugBar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Server extends Model
{
    public static $PLAYER=1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'tittle', 'author','version','tags','cover','describe','markdown','md5'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];
    public function iname(){
        return $this->category_id;
    }
    public function author(){
        return User::findOrFail($this->author);
    }
    public function storage($file){
        switch ($file) {
            case 'client_file':
                return '/' . $this->md5;
                break;
            case 'cover_file':
                return '/' . $this->cover;
                break;
            default:
                return '/' . $file;
                break;
        }
    }
    public function set_player(User $user){
        Player::where('user_id','=',$user->id)
            ->where('server_id','=',$this->id)->delete();
        $player=new Player();
        $player->user_id=$user->id;
        $player->server_id=$this->id;
        $player->permission=Server::$PLAYER;
        $player->save();
    }

    /**
     * @param User $user
     * @return Player|null
     */
    public function get_player(User $user){
        return $user
            ? Player::where('user_id','=',$user->id)
            ->where('server_id','=',$this->id)->first()
            : null;
    }
    public function questions(){
        $questions=[];
        foreach (json_decode($this->questions) as $question){
            $questions[$question->name]=new Question($question);
        }
        return $questions;
    }
}
