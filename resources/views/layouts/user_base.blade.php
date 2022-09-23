<!DOCTYPE html>
@php
if (empty(session('user'))) {
  header("Location:login");
  exit;
}
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/png" href=".\img\caresup_logo.png">
  <title>@yield('title')</title>
  <link rel="stylesheet" type="text/css" href=".\css\base.css">
  <link rel="stylesheet" type="text/css" href=".\css\top_page.css">
  <link rel="stylesheet" type="text/css" href=".\css\view.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" defer></script>
  <script src="../js/page.js"></script>
</head>
@include('layouts.user_header')
<!--↑ここにヘッダーの記述が入る-->

@yield('main')
<!--↑コンテンツページで@section('main')~@endsectionで範囲を指定する-->

@include('layouts.footer')
<!--↑ここにフッターの記述が入る-->
