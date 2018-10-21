@extends('layouts/admin')

@section('content')

    <div class="col-md-10 col-md-offset-1">
        <h1>
            @lang('blog.blog_post_editor')
        </h1>
    </div>

    <div class="col-md-7 col-md-offset-1">
        @if(isset($blog_post))
            {!! Form::model($blog_post, ['route' => ['postUpdateBlogPost', $blog_post['id']]]) !!}
            {!! Form::hidden('id', $blog_post['id']) !!}
        @else
            {!! Form::open(['route' => 'postCreateBlogPost']) !!}
        @endif
        {!! Form::hidden('close', 0) !!}

        @if(session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" id="admin-toolbar">
                        <div class="pull-right hidden-sm hidden-xs hidden-md blog-post-info">
                            @if(isset($blog_post))
                                @lang('blog.id'): {{ $blog_post['id'] }} |
                                @lang('blog.created_at'): {{ $blog_post['created_at'] }} |
                                @lang('blog.last_updated_at'): {{ $blog_post['updated_at'] }}
                            @endif
                        </div>
                        @include('admin/blogPosts/toolbar')
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            {!! Form::label('title', trans('blog.title')) !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('intro_text', trans('blog.intro_text')) !!}
                            {!! Form::textarea('intro_text', null, ['class' => 'form-control editable', 'data-height' => '300']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('body_text', trans('blog.body_text')) !!}
                            {!! Form::textarea('body_text', null, ['class' => 'form-control editable', 'data-height' => '600']) !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>{{ count($blog_post['comments']) }} @lang('comment.comments')</b>
                    </div>

                    @if(empty($blog_post['comments']))
                    <div class="panel-body">
                        <div class="alert alert-warning">
                            @lang('comment.no_comments')
                        </div>
                    </div>
                    @else
                    <ul class="list-group">
                    @foreach($blog_post['comments'] as $comment)
                        <li class="list-group-item">
                            <b>{{ $comment['author']['name'] }}</b>
                            @lang('comment.posted_on') {{ date('j M Y H:m', strtotime($comment['created_at'])) }}
                            @lang('comment.from') {{ $comment['ip_address'] }}
                            @if($comment['status'])
                            <span class="label label-default pull-right"><i class="glyphicon glyphicon-ok"></i> @lang('comment.approved')</span>
                            @else
                            <span class="label label-default"><i class="glyphicon glyphicon-remove"></i> @lang('comment.awaiting_approval')</span>
                            @endif
                            <br>
                        @if(!empty($comment['author']['website']))
                            <a href="{{ $comment['author']['website'] }}" target="_blank">{{ $comment['author']['website'] }}</a>
                        @endif
                            <p>
                                {{ $comment['text'] }}
                            </p>
                            <div class="btn-group btn-group-xs">
                                <a href="#" class="btn btn-default btn-xs">@lang('comment.edit')</a>
                                <a href="#" class="btn btn-default btn-xs">@lang('comment.delete')</a>
                                <a href="#" class="btn btn-default btn-xs">@lang('comment.disapprove')</a>
                                <a href="#" class="btn btn-default btn-xs">@lang('comment.mark_as_spam')</a>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blog.settings')</b>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('status', trans('blog.status')) !!}<br>
                    <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-default">@lang('blog.published')</a>
                        <a href="#" class="btn btn-default">@lang('blog.draft')</a>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('published_from_to', trans('blog.published_from_to')) !!}
                    <div class="row">
                        <div class="col-xs-6">
                            {!! Form::text('published_from', null, ['class' => 'form-control datepicker']) !!}
                        </div>
                        <div class="col-xs-6">
                            {!! Form::text('published_to', null, ['class' => 'form-control datepicker']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('author', trans('blog.author')) !!}
                    {!! Form::select('author', $authors, isset($blog_post) ? $blog_post['author_id'] : null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category', trans('blog.category')) !!}
                    {!! Form::select('categories[]', $categories, $selected_categories, ['class' => 'form-control', 'multiple' => true, 'id' => 'category-multiselect']) !!}
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blog.images')</b>
            </div>
            <div class="panel-body">
                @lang('blog.featured_image')
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blog.seo_settings')</b>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('url', trans('blog.url')) !!}
                    {!! Form::text('url', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_title', trans('blog.meta_title')) !!}
                    {!! Form::text('meta_title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_description', trans('blog.meta_description')) !!}
                    {!! Form::textarea('meta_description', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_keywords', trans('blog.meta_keywords')) !!}
                    {!! Form::textarea('meta_keywords', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@stop