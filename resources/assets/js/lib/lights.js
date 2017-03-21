$.lights = {
  tmp: {
    standby_id: '',
    standby_enable: 0,
    standby_value: '',
  },
  pull: {
    get_all: function() {
      $('#dialogToolbar').ajax_callback('/lights/get-all', {}, {
        alertToolbar: true,
        callback_success: function(data) {
          if($.lights.tmp.standby_enable == 0) {
            $('#contentList').empty();
          }

          $.each(data.content, function(inx, val) {
            if($.lights.tmp.standby_enable == 1) {
              if(val.id == $.lights.tmp.standby_id) {
                if($.lights.tmp.standby_value == val.state_on) {
                  $.lights.tmp.standby_enable = 0;
                  $.lights.tmp.standby_id = '';
                  $.lights.tmp.standby_value = '';
                }

                return false;
              }
            } else {
              if(val.reachable == 0) {
                var light_action_icons = $(document.createElement('i'))
                .addClass('fa fa-2x fa-exclamation text-warning');
              } else {
                var light_action_icons = $(document.createElement('i'))
                .attr({
                  'id' : val.id,
                  'style' : 'cursor: pointer;',
                  'onclick' : '$.lights.push.control_action(\''+ val.id +'\',\'on\',\''+ (val.state_on == 1 ? '0' : '1') +'\')'
                })
                .addClass('fa fa-2x fa-toggle-'+ (val.state_on == 1 ? 'on text-success' : 'off text-danger' ));
              }

              $(document.createElement('tr'))
              .attr({
                'style' : (val.reachable == 0 ? ' opacity: 0.25;' : '')
              })
              .append(
                $(document.createElement('td'))
                .append(
                  $(document.createElement('img'))
                  .attr({
                    'src' : '/images/philips-hue/'+ val.hardware.icon
                  })
                  .addClass('img-responsive')
                )
              )
              .append(
                $(document.createElement('td'))
                .append(
                  $(document.createElement('a'))
                  .attr({
                    'href' : 'light/'+ val.id
                  })
                  .html(val.title)
                )
              )
              .append(
                $(document.createElement('td'))
                .html(val.hardware.brand +' '+ val.hardware.modelid)
              )
              .append(
                $(document.createElement('td'))
                .html(val.room.title)
              )
              .append(
                $(document.createElement('td'))
                .addClass('text-right')
                .html(val.updated_at)
              )
              .append(
                $(document.createElement('td'))
                .attr({
                  'style' : 'text-align: center;'
                })
                .append(light_action_icons)
              )
              .appendTo('#contentList');
            }
          })
        }
      });
    }
  },
  push: {
    control_action: function(id, method, value) {
      $.lights.tmp.standby_value = value;
      $.lights.tmp.standby_id = id;
      $.lights.tmp.standby_enable = 1;

      $('#dialogToolbar').ajax_callback('/lights/handler/control-action', {
        'method' : method,
        'value' : value,
        'id' : id,
      }, {
        alertToolbar: true,
        callback_success: function(data) {
          $('#'+ id).removeAttr('class').addClass('fa fa-circle-o-notch fa-spin');
        }
      });
    }
  }
}


$(document).bind('pull-lights-pull-get_all:ready',function() {
  $.lights.pull.get_all();

  setInterval(function(){
    $.lights.pull.get_all();
  }, 1000);

});
