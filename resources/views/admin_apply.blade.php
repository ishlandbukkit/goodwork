@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-dark container">
            <div class="card-header">Home</div>
            <div class="card-body container">
                <h1>aaa</h1>
                <div class="row">
                    @foreach($applys as $apply)
                        <form class="col-lg-4" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $apply->user()->id }}">
                            <div class="card border-primary mb-3">
                                <h3 class="card-header">{{ $apply->user()->name }}</h3>
                                <?php debugbar()->info(json_encode($server->questions())); ?>
                                @foreach($apply->answers() as $key=>$value)
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $server->questions()[$key]->tittle }}</h5>
                                        <h6 class="card-subtitle text-muted">{{ $value }}</h6>
                                    </div>
                                @endforeach
                                <div class="card-body">
                                    <button name="action" value="pass" type="submit" class="btn btn-primary btn-lg btn-block">通过</button>
                                    <button name="action" value="deny" type="submit" class="btn btn-primary btn-lg btn-block">拒绝</button>
                                </div>
                                <div class="card-footer text-muted">
                                    {{ $apply->created_at }}
                                </div>
                            </div>
                        </form>
                    @endforeach
                    <div class="text-center">{{ $applys->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
