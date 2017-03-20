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
    <tbody>
      @foreach($lights AS $light)
      <tr style="@if($light['reachable'] == 0) opacity: 0.25; @endif">
        <td><img src="/images/philips-hue/{{$light['hardware']['icon']}}" class="img-responsive" /></td>
        <td>{{$light['title']}}</td>
        <td>{{$light['hardware']['brand']}} {{$light['hardware']['modelid']}}</td>
        <td>{{$light['room']['title']}}</td>
        <td style="text-align: right;">{{$light['updated_at']}}</td>
        <td style="text-align: center;">
          @if($light['reachable'] == 0)
            <i class="fa fa-2x fa-exclamation text-warning"></i>
          @else
            <i class="fa fa-2x fa-toggle-{{($light['state_on'] ? 'on text-success' : 'off text-danger')}}" aria-hidden="true"></i>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
