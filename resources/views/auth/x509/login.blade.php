@extends('layout')

@section('title', __('auth.login.title'))

@section('content')
    <div class="breadcrumb">
        <ul>
            <li><a href="/">Professional Pills</a></li>
            <li class="is-active"><a href="{{ route('auth.x509.login') }}">@lang('auth.x509.login.breadcrumb')</a></li>
        </ul>
    </div>

    <h1 class="title">@lang('auth.login.header')</h1>
@endsection
