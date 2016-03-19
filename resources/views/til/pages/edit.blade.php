@extends('ncells::app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">홈</a></li>
    <li><a href="/til">TIL</a></li>
    <li class="active">글 수정</li>
</ol>

<h2>글 수정</h2>

<form method="post" action="/til/{{ $post->id }}/update">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
        <label for="title">카테고리</label>
        <input type="text" class="form-control" id="category" name="category" placeholder="카테고리" value="{{ $post->category->title }}">
    </div>
    <div class="form-group">
        <label for="title">제목</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="제목" value="{{ $post->title }}">
    </div>
    <div class="form-group">
        <label for="content">내용</label>
        <textarea class="form-control" id="content" name="content" placeholder="제목" rows="10">{{ $post->content }}</textarea>
    </div>
    <button type="submit" class="btn btn-default">저장</button>
</form>
@endsection