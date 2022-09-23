@extends('layouts.user_base')
@section('title','入居者')
@section('main')
<div class="main-wrapper">
  <h1>一覧</h1>
  <div class="content container">
    @foreach($customers as $customer)
    <div class="content-box index">
      <span class="tape small-tape"> 　　</span>
      <div class="customer">
        <p class="room-num">{{$customer -> room_number }}　</p>
        <a href="{{ route('view',['id'=>$customer -> id ]) }}">
          @if(empty($customer -> image_url))
          <div class="image-url no-image-url">no image</div>
          @else
          <img class="image-url" src="{{asset($customer -> image_url) }}" alt="">
          @endif
          <p>{{$customer -> name }}様</p>
        </a>
        <p class="state">
          @if($customer -> state == 0)
          不在
          @elseif($customer -> state == 2)
          入院中
          @endif
        </p>
        <div class="icon-box">
          <a href="{{ route('customer_update',['id'=>$customer->id]) }}"><input type="image"  class="icon" alt="pen" src=".\img\pencil.png"></a>
          @if(session('role_id') == 1 || session('role_id') == 2 )
          <a href="{{ route('customer_delete',['id'=>$customer->id]) }}"><input type="image"  class="icon" alt="gomi" src=".\img\gomi.png" onclick="return confirm('削除しますか？')"></a>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
