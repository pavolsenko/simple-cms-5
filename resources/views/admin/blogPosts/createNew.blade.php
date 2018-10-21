@extends('layouts/admin')

@section('content')

    <div class="col-sm-10 col-sm-offset-1">
        <h1>
            @lang('blogPost.create_new_blog_post_heading')
        </h1>

        {!! Form::open(['route' => 'postsCreateNewSave', 'method' => 'post', 'class' => 'form']) !!}

        @if($errors->any())
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
        @endif

        <div>
            {!! Form::label('title', trans('blogPost.title')) !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div>
            {!! Form::label('intro_text', trans('blogPost.intro_text')) !!}
            {!! Form::textarea('intro_text', null, ['class' => 'form-control']) !!}
        </div>

        <div>
            {!! Form::label('body_text', trans('blogPost.body_text')) !!}
            {!! Form::textarea('body_text', null, ['class' => 'form-control']) !!}
        </div>

        <div>
            {!! Form::submit(trans('blogPost.save'), ['class' => 'btn btn-primary']) !!}
            <a href="#" class="btn btn-default">
                @lang('blogPost.save_and_close')
            </a>
            &nbsp;
            <a href="{{ URL::previous() }}" class="btn btn-default">
                @lang('blogPost.cancel')
            </a>
        </div>

        {!! Form::close() !!}

    </div>

@stop