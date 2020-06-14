@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-dark container">
            <div class="card-header">Welcome</div>
            <div class="card-body container">
                <h1>{{ $map->title }}</h1>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border-primary mb-3">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        作者
                                        <span class="badge badge-primary badge-pill">{{ $map->author()->name }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        网站
                                        <a href="{{ $map->website }}"><span class="badge badge-primary badge-pill">website</span></a>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        加入权限
                                        @if(!$player || $player->permission==0)
                                            <a href="{{ route('apply',['id'=>$map->id]) }}"><span class="badge badge-primary badge-pill">{{ $map->guest_permission }}</span></a>
                                        @else
                                            <span class="badge badge-primary badge-pill">{{ $player->get_permission_describle() }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-primary mb-3">
                            <div class="card-body">
                                <img style="max-height: 200px; width: 100%; display: block;" src="{{ Storage::url($map->storage('cover_file')) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-primary mb-3">
                            <h3 class="card-header">操作</h3>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{ route('download',['id'=>$map->id]) }}'">下载</button>
                                <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{ route('donate',['id'=>$map->id]) }}'">捐助</button>
                                @if($map->author==Auth::id())
                                    <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{ route('edit',['id'=>$map->id]) }}'">编辑</button>
                                    <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{ route('admin_apply',['id'=>$map->id]) }}'">审核</button>
                                @endif
                            </div>
                            <div class="card-footer text-muted">
                                Size: {{ Storage::disk('local')->size($map->storage('client_file'))/1024/1024 }} MB
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-header">
                            <h1 id="containers">README.md</h1>
                        </div>
                        <div class="bs-component">
                            <div class="jumbotron">
                                <?php
                                    $Parsedown = new Parsedown();
                                    echo $Parsedown->setSafeMode(true)->text($map->markdown);
                                ?>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </div>
@endsection
