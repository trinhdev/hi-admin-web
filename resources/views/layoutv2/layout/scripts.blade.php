<script type="text/javascript" id="vendor-js" src="{{ asset('assets/builds/vendor-admin.js')}}"></script>
<script type="text/javascript" id="jquery-migrate-js" src="{{ asset('assets/plugins/jquery/jquery-migrate.min.js')}}"></script>
<script type="text/javascript" id="datatables-js" src="{{ asset('assets/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" id="moment-js" src="{{ asset('assets/builds/moment.min.js')}}"></script>
<script type="text/javascript" id="bootstrap-select-js" src="{{ asset('assets/builds/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" id="tinymce-js" src="{{ asset('assets/plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript" id="jquery-validation-js" src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script type="text/javascript" id="jquery-validation-lang-js" src="{{ asset('assets/plugins/jquery-validation/localization/messages_vi.min.js')}}"></script>
<script type="text/javascript" id="google-js" src="https://apis.google.com/js/api.js?onload=onGoogleApiLoad" defer></script>
<script type="text/javascript" id="common-js" src="{{ asset('assets/builds/common.js')}}"></script>
<script type="text/javascript" id="app-js" src="{{ asset('assets/js/main.min.js')}}"></script>
<script type="text/javascript" id="fullcalendar-js" src="{{ asset('assets/plugins/fullcalendar/lib/main.min.js')}}"></script>
<script type="text/javascript" id="fullcalendar-lang-js" src="{{ asset('assets/plugins/fullcalendar/lib/locales/vi.js')}}"></script>
<script type="text/javascript" id="translations-js" src="{{ asset('modules/translations/assets/translations.js')}}"></script>
<script>

    function custom_fields_hyperlink() {
        var cf_hyperlink = $('body').find('.cf-hyperlink');
        if (cf_hyperlink.length) {
            $.each(cf_hyperlink, function() {
                var cfh_wrapper = $(this);
                if (!cfh_wrapper.hasClass('cfh-initialized')) {
                    var cfh_field_to = cfh_wrapper.attr('data-fieldto');
                    var cfh_field_id = cfh_wrapper.attr('data-field-id');
                    var textEl = $('body').find('#custom_fields_' + cfh_field_to + '_' + cfh_field_id + '_popover');
                    var hiddenField = $("#custom_fields\\\[" + cfh_field_to + "\\\]\\\[" + cfh_field_id + "\\\]");
                    var cfh_value = cfh_wrapper.attr('data-value');
                    hiddenField.val(cfh_value);

                    if ($(hiddenField.val()).html() != '') {
                        textEl.html($(hiddenField.val()).html());
                    }
                    var cfh_field_name = cfh_wrapper.attr('data-field-name');

                    textEl.popover({
                        html: true,
                        trigger: "manual",
                        placement: "top",
                        title: cfh_field_name,
                        content: function() {
                            return $(cfh_popover_templates[cfh_field_id]).html();
                        }
                    }).on("click", function(e) {
                        var $popup = $(this);
                        $popup.popover("toggle");
                        var titleField = $("#custom_fields_" + cfh_field_to + "_" + cfh_field_id +
                            "_title");
                        var urlField = $("#custom_fields_" + cfh_field_to + "_" + cfh_field_id + "_link");
                        var ttl = $(hiddenField.val()).html();
                        var cfUrl = $(hiddenField.val()).attr("href");
                        if (cfUrl) {
                            $('#cf_hyperlink_open_' + cfh_field_id).attr('href', (cfUrl.indexOf('://') === -
                                1 ? 'http://' + cfUrl : cfUrl));
                        }
                        titleField.val(ttl);
                        urlField.val(cfUrl);
                        $("#custom_fields_" + cfh_field_to + "_" + cfh_field_id + "_btn-save").click(
                            function() {
                                hiddenField.val((urlField.val() != '' ? '<a href="' + urlField.val() +
                                    '" target="_blank">' + (titleField.val() != "" ? titleField
                                        .val() : urlField.val()) + '</a>' : ''));
                                textEl.html(titleField.val() !== "" ? titleField.val() : (urlField
                                    .val() != '' ? urlField.val() :
                                    "cf_translate_input_link_tip"));
                                $popup.popover("toggle");
                            });
                        $("#custom_fields_" + cfh_field_to + "_" + cfh_field_id + "_btn-cancel").click(
                            function() {
                                if (urlField.val() == '') {
                                    hiddenField.val('');
                                }
                                $popup.popover("toggle");
                            });
                    });
                    cfh_wrapper.addClass('cfh-initialized')
                }
            });
        }
    }
</script>
<script>
    // $(function(){
    //     if(typeof("system_popup") != undefined) {
    //         var popupData = {};
    //         popupData.message = '123';
    //         system_popup(popupData);
    //     }
    // });
    // $(function(){
    //     alert_float("' . $alertclass . '","' . $alert_message . '");
    // });
</script>

