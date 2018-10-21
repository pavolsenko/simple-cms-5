            <h4>@lang('blog.latest_posts')</h4>

            @if(empty($latest_posts))

                <div class="alert alert-warning">
                    @lang('blog.no_recent_posts_found')
                </div>
            @else

                <ul class="list-unstyled cat-list">
                    @foreach($latest_posts as $blog_post)
                        <li>
                            <a href="{{ URL::route('blogPost', ['id' => $blog_post['id'], 'url' => $blog_post['url']]) }}">{{ $blog_post['title'] }}</a>
                            @lang('blog.posted_by') {{ $blog_post['author']['first_name'] }} {{ $blog_post['author']['last_name'] }}<br>
                            @lang('blog.posted_on') {{ date('j M Y', strtotime($blog_post['created_at'])) }}
                        </li>
                    @endforeach
                </ul>
            @endif
