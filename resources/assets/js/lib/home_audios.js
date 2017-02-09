$.home_audios = {
  push: {
    mute_device: function(id) {
      $('#mute-'+ id).html('').append(
        $(document.createElement('i'))
        .addClass('fa fa-spinner fa-2x fa-spin')
      );

      $('#dialogToolbar').ajax_callback('/home-audios/handler/mute-device', {
        'id' : id,
      }, {
        alertToolbar: true,
        callback_success: function(data) {
          location.reload();
        }
      });
    },

    turn_on_device: function(id) {
      $('#power-'+ id).html('').append(
        $(document.createElement('i'))
        .addClass('fa fa-spinner fa-2x fa-spin')
      );

      $('#dialogToolbar').ajax_callback('/home-audios/handler/turn-on-device', {
        'id' : id,
      }, {
        alertToolbar: true,
        callback_success: function(data) {
          console.log('trying to turn off this device');
        }
      });
    },

    control_action: function(method, value) {
      console.log('method: '+ method +' | value: '+ value );

      $('#dialogToolbar').ajax_callback('/home-audios/handler/control-action', {
        'method' : method,
        'value' : value,
        'id' : $('#tmp-device-id').val(),
      }, {
        alertToolbar: true,
        callback_success: function(data) {
          console.log('control action');
        }
      });
    }
  }
};
