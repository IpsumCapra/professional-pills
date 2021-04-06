@extends('layout')

@section('title', __('admin/home.title'))

@section('content')
    <div class="breadcrumb">
        <ul>
            <li><a href="/">{{config('app.name')}}</a></li>
            <li class="is-active"><a href="{{ route('admin.home') }}">@lang('admin/home.breadcrumb')</a></li>
        </ul>
    </div>

    <h1 class="title">@lang('admin/home.header')</h1>

    <div class="buttons">
        <a class="button" href="{{ route('admin.users.index') }}">@lang('admin/home.users')</a>
        <a class="button" href="{{ route('admin.hospitals.index') }}">@lang('admin/home.hospitals')</a>
    </div>

    <div class="box content">
        <h1 class="title">@lang('admin/home.statistics')</h1>
        <p>@lang('admin/home.statistics.hospital_amount'): {{\App\Models\Hospital::all()->count()}}</p>
        <p>@lang('admin/home.statistics.user_amount'): {{\App\Models\User::all()->count()}}</p>
        <h1 class="title">@lang('admin/home.log')</h1>
        <pre>{{Illuminate\Support\Facades\Storage::disk('local')->get('logs/laravel.log')}}</pre>
    </div>
@endsection
