@extends('layouts/default')

@section('content')

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <br><br><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('auth.login_heading')
                </div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'postLogin', 'method' => 'post', 'class' => 'form']) !!}

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{$errors->first()}}
                        </div>
                    @endif

                    <div>
                        {!! Form::label('email', trans('auth.email')) !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>

                    <div>
                        {!! Form::label('password', trans('auth.password')) !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>

                    <div>
                        {!! Form::checkbox('remember', 'remember', 'remember') !!}
                        {!! Form::label('remember', trans('auth.remember'), ['for' => 'remember']) !!}
                    </div>

                    <div class="text-center">
                        {!! Form::submit(trans('auth.login_button'), ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
@stop