@extends('layouts.with_navbar')

@section('content')
    <div class="row">
        <div class="col-md-2">
            {!! $AdminSidebar->asDiv(['class' => 'list-group']) !!}
        </div>
        <div class="col-md-10">
            @yield('main')
        </div>
    </div>
@endsection