@extends('layouts.user_base')
@section('title','ログイン変更')
@section('main')
<div class="content-box width1000">
  <div class="customer-container">
    <h1>入居者詳細</h1>
    <div class="PDF-cover">
      <a class="PDF" href="{{route('pdf',['id'=>$customer->id])}}">PDF出力</a>
    </div>
    <div class="customer-detail">

      @if(empty($customer -> image_url))
      <div class="customer-img no-image-url">no image</div>
      @else
      <img class="customer-img" src="{{$customer -> image_url }}" alt="">
      @endif
      <div class="detail">
        <h5>基本情報</h5>
        <div class="">

          <h4>部屋番号</h4>
          <p>{{$customer -> room_number}} 号室</p>
          <h4>氏名</h4>
          <p>{{$customer -> name}} 様</p>
          <h4>性別</h4>
          <p>@if($customer -> gender ==0)
            男性
            @else
            女性
            @endif
          </p>
          <h4>生年月日</h4>
          <p>{{$customer -> birth}}</p>

        </div>
      </div>
    </div>
  </div>
  <div class="box">
    <h5 class="box-title">既往歴</h5>
    <p>{{$customer -> medical_history}}</p>
  </div>

  <div class="box">
    <h5  class="box-title">人物</h5>
    <p>{{$customer -> personality}}</p>
  </div>
  <div class="box">
    <h5  class="box-title">記録</h5>
    <div class="user-news">
      @foreach($records as $record)
      <ul class="news-list">
        <li class="item">
          <div class="">
            <div class="news-deta">
              <div class="right">
                <p class="date">{{$record -> created_at}}</p>
                <p class="category">
                  @if($record -> type ==1)
                  共有事項
                  @elseif($record -> type ==2)
                  看護記録
                  @elseif($record -> type ==3)
                  介護記録
                  @endif
                </p>
              </div>
              <div class="right">
                <p class="category">{{$record -> name}}
                  @if(session('role_id') == 1 || session('role_id') == 2 || session('user') == $record -> name)
                  <a class="for-delete" href="{{ route('delete',['id'=>$record->id]) }}">
                    <input type="image"  class="icon" alt="gomi" src=".\img\gomi.png" onclick="return confirm('削除しますか？')">
                  </a>
                  @endif
                </p>
              </div>
            </div>
            <p class="title line">　{{$record -> detail}}</p>
            <br>
          </div>
        </li>
      </ul>
      @endforeach
      <div class="pageing"></div>
    </div>
  </div>
  <div class="to_login_link">
    <a href="{{url('/index')}}">一覧画面へ戻る</a>
  </div>
</div>
</div>
@endsection
