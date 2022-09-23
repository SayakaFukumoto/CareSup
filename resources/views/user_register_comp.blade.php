@extends('layouts.user_base')
@section('title','お知らせ詳細')
@section('main')
<div class="main-wrapper">
  <div class="content-box">
    <h1>新規登録完了</h1>
    <div class="input-box">
      <p>新規登録が完了しました。<br>ログインIDとパスワードを従業員に伝えてください</p>
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
