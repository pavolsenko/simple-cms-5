            <div class="sidebar-box">
                <h4>@lang('blog.categories')</h4>
                @if(empty($categories))

                <div class="alert alert-warning">
                    @lang('blog.no_categories_found')
                </div>

                @else

                <ul class="list-unstyled cat-list">
                    @foreach($categories as $category)
                        @if($category['posts'] > 0)
                    <li>
                        <a href="{{ URL::route('blogCategory', ['id' => $category['id'], 'url' => $category['url']]) }}">{{ $category['title'] }}
                            <span class="label label-danger pull-right" style="background-color:{{ $category['color'] }}">{{ $category['posts'] }}</span></a>
                    </li>
                        @endif
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="sidebar-box">
                @include('partials/latestPosts')
            </div>

