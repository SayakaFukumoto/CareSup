<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/png" href=".\img\caresup_logo.png">
  <title>PDF</title>
  <link rel="stylesheet" type="text/css" href=".\css\base.css">
  <link rel="stylesheet" type="text/css" href=".\css\top_page.css">
  <link rel="stylesheet" type="text/css" href=".\css\view.css">
  <style>
  @font-face{
    font-family: migmix;
    font-style: normal;
    font-weight: normal;
    src: url("{{ storage_path('fonts/migmix-2m-regular.ttf')}}") format('truetype');
  }
  @font-face{
    font-family: migmix;
    font-style: bold;
    font-weight: bold;
    src: url("{{ storage_path('fonts/migmix-2m-bold.ttf')}}") format('truetype');
  }
  @page{
    margin-top: -100px;
  }
  body {
    font-family: migmix;
    line-height: 80%;
  }

  .border{
    border: solid 1px;
    padding:10px;
    margin:10px 0;
  }

  .under{
    border-bottom: solid 1px;
    padding-bottom: 5px;
  }

  .right{
    display: flex;
    justify-content: space-between;
  }

  .date{
    text-align: right;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" defer></script>
  <script src="../js/page.js"></script>
</head>
<div class="">
  <p class="date">{{$date}}　現在</p>
  <div class="">
    <h1>入居者詳細</h1>
    <div class="">
      <h3>【部屋番号】　　　{{$customer -> room_number}}号室</h3>
      <h3>【氏名】　　{{$customer -> name}}様</h3>
      <h3>【性別】　　
        @if($customer -> gender ==0)
        男性
        @else
        女性
        @endif
      </h3>
      <h3>【生年月日】　　　{{$customer -> birth}}</h3>
      <div class="border">
        <h3 class="box-title">【既往歴】</h3>
        <p>{{$customer -> medical_history}}</p>
      </div>
    </div>
  </div>
  <div class="border">
    <h3  class="box-title">【人物】</h3>
    <p>{{$customer -> personality}}</p>
  </div>
  <div class="border">
    <h3  class="box-title">【記録】</h3>
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
                <p class="category">{{$record -> name}}</p>
              </div>
            </div>
            <p class="title under">　{{$record -> detail}}</p>
            <br>
          </div>
        </li>
      </ul>
      @endforeach
    </div>
  </div>
</div>
