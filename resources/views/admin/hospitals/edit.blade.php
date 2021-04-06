@extends('layout')

@section('title', __('admin/hospitals.edit.title', ['hospital.name' => $hospital->name]))

@section('content')
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('home') }}">{{ config('app.name') }}</a></li>
            <li><a href="{{ route('admin.home') }}">@lang('admin/home.breadcrumb')</a></li>
            <li><a href="{{ route('admin.hospitals.index') }}">@lang('admin/hospitals.index.breadcrumb')</a></li>
            <li><a href="{{ route('admin.hospitals.show', $hospital) }}">{{ $hospital->name }}</a></li>
            <li class="is-active"><a
                    href="{{ route('admin.hospitals.edit', $hospital) }}">@lang('admin/hospitals.edit.breadcrumb')</a></li>
        </ul>
    </div>

    <h1 class="title">@lang('admin/hospitals.edit.header')</h1>

    <form method="POST" action="{{ route('admin.hospitals.update', $hospital) }}">
        @csrf

        <div class="field">
            <label class="label" for="name">@lang('admin/hospitals.create.name')</label>

            <div class="control">
                <input class="input @error('name') is-danger @enderror" type="text" id="name" name="name"
                       value="{{ old('name') }}" autofocus required>
            </div>

            @error('name')
            <p class="help is-danger">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <div class="field">
            <label class="label" for="province">@lang('admin/hospitals.create.province')</label>

            <div class="control">
                <div class="select is-fullwidth @error('province') is-danger @enderror">
                    <select id="province" name="province" required>
                        @foreach (\App\Models\User::PROVINCES as $province)
                            <option
                                {{ $province == old('province', 'Drenthe') ? 'selected' : '' }} value="{{ $province }}">{{ $province }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @error('province')
            <p class="help is-danger">{{ $errors->first('province') }}</p>
            @enderror
        </div>

        <div class="field">
            <div class="control">
                <button class="button is-link" type="submit">@lang('admin/hospitals.edit.button')</button>
            </div>
        </div>
    </form>
@endsection
