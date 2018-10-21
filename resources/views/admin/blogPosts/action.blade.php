<div class="btn-group">
    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @lang('blog.action') <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ URL::route('getUpdateBlogPost', $blog_post['id']) }}">@lang('blog.edit')</a></li>
        @if($blog_post['enabled'])
            <li><a href="{{ URL::route('getUnpublishBlogPost', $blog_post['id']) }}">@lang('blog.unpublish')</a></li>
        @else
            <li><a href="{{ URL::route('getPublishBlogPost', $blog_post['id']) }}">@lang('blog.publish')</a></li>
        @endif
        <li role="separator" class="divider"></li>
        <li><a href="{{ URL::route('getDeleteBlogPost', $blog_post['id']) }}">@lang('blog.delete')</a></li>
    </ul>
</div>
