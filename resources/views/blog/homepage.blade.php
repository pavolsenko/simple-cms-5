@extends('layouts/default')

@section('content')

    <section id="page-head-bg">
    </section><!--page-head bg end-->

    <section id="blog-list" class="padding-80">
        <div class="container">
            <div class="section-heading text-center">
                @if(empty($category))
                <h4 class="small section-title"><span>@lang('blog.something_to_read')</span></h4>
                <h1 class="large section-title">@lang('blog.welcome_to_my_blog')</h1>
                @else
                <h4 class="small section-title"><span>@lang('blog.category')</span></h4>
                <h1 class="large section-title">{{ $category['title'] }}</h1>
                @endif
            </div><!--section heading-->
        </div><!--section heading-->

        <div class="container">
            <div class="row">
                <div class="col-sm-9">

                @if(!empty($posts))

                    @foreach($posts as $blog_post)

                    <div class="blog-item-sec">
                        <div class="blog-item-head">
                            <h3>
                                <a href="{{ URL::route('blogPost', ['id' => $blog_post['id'], 'url' => $blog_post['url']]) }}">
                                    {{ $blog_post['title'] }}
                                </a>
                            </h3>
                        </div>

                        @include('partials/blogPostInfo')

                        <div class="blog-item-post-desc">
                            {!! $blog_post['intro_text'] !!}
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-sm-12 text-right col-xs-12">
                                <a href="{{ URL::route('blogPost', ['id' => $blog_post['id'], 'url' => $blog_post['url']]) }}" class="btn btn-theme-color">@lang('blog.read_more') <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    @include('partials/pagination')
                @else
                    <div class="alert alert-warning">
                        <i class="glyphicon glyphicon-info-sign"></i>&nbsp;
                        @lang('blog.no_blog_posts_to_display')
                    </div>
                @endif

                </div>
                <div class="col-sm-3">
                    @include('blog/rightColumn')
                </div>

            </div>
        </div>
    </section>

@stop