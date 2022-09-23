@extends('layouts.user_base')
@section('title','新規登録')
@section('main')
<div class="main-wrapper">
  <div class="content-box">
    <h1>記録する</h1>
    <div class="input-box">
      <form class="" action="{{url('record_insert_comp')}}" method="post">
        @csrf
        <p>記録の種類</p>
        <p><span>{{ $errors->first('type') }}</span></p>
        <select name="type">
          <option value="1" selected>共有事項</option>
          @if(session('role_id') == 1 || session('role_id') == 3 )
          <option value="2">看護記録</option>
          @endif
          <option value="3">介護記録</option>
        </select>
        <br>
        <br>
        <p>対象者</p>
        @if(!empty($typeError))
        <span class="red"><p>※看護記録・介護記録は対象者選択必須※</p></span>
        @else
        <p>※看護記録・介護記録は対象者選択必須※</p>
        @endif
        {{ $errors->first('customer_id') }}
        <select name="customer_id">
          <option value="0" selected>全体</option>
          @foreach($customers as $customer)
          <option value="{{$customer -> id}}">
            @if(!empty($customer -> room_number))
            {{$customer -> room_number}}号室　
            @endif
            {{$customer -> name}}様
          </option>
          @endforeach
        </select>
        <br>
        <br>
        <p>内容</p>
        <p><span class="red">{{ $errors->first('detail') }}</span></p>
        <textarea name="detail" rows="8" cols="80">{{old('detail')}}@if(!empty($detail)){{$detail}}@endif</textarea>
        @foreach($errors as $error)
        {{$error}}
        @endforeach
        <input type="hidden" name="user_id" value="{{session('user_id')}}">
        <input type="hidden" name="title" value="0">
        <input type="hidden" name="" value="">
        <br>
        <br>
        <br>
        <div class="submit-btn">
          <input class="insert-submit-button" type="submit" name="" value="記録する">
        </div>
      </form>
    </div>
    <div class="more-link input-width">
      <a href="{{url('top')}}">TOPへ戻る</a>
    </div>
  </div>
</div>
@endsection
