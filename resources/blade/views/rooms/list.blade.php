@extends('layout')
@section('placeholder')

<h1 class="display-1 hidden-xs-down">Rooms</h1>
<hr />
<a href="/rooms/create" class="btn btn-success" data-toggle="modal" data-target="#modalDialog">
  Create a room
</a>

<br />
<br />

<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Title</th>
        <th style="width: 70px;">&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      @foreach($rooms AS $room)
      <tr>
        <td><a href="/rooms/view/{{$room['id']}}">{{$room['title']}}</a></td>
        <td style="text-align: right;">
          <button class="btn btn-danger btn-sm" onclick="alert('Function not ready - sorry')">
            <i class="fa fa-trash-o"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
