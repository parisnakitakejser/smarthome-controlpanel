$.rooms = {
  push: {
    create: function() {
      $('#dialogToolbar').ajax_callback('/rooms/create', {
        'room_title' : $('#room-title').val(),
      }, {
        alertToolbar: true,
        callback_success: function(data) {
          location.href = '/rooms/view/'+ data.id
        }
      });
    }
  }
};
