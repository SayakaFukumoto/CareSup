@extends('layouts.base')
@section('title','ログイン画面')
@section('main')
<div class="main_wrapper content-box">
<form class="login_form" action="{{url('top')}}" method="post">
  @csrf
  <div class="login_form_top">
    <h1>ログイン画面</h1>
  </div>
  <div class="login_form_btm">
    @if(!empty($loginPasswordError)||!empty($loginUserError))
    <span class="red">※従業員IDもしくはパスワードが間違っています※</span><br>
    @endif
    <div class="input_box">
      <p>職員ID</p>
      <input type="id" name="login_id" value="{{old('login_id')}}" placeholder=" 職員ID">
      <br>
      <span class="red">{{ $errors->first('login_id') }}</span><br>
    </div>
    <div class="input_box">
      <p>パスワード</p>
      <input type="password" name="password" placeholder=" パスワード">
      <br>
      <span class="red">{{ $errors->first('password') }}</span><br>
    </div>
  </div>
  <br>
  <button type="submit">ログイン</button><br>
</form>
<div class="update_link">
  <a  href="{{url('/pass_update')}}">パスワードの変更は<span>こちら</span></a><br>
</div>
</div>
@endsection
