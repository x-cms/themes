@extends('base::layouts.master')

@section('content')
    <div class="box box-info">
        <div class="box-body">
            <form method="post" action="{{ route('themes.update') }}">
                {{ csrf_field() }}
                @foreach(Theme::all() as $key => $theme)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="{{ url(config('themes.paths.base')) }}/{{ Theme::getProperty($theme.'::name') }}/screenshot.png"
                                 alt="">
                        </div>
                        <div class="caption">
                            <h3>{{ Theme::getProperty($theme.'::name') }}</h3>
                            <p>author: {{ Theme::getProperty($theme.'::author') }}</p>
                            <p>version: {{ Theme::getProperty($theme.'::version') }}</p>
                            <p>description: {{ Theme::getProperty($theme.'::description') }}</p>
                            <p>
                                @if($currTheme == Theme::getProperty($theme.'::alias'))
                                    <a href="javascript:;" class="btn btn-success">已启用</a>
                                @else
                                    <button type="submit" name="theme" class="btn btn-primary" value="{{ Theme::getProperty($theme.'::alias') }}">启用主题</button>
                                @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
    </div>
@endsection