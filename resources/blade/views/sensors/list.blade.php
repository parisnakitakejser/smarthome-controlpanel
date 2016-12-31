@extends('layout')
@section('placeholder')

<h1 class="display-1 hidden-xs-down">Sensors</h1>
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
        <th style="width: 60px;">Battery</th>
      </tr>
    </thead>
    <tbody>
      @foreach($sensors AS $sensor)
      <tr>
        <td>@if ($sensor['hardware']['icon'] != '') <img src="/images/philips-hue/{{$sensor['hardware']['icon']}}" class="img-responsive" /> @endif</td>
        <td>{{$sensor['title']}}</td>
        <td>{{$sensor['hardware']['brand']}} {{$sensor['hardware']['modelid']}}</td>
        <td>{{$sensor['room']['title']}}</td>
        <td style="text-align: right;">{{$sensor['updated_at']}}</td>
        <td style="text-align: center;">
          <i class="fa fa-{{$sensor['battery']['icon']}} {{$sensor['battery']['class']}}" title="{{$sensor['battery']['procent']}}%" data-toggle="tooltip"></i>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
