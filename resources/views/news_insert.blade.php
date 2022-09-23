@extends('layouts.user_base')
@section('title','お知らせ新規登録')
@section('main')
<div class="main-wrapper">
  <div class="content-box">
    <h1>お知らせ新規登録</h1>
    <div class="input-box">
      <form class="" action="{{url('news_insert_comp')}}" method="post">
        @csrf
        <p>タイトル</p>
        <input type="text" name="title" value="">
        <br>
        <p>内容</p>
        <textarea name="detail" rows="8" cols="80"></textarea>
        <input type="hidden" name="type" value="0">
        <input type="hidden" name="user_id" value="{{session('user_id')}}">
        <input type="hidden" name="customer_id" value="0">
        <div class="submit-btn">
          <input type="submit" name="" value="更新">
        </div>
      </form>
    </div>
    <div class="more-link input-width">
      <a href="{{url('top')}}">TOPへ戻る</a>
    </div>
  </div>
</div>
@php
if (Session::get('role_id')== 3 ||Session::get('role_id')== 4) {
  header("Location:top");
  exit;
}
@endphp
@endsection
