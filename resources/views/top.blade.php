@extends('layouts.user_base')
@section('title','トップ画面')
@section('main')
<div class="main-wrapper">
  <div class="content">
    <div class="content-box">
      <span class="tape">お知らせ</span>
      @foreach($news as $new)
      <div class="news note">
        <ul>
          <li class="date">{{$new -> created_at}}</li>
          <li><a href="{{ route('news',['id'=>$new->id]) }}">{{$new -> title}}</a></li>
        </ul>
        <div class="right">
          <p>{{$new -> name}}</p>
          @if(session('role_id') == 1 || session('role_id') == 2 )
          <a href="{{ route('news_update',['id'=>$new->id]) }}" ><input type="image"  class="icon" alt="pen" src=".\img\pencil.png"></a>
          <a href="{{ route('delete',['id'=>$new->id]) }}"><input type="image"  class="icon" alt="gomi" src=".\img\gomi.png" onclick="return confirm('削除しますか？')"></a>
          @endif
        </div>
      </div>
      @endforeach
      <div class="pageing">{{$news->links()}}</div>
      <div class="more-link">
        @if(session('role_id') == 1 || session('role_id') == 2 )
        <a class="under" href="{{url('news_insert')}}"><input type="image"  class="icon" alt="ita" src=".\img\insert.png">新規登録</a>
        @endif
      </div>
    </div>
  </div>
  <div class="content">
    <div class="button-wrapper">
      <div class="btn user-btn">
        <a href="{{url('record_insert')}}">記録する<input type="image"  class="btn-image" alt="ita" src=".\img\beige.png"></a>
      </div>
      <div class="btn user-btn">
        <a href="{{url('index')}}">一覧<input type="image"  class="btn-image" alt="ita" src=".\img\people.png"></a>
      </div>
    </div>

    @if(session('role_id') == 1 || session('role_id') == 2 )
    <div class="button-wrapper">
      <div class="btn user-btn admin-btn">
        <a href="{{url('user_register')}}">職員新規登録</a>
      </div>
      <div class="btn user-btn admin-btn">
        <a href="{{url('customer_register')}}">入居者新規登録</a>
      </div>
    </div>
    @endif

  </div>
  <div class="content" id="first">
    <div class="content-box">
      <div class="title">
        <span class="tape">共有事項</span>
      </div>
      <div class="user-news">
        <ul class="news-list">
          @foreach($sharedMatters as $sharedMatter)
          <li class="item">
            <div class="note">
              <div class="news-deta">
                <div class="right">
                  <p class="date">{{$sharedMatter -> created_at}}</p>
                  @if($sharedMatter -> customer == 0)
                  <p class="category"><span>全体</span></p>
                   @else
                   <a href="{{ route('view',['id'=>$sharedMatter -> customer_id ]) }}"><p class="category"><span>{{$sharedMatter -> customer}}様</span></p></a>
                   @endif
                </div>
                <div class="right">
                  <p class="category">{{$sharedMatter -> name}}</p>
                  @if(session('role_id') == 1 || session('role_id') == 2 || session('user') == $sharedMatter -> name)
                  <a href="{{ route('delete',['id'=>$sharedMatter->id]) }}"><input type="image"  class="icon" alt="gomi" src=".\img\gomi.png" onclick="return confirm('削除しますか？')"></a>
                  @endif
                </div>
              </div>
              <p class="title">{{$sharedMatter -> detail}}</p>
              <br>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="pageing">{{$sharedMatters->links()}}</div>
      </div>
    </div>
  </div>
  <div class="content" >
    <div class="content-box">
      <span class="tape">看護記録</span>
      <div class="user-news">
        <ul class="news-list">
          @foreach($nursingRecords as $nursingRecord)
          <li class="item">
            <div class="note">
              <div class="news-deta">
                <div class="right">
                  <p class="date">{{$nursingRecord -> created_at}}</p>
                  <a href="{{ route('view',['id'=>$nursingRecord -> customer_id ]) }}"><p class="category"><span>{{$nursingRecord -> customer}}様</span></p></a>
                </div>
                <div class="right">
                  <p class="category">{{$nursingRecord -> name}}</p>
                  @if(session('role_id') == 1 || session('role_id') == 2 || session('user') == $nursingRecord -> name)
                  <a href="{{ route('delete',['id'=>$sharedMatter->id]) }}"><input type="image"  class="icon" alt="gomi" src=".\img\gomi.png" onclick="return confirm('削除しますか？')"></a>
                  @endif
                </div>
              </div>
              <p class="title">{{$nursingRecord -> detail}}</p>
              <br>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="pageing">{{$nursingRecords->links()}}</div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content-box">
      <span class="tape">介護記録</span>
      <div class="user-news">
        <ul class="news-list">
          @foreach($careRecords as $careRecord)
          <li class="item">
            <div class="note">
              <div class="news-deta">
                <div class="right">
                  <p class="date">{{$careRecord -> created_at}}</p>
                  <a href="{{ route('view',['id'=>$careRecord -> customer_id ]) }}"><p class="category"><span>{{$careRecord -> customer}}様</span></p></a>
                </div>
                <div class="right">
                  <p class="category">{{$careRecord -> name}}</p>
                  @if(session('role_id') == 1 || session('role_id') == 2 || session('user') == $careRecord -> name)
                  <a href="{{ route('delete',['id'=>$careRecord->id]) }}"><input type="image"  class="icon" alt="gomi" src=".\img\gomi.png" onclick="return confirm('削除しますか？')"></a>
                  @endif
                </div>
              </div>
              <p class="title">{{$careRecord -> detail}}</p>
              <br>
            </div>
          </li>
          @endforeach
        </ul>
        <div class="pageing">{{$careRecords->links()}}</div>
      </div>
    </div>
  </div>
</div>
@endsection
