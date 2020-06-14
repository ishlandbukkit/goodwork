<?php

namespace App\Http\Controllers;

use App\Apply;
use App\Model\Question;
use App\Order;
use App\Player;
use App\Server;
use App\Untils\CodePayUntil;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class ServerController extends Controller{
    public function index($id){
        /** @var User $user */
        $user=Auth::user();
        /** @var Server $server */
        $server=Server::findOrFail($id);
        /** @var Player $player */
        $player=$server->get_player($user);
        if($player && $player->permission!=0){
            abort(400,'只有游客才可以申请');
        }
        return view('apply')
            ->with('server',$server);
    }
    public function apply($id,Request $request){
        /** @var User $user */
        $user=Auth::user();
        /** @var Server $server */
        $server=Server::findOrFail($id);
        /** @var Question[] $questions */
        $questions=$server->questions();
        $answer=[];
        foreach ($questions as $question){
            $question->validate($request->all());
            $answer[$question->name]=$request->input('question_'.$question->name);
        }
        Apply::where('user_id','=',$user->id)
            ->where('server_id','=',$server->id)->delete();
        $apply=new Apply();
        $apply->user_id=$user->id;
        $apply->server_id=$server->id;
        $apply->data=json_encode($answer);
        $apply->save();
        return redirect(route('detail',['id'=>$id]));
    }
    public function admin_apply($id){
        /** @var User $admin */
        $admin=Auth::user();
        /** @var Server $server */
        $server=Server::findOrFail($id);
        /** @var Player $player */
        $player=$server->get_player($admin);
        if($server->author != $admin->id){
            abort(400);
        }
        $applys=Apply::where('server_id','=',$id)->paginate(15);
        return view('admin_apply')
            ->with('server',$server)
            ->with('applys',$applys);
    }
    public function admin_apply_save($id,Request $request){
        /** @var User $admin */
        $admin=Auth::user();
        /** @var Server $server */
        $server=Server::findOrFail($id);
        if($server->author != $admin->id){
            abort(400);
        }
        /** @var User $user */
        $user=User::findOrFail($request->input('user_id'));
        /** @var Apply $apply */
        $apply=Apply::where('user_id','=',$user->id)
            ->where('server_id','=',$server->id)->first();
        if($request->input('action')=='deny'){
            $apply->delete();
            return redirect(route('admin_apply',['id'=>$id]));
        }
        /** @var Player $player */
        $player=new Player();
        $player->server_id=$server->id;
        $player->user_id=$user->id;
        $player->permission=1;
        $player->saveOrFail();
        $apply->delete();
        return redirect(route('admin_apply',['id'=>$id]));
    }
    public function donate($id){
        /** @var User $user */
        $user=Auth::user();
        /** @var Server $server */
        $server=Server::findOrFail($id);
        /** @var Player $player */
        $player=$server->get_player($user);
        if(!$player){
            $player=new Player();
            $player->server_id=$server->id;
            $player->user_id=$user->id;
            $player->permission=0;
            $player->saveOrFail();
        }
        return view('donate')
            ->with('server',$server)
            ->with('player',$player);
    }
    public function donate_save($id,Request $request){
        /** @var User $user */
        $user=Auth::user();
        /** @var Server $server */
        $server=Server::findOrFail($id);
        /** @var Player $player */
        $player=$server->get_player($user);
        if(!$player){
            $player=new Player();
            $player->server_id=$server->id;
            $player->user_id=$user->id;
            $player->permission=0;
            $player->saveOrFail();
        }
        /** @var Order $order */
        $order=new Order();
        $order->server_id=$server->id;
        $order->user_id=$user->id;
        $order->count=$request->input('value');
        $order->describe='测试订单@@@';
        $order->payment=$request->input('type');
        $order->status=Order::Wait_Pay;
        $order->saveOrFail();
        return (new CodePayUntil())->pay(
            $order->id,
            $request->input('type'),
            $request->input('value'),
            route('codepay_notify',['id'=>$order->id]),
            route('codepay_return',['id'=>$order->id]));
    }

    public function donate_success($id,Request $request){
        return view('donate_success');
    }

    public function donate_success_save($id,Request $request){
        $pay=(new CodePayUntil())->handle($request->all());
        if(!$pay){
            return 'fail';
        }else{
            /** @var Order $order */
            $order=Order::findOrFail($pay['pay_id']);
            $order->paid();
            return 'success';
        }
    }
}
