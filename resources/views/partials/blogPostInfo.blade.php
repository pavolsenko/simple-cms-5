                    <div class="blog-item-post-info">
                        <span>@lang('blog.posted_by') {{ $blog_post['author']['first_name'] }} {{ $blog_post['author']['last_name'] }} |
                            @lang('blog.posted_on') {{ date('j M Y', strtotime($blog_post['created_at'])) }} |
                            @if(!empty($blog_post['comments']))
                                @if(count($blog_post['comments']) === 1)
                                    1 @lang('comment.comment')
                                @else
                                    {{ count($blog_post['comments']) }} @lang('comment.comments')
                                @endif
                            @else
                                0 @lang('comment.comments')
                            @endif
                        </span>
                    </div>
                    <div class="blog-item-post-info categories">
                    @foreach($blog_post['categories'] as $category)

                        <span style="background-color:{{ $category['color'] }}">{{ $category['title'] }}</span>

                    @endforeach
                    </div>