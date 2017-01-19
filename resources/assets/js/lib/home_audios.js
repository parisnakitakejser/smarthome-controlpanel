$.home_audios = {
  push: {
    mute_device: function(id) {
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
      $('#dialogToolbar').ajax_callback('/home-audios/handler/turn-on-device', {
        'id' : id,
      }, {
        alertToolbar: true,
        callback_success: function(data) {
          console.log('trying to turn off this device');
        }
      });
    }
  }
};
