@extends('layouts/admin')

@section('content')
    <div class="row">

        <div class="col-xs-10 col-xs-offset-1">

        <h1>@lang('blog.blog_post_dashboard_heading')</h1>

        @if(session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <a href="{{ URL::route('getCreateBlogPost') }}" class="btn btn-primary btn-sm">@lang('blog.create_new')</a>

        @if(!empty($posts))

            <div class="pull-right">
                @include('partials.pagination')
            </div>

            <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-default">@lang('blog.all')</a>
                <a href="#" class="btn btn-default">@lang('blog.published')</a>
                <a href="#" class="btn btn-default">@lang('blog.drafts')</a>
                <a href="#" class="btn btn-default">@lang('blog.trash')</a>
            </div>

            <table class="table table-striped table-condensed table-responsive table-hover">
                <thead>
                <tr>
                    <th>@lang('blog.id')</th>
                    <th>
                        @lang('blog.title')<br>
                        @lang('blog.intro_text')
                    </th>
                    <th>@lang('blog.published')</th>
                    <th style="min-width:200px">
                        @lang('blog.author')<br>
                        @lang('blog.created_at')<br>
                        @lang('blog.last_updated_at')
                    </th>
                    <th>@lang('blog.action')</th>
                </tr>
                </thead>

            @foreach($posts as $blog_post)

                <tr>
                    <td>{{ $blog_post['id'] }}</td>
                    <td>
                        <a href="{{ URL::route('getUpdateBlogPost', $blog_post['id']) }}"><b>{{ $blog_post['title'] }}</b></a><br>
                        <div class="admin-categories">
                        @foreach($blog_post['categories'] as $category)
                            <span style="background-color:{{ $category['color'] }}">{{ $category['title'] }}</span>
                        @endforeach
                        </div>
                        {{ strip_tags($blog_post['intro_text']) }}
                        <br><br>
                    </td>
                    <td class="text-center">
                        @if($blog_post['enabled'])
                        <i class="glyphicon glyphicon-ok"></i>
                        @else
                        <i class="glyphicon glyphicon-remove"></i>
                        @endif
                    </td>
                    <td>
                        <a href="#">{{ $blog_post['author']['first_name'] }} {{ $blog_post['author']['last_name'] }}</a><br>
                        <i class="glyphicon glyphicon-asterisk"></i> {{ $blog_post['created_at'] }}<br>
                        <i class="glyphicon glyphicon-pencil"></i> {{ $blog_post['updated_at'] }}
                    </td>
                    <td>@include('admin/blogPosts/action')</td>
                </tr>

            @endforeach

            </table>
        @else

            <div class="alert alert-warning">
                <i class="glyphicon glyphicon-info-sign"></i>&nbsp;
                @lang('blog.no_blog_posts_to_display')
            </div>

            @endif

            <div class="pull-right">
                @include('partials.pagination')
            </div>
        </div>
    </div>

@stop