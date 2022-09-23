@extends('layouts.user_base')
@section('title','入居者情報編集')
@section('main')
<div class="content-box width1000 regist">
  <form class="customer-container edit" action="{{url('customer_update_comp')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h1>入居者情報編集</h1>
    <p>入居者情報を入力してください。</p>
    <br>
    <div class="">
      @if(empty($customer -> image_url))
      <div class="customer-img no-image-url">no image</div>
      @else
      <img class="customer-img" src="{{$customer -> image_url }}" alt="">
      @endif
      @if(session('role_id') == 1 || session('role_id') == 2 )
      <h3>【写真】</h3>
      <input type="file" accept="image/*" name="image_url" value="{{$customer -> image_url }}" placeholder="{{$customer -> image_url }}" >
      <br><span class="red">{{ $errors->first('image_url') }}</span><br><br>
      <div class="detail">
        <h3>【入居状況】</h3>
        <select class="" name="state">
          <option value="{{$customer -> state}}" selected>
            @if($customer -> state ==0)
            不在
            @elseif($customer -> state ==1)
            入居中
            @elseif($customer -> state ==2)
            入院中
            @endif
          </option>
          <option value="0" selected>不在</option>
          <option value="1">入居中</option>
          <option value="2">入院中</option>
        </select>
        <h3>【部屋番号】</h3>
        {{ $errors->first('room_number') }}<br>
        <input type="text" name="room_number" value="{{$customer -> room_number}}" placeholder="{{$customer -> room_number}}">

        <h3>【入居者氏名】<span>※</span><p class="red">※必須項目</p></h3>
        {{ $errors->first('name') }}
        <input type="text" name="name"  value="{{$customer -> name}}" placeholder="{{$customer -> name}}">
        <h3>【性別】</h3>
        <select class="" name="gender">
          <option value="{{$customer -> gender}}" selected>
            @if($customer -> gender ==0)
            男性
            @elseif($customer -> gender ==1)
            女性
            @endif
          </option>
          <option value="0">男性</option>
          <option value="1">女性</option>
        </select>
        <h3>【生年月日】</h3>
        {{ $errors->first('birth') }}<br>
        <input type="date" name="birth" value="{{$customer -> birth}}">
        @else
        <div class="detail">
          <h3>【部屋番号】{{$customer -> room_number}}</h3>
          <h3>【氏名】{{$customer -> name}}</h3>
          <h3>【性別】
            @if($customer -> gender ==0)
            男性
            @else
            女性
            @endif
          </h3>
          <h3>【生年月日】{{$customer -> birth}}</h3>
          <input type="hidden" name="name" value="{{$customer -> name}}">
          <input type="hidden" name="state" value="{{$customer -> state}}">
          @endif
          <h3>【既往歴】</h3>
          {{ $errors->first('medical_history') }}<br>
          <textarea name="medical_history" rows="8" cols="80">{{$customer -> medical_history}}</textarea>
          <h3>【人物】</h3>
          {{ $errors->first('personality') }}<br>
          <textarea name="personality" rows="8" cols="80">{{$customer -> personality}}</textarea>
          <input type="hidden" name="id" value="{{$customer -> id}}">
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
  @endsection
