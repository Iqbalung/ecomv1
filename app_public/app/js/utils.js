$(window).load(function() {
  unmask_body();
})

$(document).ready(function() {
  $('#place_notif').delegate('.alert', 'click', function() {
    $(this).removeClass('warning_blink');
  });

  $('#passwordbaru2').on('keyup', function() {
    var password = $('#passwordbaru');
    var password2 = $('#passwordbaru2');

    if (password2.val() != password.val() || password2.val() == '') {
      password2.css('border-color', '#F15B4F');
      $('#ubahPassword #button-ubah').attr('disabled', 'disabled');
    } else {
      password2.css('border-color', '#d2d6de');
      $('#ubahPassword #button-ubah').removeAttr('disabled');
    }
  });

  $('#passwordbaru').on('keyup', function() {
    var password = $('#passwordbaru');
    var password2 = $('#passwordbaru2');

    if (password2.val() != password.val() || password.val() == '') {
      password2.css('border-color', '#F15B4F');
      $('#ubahPassword #button-ubah').attr('disabled', 'disabled');
    } else {
      password2.css('border-color', '#d2d6de');
      $('#ubahPassword #button-ubah').removeAttr('disabled');
    }
  });

  $('#ubah-password').click(function() {
    var password2 = $('#passwordbaru2');
    password2.css('border-color', '#d2d6de');
    $('#ubahPassword #button-ubah').attr('disabled', 'disabled');
    $('#ubahPassword :password').val('');
    $('#ubahPassword').modal({
      keyboard: false,
      backdrop: 'static'
    });
  });

  $('#ubahPassword #button-ubah').click(function() {
    var url = app.site_url + '/master/user/ubahPass';
    var form = $('#form-ubah-password').serializeArray();
    var params = convert(form);
    var kosong = false;

    $('#form-ubah-password').find(':password').each(function(index, el) {
      if ($(this).val() == '') {
        $(this).css('border-color', '#F15B4F');

        kosong = true;
      } else {
        $(this).css('border-color', '#d2d6de');
      }

    });

    if (kosong == true) {
      $('#warning').modal({
        keyboard: false,
        backdrop: 'static'
      });

      return;
    }

    mask_body();
    $.ajax({
        method: "POST",
        url: url,
        data: params
      })
      .done(function(data) {
        unmask_body();
        var obj = jQuery.parseJSON(data);
        if (obj.success == true) {
          $('#ubahPassword').modal('hide');
        } else {
          $('#notif .modal-body').html(obj.msg);
          $('#notif').modal({
            keyboard: false,
            backdrop: 'static'
          });
        }
      })
  });

  convert = function(param) {
    var out = {};
    for (var i = 0; i < param.length; i++) {
      out[param[i].name] = param[i].value;
    }

    return out;
  }
});