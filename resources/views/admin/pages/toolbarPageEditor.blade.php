                <div>
                    {!! Form::submit(trans('page.save'), ['class' => 'btn btn-primary btn-sm']) !!}
                    <a href="#" class="btn btn-default btn-sm" id="close-after-submit">@lang('page.save_and_close')</a>
                    @if(isset($page))
                        <a href="{{ URL::route('staticPage', ['id' => $page['id'], 'url' => $page['url']]) }}" class="btn btn-default btn-sm" target="_blank">
                            @lang('page.preview')
                        </a>
                    @endif
                    <a href="{{ URL::route('pagesDashboard') }}" class="btn btn-default btn-sm">
                        @lang('page.cancel')
                    </a>
                </div>
