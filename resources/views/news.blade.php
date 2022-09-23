@extends('layouts.user_base')
@section('title','お知らせ詳細')
@section('main')
<div class="main-wrapper">
  <div class="content-box margin-bot">
    <h1>お知らせ詳細</h1>
    <div class="news-title">
      <p>{{$news -> created_at}}</p>
      <h2>{{$news -> title}}</h2>
      <p>{{$news -> name}}</p>
    </div>
    <div class="note">
    <p>{{$news -> detail}}</p>
    <br>
    </div>
    <div class="more-link">
      <a href="{{url('top')}}">TOPへ戻る</a>
    </div>
  </div>
</div>
@endsection
