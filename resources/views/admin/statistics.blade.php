@extends('admin.base')

@section('main')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily.pv') }}</div>
                <div class="panel-body">{{ $daily->pv }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily.ip') }}</div>
                <div class="panel-body">{{ $daily->ip }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily.maxExecTime') }}</div>
                <div class="panel-body">{{ $daily->maxExecTime }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily.resources_pv') }}</div>
                <div class="panel-body">
                    @foreach($daily->resources->pv as $resource)
                        <div class="btn btn-success resource-tag">{{$resource->resource}} <span class="badge">{{ $resource->visits }}</span></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily.resources_ip') }}</div>
                <div class="panel-body">
                    @foreach($daily->resources->ip as $resource)
                        <div class="btn btn-success resource-tag">{{ $resource->resource }} <span class="badge">{{ $resource->ips }}</span></div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('admin.statistics.daily.avgExecTime') }}</div>
                <div class="panel-body">{{ $daily->avgExecTime }}</div>
            </div>
        </div>
    </div>
    <style>
        .resource-tag {
            margin: 5px;
        }
    </style>
@endsection