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
                    <li class="{{ active_class(( if_query('order', 'default') || if_query('order', '') ||if_route_param(Request::url(),'order')  )) }}"><a href="{{ Request::url() }}?order=default{{ isset($_GET['boostag_id'])?'&boostag_id='.$_GET['boostag_id']:'' }}{{ isset($_GET['tag_id'])?'&tag_id='.$_GET['tag_id']:'' }}">最后回复</a></li>
                    <li class="{{ active_class(if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=recent{{ isset($_GET['boostag_id'])?'&boostag_id='.$_GET['boostag_id']:'' }} {{ isset($_GET['tag_id'])?'&tag_id='.$_GET['tag_id']:''}}
                        ">最新发布</a></li>
                    <li style="float: right;width: 42%">
                    <form action="{{ Request::url() }}" method="get" accept-charset="UTF-8">
                       {{--  {{ csrf_field() }} --}}
                        <button id="zjbtn" style="float: right" type="submit" class="btn btn-success zj_select"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 筛选</button>

                        @if(isset($_GET['order'])&&!empty($_GET['order']))
                        <input type="hidden" name="order" value="{{ $_GET['order'] }}">
                        @endif

                        <select name='tag_id' id="tag2"  class="form-control zj_select zj_sel" style="display: none">

                        </select>

                        <select name="boostag_id" id="tag" class="form-control zj_select zj_sel" >
                            <option value="non" disabled selected>请选择一级标签</option>
                            @foreach($boostags as $boostag)
                                <option value="{{ $boostag->id }}">{{ $boostag->name }}</option>
                            @endforeach
                        </select>


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

@section('scripts')
    <script type="text/javascript">
        var url = '{{ route('getTags') }}';
    </script>

    <script type="text/javascript" src="{{ asset('js/topics.js') }}"></script>
@endsection