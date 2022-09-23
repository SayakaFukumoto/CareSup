@extends('layouts.user_base')
@section('title','新規登録完了')
@section('main')
<div class="main-wrapper">
  <div class="content-box">
    <h1>入居者新規登録</h1>
    <div class="input-box">
      <p>新規登録が完了しました。</p>
    </div>
    <div class="more-link input-width">
      <a href="{{url('top')}}">TOPへ戻る</a>
    </div>
  </div>
</div>
@php
if (session('user')== 3||4) {
  header("Location:top");
  exit;
}
@endphp
@endsection
