@extends('layout')
@section('placeholder')

<h1 class="display-1 hidden-xs-down">{{$room['title']}}</h1>
<hr />

<h3>Upload your room image</h3>
<form>
  <input type="file" />

  <button type="submit" class="btn btn-sm btn-success">
    Upload a room image
  </button>
</form>

<br />

<code>
  <small>If you upload a new room plan images, all devices will be removed for your old images and you need to drag it over one more time to place all your devices.</small>
</code>

<hr />
<h3>Setup your device in your room</h3>

<div class="row">
  <div class="col-md-9">
    images
  </div>
  <div class="col-md-3">
    not used hardware listed here in groups
  </div>
</div>
@endsection
