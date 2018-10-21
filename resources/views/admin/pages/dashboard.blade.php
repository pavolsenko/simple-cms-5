@extends('layouts/admin')

@section('content')
    <div class="row">

        <div class="col-xs-10 col-xs-offset-1">

        <h1>@lang('page.pages_dashboard_heading')</h1>

        @if(session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <a href="{{ URL::route('getCreatePage') }}" class="btn btn-primary btn-sm">@lang('page.create_new')</a>

        @if(!empty($pages))

            <div class="pull-right">
                @include('partials.pagination')
            </div>

            <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-default">@lang('page.all')</a>
                <a href="#" class="btn btn-default">@lang('page.published')</a>
                <a href="#" class="btn btn-default">@lang('page.drafts')</a>
                <a href="#" class="btn btn-default">@lang('page.trash')</a>
            </div>

            <table class="table table-striped table-condensed table-responsive table-hover">
                <thead>
                <tr>
                    <th>@lang('page.id')</th>
                    <th>
                        @lang('page.title')<br>
                        @lang('page.url')
                    </th>
                    <th>@lang('page.published')</th>
                    <th style="min-width:200px">
                        @lang('page.created_at')<br>
                        @lang('page.last_updated_at')
                    </th>
                    <th>@lang('page.action')</th>
                </tr>
                </thead>

            @foreach($pages as $page)

                <tr>
                    <td>{{ $page['id'] }}</td>
                    <td>
                        <a href="{{ URL::route('getUpdatePage', $page['id']) }}"><b>{{ $page['title'] }}</b></a><br>
                        <a href="{{ URL::route('staticPage', $page['url']) }}" target="_blank"><span class="text-muted">/{{ $page['url'] }}</span></a>
                    </td>
                    <td class="text-center">
                        @if($page['enabled'])
                        <i class="glyphicon glyphicon-ok"></i>
                        @else
                        <i class="glyphicon glyphicon-remove"></i>
                        @endif
                    </td>
                    <td>
                        <i class="glyphicon glyphicon-asterisk"></i> {{ $page['created_at'] }}<br>
                        <i class="glyphicon glyphicon-pencil"></i> {{ $page['updated_at'] }}
                    </td>
                    <td>@include('admin/pages/action')</td>
                </tr>

            @endforeach

            </table>
        @else

            <br><br>
            <div class="alert alert-warning">
                <i class="glyphicon glyphicon-info-sign"></i>&nbsp;
                @lang('page.no_pages_to_display')
            </div>

            @endif

            <div class="pull-right">
                @include('partials.pagination')
            </div>
        </div>
    </div>

@stop