@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card border-dark container">
                <div class="card-header">编辑服务器</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card border-primary mb-3">
                                    <div class="card-header">基本</div>
                                    <div class="card-body">
                                        <div class="bs-component">
                                            <fieldset>
                                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label for="name">内部名称</label>
                                                    <input type="text"
                                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                           id="name" name="name" value="{{ old('name') ? old('name') : $map->name }}"
                                                           required autofocus>
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                                    <label for="title">标题</label>
                                                    <input type="text"
                                                           class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                                           id="title" name="title" value="{{ old('title') ? old('title') : $map->title }}"
                                                           required autofocus>
                                                    @if ($errors->has('title'))
                                                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('describe') ? ' has-error' : '' }}">
                                                    <label for="describe">描述</label>
                                                    <textarea   class="form-control {{ $errors->has('describe') ? ' is-invalid' : '' }}"
                                                                id="describe" name="describe" required autofocus>{{ old('describe') ? old('describe') : $map->describe }}</textarea>
                                                    @if ($errors->has('describe'))
                                                        <div class="invalid-feedback">{{ $errors->first('describe') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}">
                                                    <label for="website">官网</label>
                                                    <input type="text"
                                                           class="form-control {{ $errors->has('website') ? ' is-invalid' : '' }}"
                                                           id="website"
                                                           name="website"
                                                           value="{{ old('website') ? old('website') : $map->website }}"
                                                           required autofocus>
                                                    @if ($errors->has('website'))
                                                        <div class="invalid-feedback">{{ $errors->first('website') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('ip') ? ' has-error' : '' }}">
                                                    <label for="ip">地址</label>
                                                    <input type="text"
                                                           class="form-control {{ $errors->has('ip') ? ' is-invalid' : '' }}"
                                                           id="ip"
                                                           name="ip"
                                                           value="{{ old('ip') ? old('ip') : $map->ip }}"
                                                           required autofocus>
                                                    @if ($errors->has('ip'))
                                                        <div class="invalid-feedback">{{ $errors->first('ip') }}</div>
                                                    @endif
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card border-primary mb-3">
                                    <div class="card-header">上传</div>
                                    <div class="card-body">
                                        <div class="bs-component">
                                            <fieldset>
                                                <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
                                                    <label for="file">客户端</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input {{ $errors->has('file') ? ' is-invalid' : '' }}" id="file" name="file">
                                                        <label class="custom-file-label" for="file">选择客户端</label>
                                                        @if ($errors->has('file'))
                                                            <div class="invalid-feedback">{{ $errors->first('file') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group {{ $errors->has('cover') ? ' has-error' : '' }}">
                                                    <label for="cover">封面</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input {{ $errors->has('cover') ? ' is-invalid' : '' }}" id="cover" name="cover">
                                                        <label class="custom-file-label" for="cover">选择封面</label>
                                                        @if ($errors->has('cover'))
                                                            <div class="invalid-feedback">{{ $errors->first('cover') }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card border-primary mb-3">
                                    <div class="card-header">保存</div>
                                    <div class="card-body">
                                        <div class="bs-component">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block">保存</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border-primary mb-3">
                                    <div class="card-header">权限组</div>
                                    <div class="card-body">
                                        <div class="bs-component">
                                            <fieldset>
                                                <div class="form-group {{ $errors->has('guest_permission') ? ' has-error' : '' }}">
                                                    <label for="guest_permission">游客权限描述</label>
                                                    <input type="text"
                                                           class="form-control {{ $errors->has('guest_permission') ? ' is-invalid' : '' }}"
                                                           id="guest_permission" name="guest_permission" value="{{ old('guest_permission') ? old('guest_permission') : $map->guest_permission }}"
                                                           required autofocus>
                                                    @if ($errors->has('guest_permission'))
                                                        <div class="invalid-feedback">{{ $errors->first('guest_permission') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('player_permission') ? ' has-error' : '' }}">
                                                    <label for="player_permission">玩家权限描述</label>
                                                    <input type="text"
                                                           class="form-control {{ $errors->has('player_permission') ? ' is-invalid' : '' }}"
                                                           id="player_permission" name="player_permission" value="{{ old('player_permission') ? old('player_permission') : $map->player_permission }}"
                                                           required autofocus>
                                                    @if ($errors->has('player_permission'))
                                                        <div class="invalid-feedback">{{ $errors->first('player_permission') }}</div>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('admin_permission') ? ' has-error' : '' }}">
                                                    <label for="admin_permission">管理员权限描述</label>
                                                    <input type="text"
                                                           class="form-control {{ $errors->has('admin_permission') ? ' is-invalid' : '' }}"
                                                           id="admin_permission" name="admin_permission" value="{{ old('admin_permission') ? old('admin_permission') : $map->admin_permission }}"
                                                           required autofocus>
                                                    @if ($errors->has('admin_permission'))
                                                        <div class="invalid-feedback">{{ $errors->first('admin_permission') }}</div>
                                                    @endif
                                                </div>
                                            </fieldset>
                                        </div>
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
                                    <div class="form-group {{ $errors->has('markdown') ? ' has-error' : '' }}">
                                        <textarea class="form-control {{ $errors->has('markdown') ? ' is-invalid' : '' }}"
                                                  id="markdown" rows="16" name="markdown"
                                                  style="margin-top: 0px; margin-bottom: 0px;"
                                                  required autofocus>{{ old('markdown') ? old('markdown') : $map->markdown }}</textarea>
                                        @if ($errors->has('markdown'))
                                            <div class="invalid-feedback">{{ $errors->first('markdown') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="page-header">
                                    <h1 id="containers">apply.md</h1>
                                </div>
                                <div class="bs-component">
                                    <div class="form-group {{ $errors->has('apply') ? ' has-error' : '' }}">
                                        <textarea class="form-control {{ $errors->has('apply') ? ' is-invalid' : '' }}"
                                                  id="apply" rows="16" name="apply"
                                                  style="margin-top: 0px; margin-bottom: 0px;"
                                                  required autofocus>{{ old('apply') ? old('apply') : $map->apply }}</textarea>
                                        @if ($errors->has('apply'))
                                            <div class="invalid-feedback">{{ $errors->first('apply') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="page-header">
                                    <h1 id="containers">questions.json</h1>
                                </div>
                                <div class="bs-component">
                                    <div class="form-group {{ $errors->has('questions') ? ' has-error' : '' }}">
                                        <textarea class="form-control {{ $errors->has('questions') ? ' is-invalid' : '' }}"
                                                  id="questions" rows="16" name="questions"
                                                  style="margin-top: 0px; margin-bottom: 0px;"
                                                  required autofocus>{{ old('questions') ? old('questions') : $map->questions }}</textarea>
                                        @if ($errors->has('questions'))
                                            <div class="invalid-feedback">{{ $errors->first('questions') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </form>
    </div>
@endsection
