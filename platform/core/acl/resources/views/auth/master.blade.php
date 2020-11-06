@extends('core/base::layouts.base')

@section('body-class')
    login
@stop

@section ('page')
    <div class="login-wrapper">
        <div>
            <div class="content">
                @yield('content')
            </div>
            @if (env('SHOW_ADMIN_LANGUAGE', false))
                <div class="copyright">
                    <p>
                        @foreach (Assets::getAdminLocales() as $key => $value)
                            <span @if (app()->getLocale() == $key) class="active" @endif>
                        <a href="{{ route('admin.language', $key) }}">
                            {!! language_flag($value['flag'], $value['name']) !!} <span>{{ $value['name'] }}</span>
                        </a>
                    </span>
                        @endforeach
                    </p>
                </div>
            @endif
        </div>
    </div>
@stop
