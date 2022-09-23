@extends('layouts.base')
@section('title','登録完了')
@section('main')
<div class="login_form margin_top content-box">
  <h1>登録完了</h1>
  <p>職員の新規登録が完了しました。</p>
  <div class="to_login_link">
    <a href="{{url('/login')}}">ログイン画面へ戻る</a>
  </div>
</div>
@php
if (Session::get('role_id')== 3 ||Session::get('role_id')== 4) {
  header("Location:top");
  exit;
}
@endphp
@endsection
