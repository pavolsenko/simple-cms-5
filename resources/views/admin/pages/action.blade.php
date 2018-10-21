<div class="btn-group">
    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @lang('page.action') <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ URL::route('getUpdatePage', $page['id']) }}">@lang('page.edit')</a></li>
        @if($page['enabled'])
            <li><a href="{{ URL::route('getUnpublishPage', $page['id']) }}">@lang('page.unpublish')</a></li>
        @else
            <li><a href="{{ URL::route('getPublishPage', $page['id']) }}">@lang('page.publish')</a></li>
        @endif
        <li role="separator" class="divider"></li>
        <li><a href="{{ URL::route('getDeletePage', $page['id']) }}">@lang('page.delete')</a></li>
    </ul>
</div>
