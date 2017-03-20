@extends('layout')
@section('placeholder')

<h1 class="display-1 hidden-xs-down">Lights</h1>
<hr />

<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th style="width: 50px;">&nbsp;</th>
        <th>Title</th>
        <th>Brand & Model</th>
        <th>Room</th>
        <th style="width: 220px;">Accessed</th>
        <th style="width: 60px;">On/Off</th>
      </tr>
    </thead>
    <tbody id="contentList"></tbody>
  </table>
</div>
@endsection

@section('lazyload')
<script>
$(document).triggerHandler('pull-lights-pull-get_all:ready');
</script>
@endsection
