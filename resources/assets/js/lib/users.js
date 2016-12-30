$.users = {
  push: {
    login: function() {
      var login_btn_html = $('#login-btn').html();
      var login_btn_onclick = $('#login-btn').attr('onclick');

      $('#login-btn').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i> ' + login_btn_html).removeAttr('onclick').addClass('disabled');

      $('#dialogToolbar').ajax_callback('/users/login', {
        'username' : $('#username').val(),
        'password' : $('#password').val(),
      }, {
        alertToolbar: true,
        callback_success: function(data) {
          //
        },
        callback_error: function(data) {
          $('#login-btn').html(login_btn_html).attr({'onclick': login_btn_onclick}).removeClass('disabled');
        }
      });
    }
  }
};
