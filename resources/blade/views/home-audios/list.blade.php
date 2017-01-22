@extends('layout')
@section('placeholder')

<h1 class="display-1 hidden-xs-down">Home Audios</h1>
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
        <th style="width: 60px;">Volume</th>
        <th style="width: 60px;">Mute</th>
        <th style="width: 60px;">On/Off</th>
      </tr>
    </thead>
    <tbody>
      @foreach($home_audios AS $home_audio)
      <tr>
        <td><img src="{{$home_audio['hardware']['icon']}}" style="width: 40px;" /></td>
        <td>{{$home_audio['title']}}</td>
        <td>{{$home_audio['hardware']['brand']}} {{$home_audio['hardware']['modelid']}}</td>
        <td>{{$home_audio['room']['title']}}</td>
        <td style="text-align: right;">{{$home_audio['updated_at']}}</td>
        <td style="text-align: center;">{{$home_audio['volume'] ? $home_audio['volume'] .'%' : '?' }}</td>
        <td style="text-align: center;" id="mute-{{$home_audio['id']}}">
          <i class="fa fa-2x fa-volume-{{($home_audio['mute'] ? 'off text-danger' : 'up text-success')}}" aria-hidden="true" onclick="$.home_audios.push.mute_device('{{$home_audio['id']}}')" style="cursor: pointer;"></i>
        </td>
        <td style="text-align: center;">
          <i class="fa fa-2x fa-toggle-{{($home_audio['state_on'] ? 'on text-success' : 'off text-danger')}}" aria-hidden="true" onclick="$.home_audios.push.turn_on_device('{{$home_audio['id']}}')" style="cursor: pointer;"></i>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
