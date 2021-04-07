@extends('layout')

@section('title', __('home.title'))

@section('content')
    <div class="content">
        @auth
            <h1 class="title">@lang('home.header_auth', ['user.firstname' => Auth::user()->firstname])</h1>
            @if(Auth::user()->hospitals()->count() > 0)
                <div class="box content">
                    <h1 class="title">@lang('home.hospital')</h1>
                    <p>{{Auth::user()->hospitals()->first()->name}}</p>
                </div>
            @endif
            @if(Auth::user()->trials()->count() > 0)
                <div class="box content">
                    <h1 class="title">@lang('home.trials')</h1>
                    @foreach(Auth::user()->trials()->get()->toArray() as $trial)
                        <div class="box content">
                            @if ($trial['successful'] === 1)
                                <span class="tag is-pulled-right is-success">@lang('home.trials.success')</span>
                            @endif

                            @if ($trial['successful'] === 0)
                                <span class="tag is-pulled-right is-danger">@lang('home.trials.failure')</span>
                            @endif

                            @if ($trial['successful'] === null)
                                <span class="tag is-pulled-right is-warning">@lang('home.trials.pending')</span>
                            @endif
                            <h1 class="title is-spaced is-4">@lang('home.trials.name', ['trial.id' => $trial['id']])</h1>
                        </div>
                    @endforeach
                </div>
            @endif
        @else
            <h1 class="title">@lang('home.header_guest')</h1>
            <p>@lang('home.description')</p>
        @endauth
    </div>
@endsection
