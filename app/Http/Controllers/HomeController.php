<?php


namespace App\Http\Controllers;


use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){
        return view('welcome')
            ->with('maps',Server::paginate(15));
    }
    public function home(){
        return view('home')
            ->with('maps',Server::where('author','=',Auth::id())->paginate(15));
    }
    public function detail($id){
        $server=Server::findOrFail($id);
        return view('detail')
            ->with('map',$server)
            ->with('player',$server->get_player(Auth::user()));
    }
    public function edit($id){
        $map=Server::find($id);
        if(!$map){
            $map=new Server;
        }elseif($map->author!=Auth::id()){
            abort(400);
        }
        return view('edit')
            ->with('map',$map);
    }
    public function edit_save($id,Request $request){
        $map=Server::find($id);
        if(!$map){
            $map=new Server;
            $map->category_id=0;
            $map->tags='[]';
        }elseif($map->author!=Auth::id()){
            abort(400);
        }
        $request->validate([
            'name' => 'required|max:255',
            'website' => 'required|max:255',
            'ip' => 'required|max:255',
            'markdown' => 'required',
            'apply' => 'required',
            'questions' => 'required',
            'title' => 'required',
            'describe' => 'required',
            'cover'=>'nullable|file|dimensions:min_width=100,min_height=200',
            'guest_permission' => 'required|max:255',
            'player_permission' => 'required|max:255',
            'admin_permission' => 'required|max:255',
            'file'=>'nullable|file'
        ]);
        $map->name=$request->input('name');
        $map->author=Auth::id();
        $map->website=$request->input('website');
        $map->ip=$request->input('ip');
        $map->markdown=$request->input('markdown');
        $map->apply=$request->input('apply');
        $map->questions=$request->input('questions');
        $map->title=$request->input('title');
        $map->describe=$request->input('describe');
        $map->guest_permission=$request->input('guest_permission');
        $map->player_permission=$request->input('player_permission');
        $map->admin_permission=$request->input('admin_permission');
        if($request->file('file')){
            $md5=md5($request->file('file'));
            Storage::disk('local')->putFileAs('/', $request->file('file'),$md5);
            $map->md5=$md5;
        }
        if($request->file('cover')){
            $md5=md5($request->file('cover'));
            Storage::putFileAs('/', $request->file('cover'),$md5);
            $map->cover=$md5;
        }
        $map->save();
        return redirect(route('detail',['id'=>$map->id]));
    }
    public function download($id){
        $map=Server::findOrFail($id);
        return Storage::disk('local')->download($map->storage('client_file'),$map->iname().'.zip');
    }
}
