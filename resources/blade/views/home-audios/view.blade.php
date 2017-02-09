@extends('layout')
@section('placeholder')

<h1 class="display-1 hidden-xs-down"><span class="device-title">{{$home_audio['device']['title']}}</span></h1>
<hr />

<div class="row">
  <div class="col-md-6">
    <h3>{{_('Settings')}}</h3>

    <div class="form-group">
      <label>{{_('Title')}}</label>
      <input type="text" class="form-control" value="{{$home_audio['device']['title']}}" onblur="$.home_audios.push.control_action('title',this.value)">
    </div>

    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td>{{_('Power')}}</td>
          <td style="text-align: right;">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-sm btn-success @if($home_audio['control']['power'] == 1) active @endif" onclick="$.home_audios.push.control_action('power','1')">
                <input type="radio" name="radio_power" value="on" autocomplete="off" @if($home_audio['control']['power'] == 1) checked @endif> On
              </label>
              <label class="btn btn-sm btn-success @if($home_audio['control']['power'] == 0) active @endif" onclick="$.home_audios.push.control_action('power','0')">
                <input type="radio" name="radio_power" value="off" autocomplete="off" @if($home_audio['control']['power'] == 0) checked @endif> Off
              </label>
            </div>
          </td>
        </tr>
        <tr>
          <td>{{_('Mute')}}</td>
          <td style="text-align: right;">
            <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-sm btn-success @if($home_audio['control']['mute'] == 1) active @endif" onclick="$.home_audios.push.control_action('mute','1')">
                <input type="radio" name="options" id="option1" autocomplete="off" @if($home_audio['control']['mute'] == 1) checked @endif> On
              </label>
              <label class="btn btn-sm btn-success @if($home_audio['control']['mute'] == 0) active @endif" onclick="$.home_audios.push.control_action('mute','0')">
                <input type="radio" name="options" id="option2" autocomplete="off" @if($home_audio['control']['mute'] == 0) checked @endif> Off
              </label>
            </div>
          </td>
        </tr>
        <tr>
          <td>{{_('Volume')}}</td>
          <td style="text-align: right;">
            <input id="speaker-volume" data-slider-id='ex1Slider' style="display: none;" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="{{$home_audio['control']['volume']}}" />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
    <h3>{{_('Device')}}</h3>

    <div class="form-group">
      <label>{{_('Brand')}}</label>
      <input type="text" disabled class="form-control" value="{{$home_audio['device']['brand']}}">
    </div>

    <div class="form-group">
      <label>{{_('Model')}}</label>
      <input type="text" disabled class="form-control" value="{{$home_audio['device']['model']}}">
    </div>

    <div class="form-group">
      <label>{{_('Software version')}}</label>
      <input type="text" disabled class="form-control" value="{{$home_audio['device']['software_version']}}">
    </div>

    <div class="form-group">
      <label>{{_('Hardware version')}}</label>
      <input type="text" disabled class="form-control" value="{{$home_audio['device']['hardware_version']}}">
    </div>

    <div class="form-group">
      <label>{{_('Uniqueid')}}</label>
      <input type="text" disabled class="form-control" value="{{$home_audio['device']['uniqueid']}}">
    </div>

    <h3>{{_('Network')}}</h3>

    <div class="form-group">
      <label>{{_('IP address')}}</label>
      <input type="text" disabled class="form-control" value="{{$home_audio['network']['ip']}}">
    </div>

    <div class="form-group">
      <label>{{_('Mac address')}}</label>
      <input type="text" disabled class="form-control" value="{{$home_audio['network']['mac_address']}}">
    </div>

  </div>
</div>

<input type="hidden" id="tmp-device-id" value="{{$home_audio['id']}}" />
@endsection

@section('lazyload')
<script>
$('#speaker-volume').slider({
	formatter: function(value) {
		return '{{_('Volume')}}: ' + value;
	}
}).change(function(event) {
  $.home_audios.push.control_action('volume',event.value.newValue)
});
</script>
@endsection
