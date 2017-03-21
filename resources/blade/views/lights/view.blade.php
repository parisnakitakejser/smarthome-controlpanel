@extends('layout')
@section('placeholder')

<h1 class="display-1 hidden-xs-down">Light</h1>
<hr />

@if($light['state']['reachable'] == false)
  <div class="alert alert-danger">
    <strong>Light not reachable</strong><br />
    This light are not online right now, and you can't control it form the interface.
  </div>

  <a href="/lights">Back to light list</a>
@else

  <div class="row">
    <div class="col-md-6">
      <h3>Light settings</h3>
      <label>Name</label>
      <input type="text" class="form-control" value="{{$light['name']}}" onblur="$.lights.push.control_action('{{$light['_id']}}','name',this.value)" />
    </div>
    <div class="col-md-6">
      &nbsp;
    </div>
  </div>

@endif
@endsection
