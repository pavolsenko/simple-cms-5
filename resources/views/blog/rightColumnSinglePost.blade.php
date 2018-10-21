
            <div class="sidebar-box">
                <h4>@lang('blog.related_posts')</h4>

                @if(empty($related_posts))

                <div class="alert alert-warning">
                    @lang('blog.no_more_posts')
                </div>

                @else
                    <ul class="list-unstyled cat-list">
                        @foreach($related_posts as $blog_post)
                            <li>
                                <a href="{{ URL::route('blogPost', ['id' => $blog_post['id'], 'url' => $blog_post['url']]) }}">{{ $blog_post['title'] }}</a>
                                @lang('blog.posted_by') {{ $blog_post['author']['first_name'] }} {{ $blog_post['author']['last_name'] }}<br>
                                @lang('blog.posted_on') {{ date('j M Y', strtotime($blog_post['created_at'])) }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
