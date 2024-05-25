@extends('layouts.main')
@section('content')
  <style>
    .my-custom-scrollbar {
      position: relative;
      height: 350px;
      overflow: auto;
    }

    .table-wrapper-scroll-y {
      display: block;
    }
  </style>
  <div class="content__header content__boxed overlapping">
    <div class="content__wrap">
      <h1 class="page-title mb-2">Dashboard</h1>
      <h2 class="h5">Hai {{ Auth::user()->name }}</h2>
    </div>
  </div>

  <div class="content__boxed">
    <div class="content__wrap">
      <div class="row">
        <div class="col-xl-3">
          <div class="row">
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
