@extends('layouts/admin')

@section('content')

    <div class="col-md-10 col-md-offset-1">
        <h1>
            @lang('page.pages_editor')
        </h1>
    </div>

    <div class="col-md-7 col-md-offset-1">
        @if(isset($page))
            {!! Form::model($page, ['route' => ['postUpdatePage', $page['id']]]) !!}
            {!! Form::hidden('id', $page['id']) !!}
        @else
            {!! Form::open(['route' => 'postCreatePage']) !!}
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
                            @if(isset($page))
                                @lang('page.id'): {{ $page['id'] }} |
                                @lang('page.created_at'): {{ $page['created_at'] }} |
                                @lang('page.last_updated_at'): {{ $page['updated_at'] }}
                            @endif
                        </div>
                        @include('admin/pages/toolbarPageEditor')
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            {!! Form::label('title', trans('page.title')) !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('body_text', trans('page.body_text')) !!}
                            {!! Form::textarea('body_text', null, ['class' => 'form-control editable']) !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('page.settings')</b>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('status', trans('page.status')) !!}<br>
                    <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-default">@lang('page.published')</a>
                        <a href="#" class="btn btn-default">@lang('page.draft')</a>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('published_from_to', trans('page.published_from_to')) !!}
                    <div class="row">
                        <div class="col-xs-6">
                            {!! Form::text('published_from', null, ['class' => 'form-control datepicker']) !!}
                        </div>
                        <div class="col-xs-6">
                            {!! Form::text('published_to', null, ['class' => 'form-control datepicker']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('page.images')</b>
            </div>
            <div class="panel-body">
                @lang('page.featured_image')
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('page.seo_settings')</b>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('url', trans('page.url')) !!}
                    {!! Form::text('url', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_title', trans('page.meta_title')) !!}
                    {!! Form::text('meta_title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_description', trans('page.meta_description')) !!}
                    {!! Form::textarea('meta_description', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_keywords', trans('page.meta_keywords')) !!}
                    {!! Form::textarea('meta_keywords', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

@stop