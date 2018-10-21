@extends('layouts/default')

@section('content')

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-heading text-center">
                    <h4 class="small section-title"><span>@lang('404.error_404')</span></h4>
                    <h1 class="large section-title">@lang('404.page_not_found')</h1>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2">
                @lang('404.page_not_found_message')
                <br><br><br>
                <div class="text-center">
                    <a href="/" class="btn btn-success">@lang('404.go_to_homepage')</a>&nbsp;&nbsp;
                    <a href="/blog" class="btn btn-info">@lang('404.go_to_blog_homepage')</a>&nbsp;&nbsp;
                    <a href="/contact" class="btn btn-warning">@lang('404.contact_me')</a>
                </div>
                <br><br><br><br><br>
                <br><br><br><br><br>

            </div>
        </div>
    </div>

@stop
