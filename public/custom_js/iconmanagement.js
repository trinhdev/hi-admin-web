"use strict";

$(document).ready(function () {
    if ($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    }

    if ($('#is-new-show').is(':checked')) {
        $('#is-new-icon-show-date-time').show();
    }
    else {
        $('#is-new-icon-show-date-time').hide();
    }

    $('#show_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        }
    });

    $('#show_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        }
    });

    $('#new_from').datetimepicker({
        format: "YYYY-MM-DD HH:mm:SS",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        }
    });

    $('#new_to').datetimepicker({
        format: "YYYY-MM-DD HH:mm:SS",
        useCurrent: false,
        sideBySide: true,
        icons: {
            time: 'fas fa-clock',
            date: 'fas fa-calendar',
            up: 'fas fa-arrow-up',
            down: 'fas fa-arrow-down',
            previous: 'fas fa-arrow-left',
            next: 'fas fa-arrow-right',
            today: 'fas fa-calendar-day',
            clear: 'fas fa-trash',
            close: 'fas fa-window-close'
        }
    });
});

$("#show_from").on("dp.change", function (e) {
    if ($('#show_to').data("DateTimePicker") != undefined) {
        $('#show_to').data("DateTimePicker").minDate(e.date);
    }
});

$("#show_to").on("dp.change", function (e) {
    if ($('#show_from').data("DateTimePicker") != undefined) {
        $('#show_from').data("DateTimePicker").maxDate(e.date);
    }
});

$("#new_from").on("dp.change", function (e) {
    if ($('#new_to').data("DateTimePicker") != undefined) {
        $('#new_to').data("DateTimePicker").minDate(e.date);
    }
});

$("#new_to").on("dp.change", function (e) {
    if ($('#new_from').data("DateTimePicker") != undefined) {
        $('#new_from').data("DateTimePicker").maxDate(e.date);
    }
});

$('input:radio[name="isDisplay"]').change(() => {
    if ($('#status-clock').is(':checked')) {
        $('#status-clock-date-time').show();
    }
    else {
        $('#status-clock-date-time').hide();
    }
});

$('input:checkbox[name="isNew"]').change(() => {
    if ($('#is-new-show').is(':checked')) {
        $('#is-new-icon-show-date-time').show();
    }
    else {
        $('#is-new-icon-show-date-time').hide();
    }
});

