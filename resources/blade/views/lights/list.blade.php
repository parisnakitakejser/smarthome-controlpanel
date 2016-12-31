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
      <tr>
        <td><img src="/images/philips-hue/{{$light['hardware']['icon']}}" class="img-responsive" /></td>
        <td>{{$light['title']}}</td>
        <td>{{$light['hardware']['brand']}} {{$light['hardware']['modelid']}}</td>
        <td>{{$light['room']['title']}}</td>
        <td style="text-align: right;">{{$light['updated_at']}}</td>
        <td style="text-align: center;"><i class="fa fa-2x fa-toggle-{{($light['state_on'] ? 'on text-success' : 'off text-danger')}}" aria-hidden="true"></i></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
