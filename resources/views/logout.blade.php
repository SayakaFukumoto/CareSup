@extends('layouts.base')
@section('title','ログアウト完了')
@section('main')
<div class="login_form margin_top content-box">
  <h1>ログアウト完了</h1>
  <p>ログアウトが完了しました。</p>
  <div class="to_login_link">
    <a href="{{url('/login')}}">ログイン画面へ戻る</a>
  </div>
</div>
@endsection
