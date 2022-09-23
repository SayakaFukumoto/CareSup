@extends('layouts.base')
@section('title','ログイン変更')
@section('main')
<div class="content-box">
<form class="login_form" action="{{url('/pass_update_comp')}}" method="post">
  @csrf
  <div class="login_form_top">
    <h1>パスワード変更画面</h1>
  </div>
  <div class="login_form_btm">
    @if(!empty($loginPasswordError)||!empty($loginUserError))
    <span class="red">※従業員ID、パスワード、確認用パスワードのいずれかが間違っています※</span><br>
    @endif
    <div class="input_box">
      <span class="red">{{ $errors->first('login_id') }}</span><br>
      <input type="id" name="login_id" placeholder=" 職員ID" value="{{old('login_id')}}">
    </div>
    <div class="input_box">
      <span class="red">{{ $errors->first('old_password') }}</span><br>
      <input type="password" name="old_password" placeholder=" 現在のパスワード">
    </div>
    <div class="input_box">
      <span class="red">{{ $errors->first('password') }}</span><br>
      <input type="password" name="password" placeholder=" 新しいパスワード">
    </div>
    <div class="input_box">
      <span class="red">{{ $errors->first('password_confirmation') }}</span><br>
      <input type="password" name="password_confirmation" placeholder=" 確認用新しいパスワード">
    </div>
  </div>
  <br>
  <button type="submit">変更</button>
</form>
</div>
@endsection
