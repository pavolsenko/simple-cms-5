@extends('layouts/default')

@section('content')

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="blog-item-sec">

                    <div class="blog-item-head">
                        <h3>{{ $blog_post['title'] }}</h3>
                    </div>

                    @include('partials/blogPostInfo')

                    <div class="blog-item-post-desc">
                        {!! $blog_post['intro_text'] !!}
                    </div>

                    <br>
                    <div class="blog-item-post-desc">
                        {!! $blog_post['body_text'] !!}
                    </div>

                    @include('partials/authorInfo')

                    @include('partials/comments')

                </div>
            </div>

            <div class="col-sm-3">
                @include('blog/rightColumnSinglePost')
            </div>

        </div>
    </div>

@stop