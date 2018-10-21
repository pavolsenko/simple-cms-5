@extends('layouts/default')

@section('content')

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="blog-item-head">
                    <h3>{{ $page['title'] }}</h3>
                </div>

                <div>
                    {!! $page['body_text'] !!}
                </div>
            </div>

            <br><br>
        </div>
    </div>

@stop
