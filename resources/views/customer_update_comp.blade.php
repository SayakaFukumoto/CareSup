@extends('layouts.user_base')
@section('title','変更完了')
@section('main')
<div class="main-wrapper">
  <div class="content-box">
    <h1>  入居者情報変更</h1>
    <div class="input-box">
      <p>入居者情報の更新が完了しました。</p>
    </div>
    <div class="more-link input-width">
      <a href="{{url('top')}}">TOPへ戻る</a>
    </div>
  </div>
</div>
@endsection
