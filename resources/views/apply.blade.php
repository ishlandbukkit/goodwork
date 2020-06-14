@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card border-dark container">
                <div class="card-header">{{ $server->title }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="card border-primary mb-3 col-lg-12">
                            <div class="card-header">玩家权限申请表</div>
                            <div class="card-body">
                                <div class="bs-component">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="page-header">
                                                <h1 id="containers">apply.md</h1>
                                            </div>
                                            <div class="bs-component">
                                                <div class="jumbotron">
                                                    <?php
                                                        use App\Extensions\QuestionExtension;
                                                        echo (new QuestionExtension($server->questions()))->setSafeMode(true)->text($server->apply);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
