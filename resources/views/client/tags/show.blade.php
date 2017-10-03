a@extends('layouts.app')

@section('content')
    <div id="chatter">
        <div class="container">
            <div class="row">


                <div class="col-md-3 left-column">

                    @include('parent.left_colum')

                </div>

                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Recent Post</b><span class="pull-right glyphicon glyphicon-pushpin"></span>
                        </div>

                        @if (count($themes) == null)
                            <div class="panel-body">
                                Have no post
                            </div>

                        @endif

                        @foreach($themes as $theme)
                            <ul class="list-group">
                                <a href="{{ route('theme.show', ['id'=> $forum_id ,'slug' => $theme->slug]) }}"
                                   class="list-group-item" style="padding:10px 1px">
                                    <div class="col-md-10 col-xs-9">
                                        {{ $theme->name }} <br>
                                    </div>
                                    <p style="font-size:12px;margin-top:2px;" class="">
                                        <span class="fa fa-comments"></span> : {{ count($theme->messages) }} Replies
                                        <br>
                                    </p>
                                </a>
                            </ul>
                        @endforeach
                    </div>

                    <span class="pull-right">{!! $themes->links() !!}</span>
                </div>

            </div>
        </div>
    </div>
@endsection

