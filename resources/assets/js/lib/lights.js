$.lights = {
  push: {
    control_action: function(id, method, value) {
      $('#dialogToolbar').ajax_callback('/lights/handler/control-action', {
        'method' : method,
        'value' : value,
        'id' : id,
      }, {
        alertToolbar: true
      });
    }
  }
}
