@extends('layouts.app')

@section('title', isset($category) ? $category->name : '话题列表')

@section('content')

<div class="row">
    <div class="col-lg-9 col-md-9 topic-list">

        @if (isset($category))
            <div class="alert alert-info" role="alert">
                {{ $category->name }} : {{ $category->description }}
            </div>
        @endif
        <div class="panel panel-default">

            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li class="{{ active_class(( if_query('order', 'default') || if_query('order', '') ||if_route_param(Request::url(),'order')  )) }}"><a href="{{ Request::url() }}?order=default">最后回复</a></li>
                    <li class="{{ active_class(if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=recent">最新发布</a></li>
                    <li style="float: right;width: 42%">
                    <form action="" method="get" accept-charset="UTF-8">
                        <select  class="form-control zj_select zj_sel" >
                            <option>1</option>
                            <option>2</option>
                        </select>

                        <select class="form-control zj_select zj_sel">
                            <option>1</option>
                            <option>2</option>
                        </select>

                        <button type="submit" class="btn btn-success zj_select"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 筛选</button>
                    </form>
                    </li>
                </ul>




            </div>

            <div class="panel-body">
                {{-- 话题列表 --}}
                @include('topics._topic_list', ['topics' => $topics])
                {{-- 分页 --}}
                {!! $topics->render() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
        @include('topics._sidebar')
    </div>
</div>

@endsection