                <div>
                    {!! Form::submit(trans('blog.save'), ['class' => 'btn btn-primary btn-sm']) !!}
                    <a href="#" class="btn btn-default btn-sm" id="close-after-submit">@lang('blog.save_and_close')</a>
                    @if(isset($blog_post))
                        <a href="{{ URL::route('blogPost', ['id' => $blog_post['id'], 'url' => $blog_post['url']]) }}" class="btn btn-default btn-sm" target="_blank">
                            @lang('blog.preview')
                        </a>
                    @endif
                    <a href="{{ URL::route('postsDashboard') }}" class="btn btn-default btn-sm">
                        @lang('blog.cancel')
                    </a>
                </div>
