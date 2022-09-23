<body>
  <header>
    <div class="header-wrapper">
      <a  href="{{url('/top')}}">
        <img src=".\img\logo.png" alt="logo">
      </a>
      <div class="menu">
        <ul>
          <li class=scroll-location><a href="{{url('record_insert')}}">記録する</a></li>
          <li class=scroll-location><a href="{{url('/top')}}#first">記録を見る</a></li>
          <li><a href="{{url('/index')}}">入居者一覧</a></li>
        </ul>
      </div>
      <div class="login">
        <p>{{ Session::get('user') }}さん<a href="{{url('/logout')}}">ログアウト</a></p>
      </div>
    </div>
  </header>
