@extends('layouts.user_base')
@section('title','入居者新規登録')
@section('main')
<div class="content-box width1000">
  <form class="customer-container edit customer-edit" action="{{url('customer_register_comp')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h1>入居者新規登録</h1>
    <p>入居者情報を入力してください。※名前・入居状況必須</p>
    <br>
    <div class="">
      <input type="file" accept="image/*" name="image_url" value="" placeholder="写真" >
      <br><br>
      <div class="detail">
        <h3>【入居状況】</h3>
        <select class="" name="state">
          <option value="0" selected>不在</option>
          <option value="1">入居中</option>
          <option value="2">入院中</option>
        </select>
        <h3>【部屋番号】</h3>
        <span class="red">{{ $errors->first('room_number') }}</span><br>
        <input type="text" name="room_number" placeholder="部屋番号">
        <h3>【入居者氏名】<span class="red">※必須項目</span></h3>
        <span class="red">{{ $errors->first('name') }}</span>
        <input type="text" name="name" placeholder="入居者氏名">
        <h3>【性別】</h3>
        <select class="" name="gender">
          <option value="0" selected>男性</option>
          <option value="1">女性</option>
        </select>
        <h3>【生年月日】</h3>
        <span class="red">{{ $errors->first('birth') }}</span><br>
        <input type="date" name="birth">
        <h3>【既往歴】</h3>
        <span class="red">{{ $errors->first('medical_history') }}</span><br>
        <textarea name="medical_history" rows="8" cols="80"></textarea>
        <h3>【人物】</h3>
        <span class="red">{{ $errors->first('personality') }}</span><br>
        <textarea name="personality" rows="8" cols="80"></textarea>
        <br>
        <br>
        <div class="submit-btn">
          <input type="submit" name="" value="更新">
        </div>
      </div>
      <div class="to_login_link">
        <a href="{{url('/index')}}">一覧画面へ戻る</a>
      </div>
    </div>
  </form>
</div>
@php
if (Session::get('role_id')== 3 ||Session::get('role_id')== 4) {
  header("Location:top");
  exit;
}
@endphp
@endsection
