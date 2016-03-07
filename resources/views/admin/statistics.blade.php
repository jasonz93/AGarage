@extends('admin.base')

@section('main')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily_pv') }}</div>
                <div class="panel-body">{{ $daily_pv }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily_ip') }}</div>
                <div class="panel-body">{{ $daily_ip }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily_resources') }}</div>
                <div class="panel-body">
                    @foreach($daily_resources as $resource)
                        <div class="btn btn-success resource-tag">{{$resource->resource}} <span class="badge">{{ $resource->visits }}</span></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <style>
        .resource-tag {
            margin: 5px;
        }
    </style>
@endsection