                    <div class="comment-wrapper">

                    @if(!empty($blog_post['comments']))

                        @if(count($blog_post['comments']) > 1)
                        <h4>{{ count($blog_post['comments']) }} @lang('comment.comments') <a href="#comments" class="btn btn-default btn-xs">@lang('comment.submit_comment')</a></h4>
                        @else
                        <h4>1 @lang('comment.comment') <a href="#comments" class="btn btn-default btn-xs">@lang('comment.submit_comment')</a></h4>
                        @endif


                        <div class="comment-box">

                            @foreach($blog_post['comments'] as $comment)

                            <div class="comment-list">
                                <img src="{{ $comment['author']['avatar_url'] }}" class="img-responsive" alt="">
                                <h5>
                                    @if(!empty($comment['author']['website']))
                                    <a href="{{ $comment['author']['website'] }}" target="_blank">{{ $comment['author']['name'] }}</a>
                                    @else
                                    {{ $comment['author']['name'] }}
                                    @endif
                                    @lang('comment.posted_on') {{ date('j M Y H:m', strtotime($comment['created_at'])) }}
                                </h5>

                                <p>
                                    {{ $comment['text'] }}
                                </p>
                            </div>

                            @endforeach

                        </div>

                    @else

                        <h4>@lang('comment.no_comment') <a href="#comments" class="btn btn-default btn-xs">@lang('comment.submit_comment')</a></h4>

                        <div class="alert alert-warning">
                            @lang('comment.no_comments_yet')
                        </div>

                    @endif

                        <a name="comments"></a>
                        <h4>@lang('comment.submit_comment')</h4>

                        {!! Form::open(['route' => 'postComment', 'method' => 'post', 'class' => 'form']) !!}

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

                        <div>
                            {!! Form::label('name', trans('comment.name')) !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!! Form::label('email', trans('comment.email')) !!} (@lang('comment.will_not_be_public'))
                            {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!! Form::label('website', trans('comment.website')) !!} (@lang('comment.optional'))
                            {!! Form::text('website', null, ['class' => 'form-control']) !!}
                        </div>
                        <div>
                            {!! Form::label('text', trans('comment.text')) !!}
                            {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="text-center">
                            {!! Form::submit(trans('comment.submit'), ['class' => 'btn btn-primary']) !!}
                            {!! Form::hidden('blog_post_id', $blog_post['id']) !!}
                        </div>
                        {!! Form::close() !!}

                    </div>