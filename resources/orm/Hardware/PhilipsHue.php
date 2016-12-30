<?php
namespace ORM\Hardware;

class PhilipsHue {
  static function getIcon($model) {
    $icons = [
      'BSB001' => 'bridge_v1.svg', // Hue bridge v1
      'BSB002' => 'bridge_v2.svg', // Hue bridge v2

      'LCT001' => 'white_and_color_e27.svg', // Hue color lamp
      'LCT007' => 'white_and_color_e27.svg',
      'LCT010' => 'white_and_color_e27.svg',
      'LCT014' => 'white_and_color_e27.svg',

      'LTW010' => 'white_and_color_e27.svg', // Hue ambience
      'LTW001' => 'white_and_color_e27.svg',
      'LTW004' => 'white_and_color_e27.svg',
      'LTW015' => 'white_and_color_e27.svg',

      'LWB004' => 'white_and_color_e27.svg', // Hue white
      'LWB006' => 'white_and_color_e27.svg',

      'LWB010' => 'white_e27.svg', // Hue white lamp
      'LWB014' => 'white_e27.svg',

      'LCT002' => 'br30.svg', // Hue color downlight
      'LCT011' => 'br30_slim.svg', // Hue color downlight
      'LTW011' => 'br30_slim.svg', // Hue ambience
      'LCT003' => 'gu10.svg', // Hue color spot
      'LTW013' => 'gu10_perfectfit.svg', // Hue ambience spot
      'LST001' => 'lightstrip.svg', // Hue lightstrip
      'LST002' => 'lightstrip.svg', // Hue lightstrip+

      'LLC006' => 'iris.svg', // Hue iris
      'LLC010' => 'iris.svg',

      'LLC005' => 'bloom.svg', // Hue bloom
      'LLC011' => 'bloom.svg',
      'LLC012' => 'bloom.svg',
      'LLC007' => 'bloom.svg',

      'LLC014' => 'aura.svg', // Hue aura

      'LLC013' => 'storylight.svg', // Hue storylight

      'LLC020' => 'go.svg', // Hue go

      'HBL001' => 'beyond_ceiling_pendant_table.svg', // Hue beyond up / down
      'HBL002' => 'beyond_ceiling_pendant_table.svg',
      'HBL003' => 'beyond_ceiling_pendant_table.svg',

      'HIL001' => 'impulse.svg', // Hue impulse up / down
      'HIL002' => 'impulse.svg',

      'HEL001' => 'entity.svg', // Hue entity up / down
      'HEL002' => 'entity.svg',

      'HML001' => 'phoenix_ceiling.svg', // Hue phoenix up / down
      'HML002' => 'phoenix_ceiling.svg',
      'HML003' => 'phoenix_ceiling.svg',
      'HML004' => 'phoenix_ceiling.svg', // Hue phoenix
      'HML005' => 'phoenix_ceiling.svg',

      'HML006' => 'phoenix_down.svg', // Hue phoenix down

      'LTP003' => 'pendant_square.svg', // Hue ambiance pendant
      'LTP002' => 'pendant_round.svg', // Hue ambiance pendant
      'LTD003' => 'pendant_round.svg', // Hue ambiance pendant
      'LTP001' => 'pendant_oval.svg', // Hue ambiance pendant

      'LDF002' => 'ceiling_square.svg', // Hue white wall washer
      'LTF002' => 'ceiling_square.svg', // Hue ambiance ceiling
      'LTF001' => 'ceiling_square.svg',
      'LTC001' => 'ceiling_square.svg',
      'LTC002' => 'ceiling_square.svg',
      'LDF001' => 'ceiling_square.svg', // Hue white ceiling

      'LTC003' => 'ceiling_round.svg', // Hue ambiance ceiling
      'LTD001' => 'ceiling_round.svg',
      'LTD002' => 'ceiling_round.svg',

      'LDD002' => 'floor.svg', // Hue white floor
      'LDD001' => 'table.svg', // Hue white table

      'LDT001' => 'recessed.svg', // Hue ambiance downlight
      'MWM001' => 'recessed.svg', // Hue white 1-10V

      'SWT001' => 'tap.svg', // Hue tap switch
      'RWL021' => 'hds.svg', // Hue dimmer switch
      'SML001' => 'motion_sensor.svg', // Hue motion sensor
    ];


    return (isset($icons[$model]) ? $icons[$model] : false);
  }
}
?>
