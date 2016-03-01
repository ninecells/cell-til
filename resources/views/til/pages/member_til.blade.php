<?php
use App\User;

$member = User::find($member_id);
?>

@extends('ncells::jumbotron.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div>
            @include('ncells::auth.parts.member_tab', ['member_id' => $member->id, 'tabitem_key' => 'til'])
            <div class="tab-content">
                <br/>
                <div role="tabpanel" class="tab-pane active">
                    <p>
                        <a href="/til/write" class="btn btn-default">글 작성</a>
                    </p>
                    @foreach($posts as $post)
                    <div class="well well-sm">

                        <form method="POST" action="/til/{{ $post->id }}/delete">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <b>{{ $post->category->title }} > {{ $post->title }}</b><br/>
                            {{ $post->created_at->diffForHumans() }}
                            @can('til-edit', $post)
                            | <a class="btn btn-xs btn-default" href="/til/{{ $post->id }}/edit">수정</a>
                            <button class="btn btn-xs btn-danger">삭제</button>
                            @endcan
                        </form>

                        <hr/>

                        {!! $post->md_content !!}

                    </div>
                    @endforeach
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
