$.lights = {
  push: {
    control_action: function(id, method, value) {
      console.log('method: '+ method +' | value: '+ value );

      $('#dialogToolbar').ajax_callback('/lights/handler/control-action', {
        'method' : method,
        'value' : value,
        'id' : id,
      }, {
        alertToolbar: true,
        callback_success: function(data) {
          console.log('control action');
        }
      });
    }
  }
}
