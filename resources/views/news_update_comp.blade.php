@extends('layouts.user_base')
@section('title','お知らせ編集')
@section('main')
<div class="main-wrapper">
  <div class="content-box">
    <h1> 編集完了</h1>
    <div class="input-box">
      <p>お知らせの編集が完了しました。</p>
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
