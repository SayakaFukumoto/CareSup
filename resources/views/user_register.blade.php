@extends('layouts.user_base')
@section('title','ユーザー新規登録')
@section('main')
<div class="content-box width1000">

  <h1>ユーザー新規登録</h1>
  <br>
  <div class="center">
    <form class="customer-container edit regist" action="{{url('/user_register_comp')}}" method="post">
      @csrf
      <div class="input_box">
        @if(!empty($loginIdError))
        <span class="red">※このログインIDは既に使用されています※</span><br>
        @endif
        <p class="title">職員ID</p>
        <input type="text" name="login_id" value="{{ old('login_id') }}" placeholder=" 職員ID"autocomplete="">
        <p>※ログインに使用する固有のID(社員番号)です。</p>
        <span class="red">{{ $errors->first('login_id') }}</span><br>
        <p class="title">従業員名</p>
        <input type="text" name="name" value="{{ old('name') }}" placeholder=" 例：介護 太郎">
        <br><span class="red">{{ $errors->first('name') }}</span><br>
        <p class="title">仮パスワード</p>
        <input type="password" name="password" placeholder=" パスワード">
        <br> <span class="red">{{ $errors->first('password') }}</span>
        <br>
        <p class="title">確認用パスワード</p>
        <input type="password" name="password_confirmation"  placeholder=" 確認用パスワード">
        <br> <span class="red">{{ $errors->first('password_confirmation') }}</span><br>
        <br>
        <p class="title">職種選択</p>
        <select name="role_id">
          <option value="4" selected>介護職員</option>
          <option value="3">看護職員</option>
          <option value="2">運営</option>
          <option value="1">ホーム長</option>
        </select>
      </div>
      <br>
      <br>
      <input type="submit" name="" value="職員新規登録">
    </form>
  </div>
</div>
@php
if (Session::get('role_id')== 3 ||Session::get('role_id')== 4) {
  header("Location:top");
  exit;
}
@endphp
@endsection
