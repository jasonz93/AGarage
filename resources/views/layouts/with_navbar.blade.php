@extends('layouts.base')

@section('navbar')
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ $site_name }}</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
                @include('vendor.laravel-menu.bootstrap-navbar-items', ['items' => $MainNavbar->roots()])
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @include('vendor.laravel-menu.bootstrap-navbar-items', ['items' => $RightNavbar->roots()])
            </ul>
            {{--{!! $MainNavbar->asUl(['class' => 'nav navbar-nav']) !!}--}}
            {{--{!! $RightNavbar->asUl(['class' => 'nav navbar-nav navbar-right']) !!}--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li><a href="#">Link</a></li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">Action</a></li>--}}
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        </div>
    </div>
</nav>
@endsection

@section('body')
<div class="container">
    @yield('content')
</div>
@endsection

@section('stylesheets')
<style type="text/css">
    body {
        padding-top: 70px;
    }
</style>
@endsection