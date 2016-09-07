$(function() {
    "use strict";
    $('body').on('change', '*[data-remote-radio-change] input[type="radio"]', function() {
        var $this = $(this);
        var param_holder = $this.closest('*[data-remote-radio-change]');
        var label = $this.siblings('label[for="' + $this.attr('id') + '"]');
        var spinner = param_holder.data('spinner');
        if (spinner) {
            label.addClass('anim_flash');
        }
        $.post(param_holder.data('url'), {
            value: $this.val()
        }).fail(function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 403) {
                alert("Zaloguj się aby ustawiać ważność i decyzję.");
            } else {
                alert("Błąd. Spróbuj ponownie za chwilę. Zalogowałeś się?");
            }
        }).always(function() {
            if (spinner) {
                label.removeClass('anim_flash');
            }
        });
    });
});