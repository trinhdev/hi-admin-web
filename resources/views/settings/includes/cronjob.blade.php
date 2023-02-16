<div class="col-md-9">
    <h4 class="tw-font-semibold tw-mt-0 tw-text-neutral-800">
        Email chu kì/Cron Job </h4>
    <div class="panel_s">
        <div class="panel-body">
            <div class="horizontal-scrollable-tabs panel-full-width-tabs">
                <div class="scroller arrow-left" style="display: none;"><i class="fa fa-angle-left"></i></div>
                <div class="scroller arrow-right" style="display: none;"><i class="fa fa-angle-right"></i></div>
                <div class="horizontal-tabs">
                    <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                        <li role="presentation" class="">
                            <a href="#cron_command" aria-controls="cron_command" role="tab" data-toggle="tab"
                               aria-expanded="false">Command</a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#set_invoice" aria-controls="set_invoice" role="tab" data-toggle="tab"
                               aria-expanded="true">Payment unpaid</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#estimates" aria-controls="estimates" role="tab" data-toggle="tab"
                               aria-expanded="false">VSML week</a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#proposals" aria-controls="proposals" role="tab" data-toggle="tab"
                               aria-expanded="false">Health check</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content mtop15">
                <div role="tabpanel" class="tab-pane" id="cron_command">
                    <div class="alert alert-info tw-mb-0">
                        <div class="wrapper-content pd-all-20">

                        <pre tabindex="0"><code class="border-none"># ┌───────────── minute (0 - 59)
# │ ┌───────────── hour (0 - 23)
# │ │ ┌───────────── day of the month (1 - 31)
# │ │ │ ┌───────────── month (1 - 12)
# │ │ │ │ ┌───────────── day of the week (0 - 6) (Sunday to Saturday;
# │ │ │ │ │                                   7 is also Sunday on some systems)
# │ │ │ │ │                                   OR sun, mon, tue, wed, thu, fri, sat
# │ │ │ │ │
# * * * * *     >>>     input = * * * * * (run every a minutes)
</code></pre>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Miêu
                                                tả</font></font></th>
                                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Tương
                                                đương với</font></font></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                                mỗi năm một lần vào nửa đêm ngày 1 tháng 1</font></font></td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0
                                                0 1
                                                1 *</font></font></td>
                                </tr>
                                <tr>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                                mỗi tháng một lần vào nửa đêm của ngày đầu tiên của tháng</font></font>
                                    </td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0
                                                0 1
                                                * *</font></font></td>
                                </tr>
                                <tr>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                                mỗi tuần một lần vào lúc nửa đêm vào sáng Chủ Nhật</font></font></td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0
                                                0 *
                                                * 0</font></font></td>
                                </tr>
                                <tr>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                                một lần một ngày vào lúc nửa đêm</font></font></td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0
                                                0 *
                                                * *</font></font></td>
                                </tr>
                                <tr>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Chạy
                                                mỗi giờ một lần vào đầu giờ</font></font></td>
                                    <td><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">0
                                                * *
                                                * *</font></font></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="help-ts">
                                <i class="fa fa-info-circle"></i>
                                <span>Kiểm tra biểu thức cronjob <a class="text-primary" target="_blank"
                                                                    href="https://crontab.guru/#*_*_*_*_*">ở đây</a></span>
                            </div>

                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane active" id="set_invoice">
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="Được dùng cho hóa đơn định kỳ, thông báo quá hạn v.v..."></i>
                    <div class="form-group" app-field-wrapper="settings[invoice_auto_operations_hour]"><label
                            for="settings[invoice_auto_operations_hour]" class="control-label">Số giờ thực hiện thao tác
                            tự động mỗi ngày</label><input type="number" id="settings[invoice_auto_operations_hour]"
                                                           name="settings[invoice_auto_operations_hour]"
                                                           class="form-control" data-toggle="tooltip"
                                                           data-title="Định dạng thời gian 24 tiếng, ví dụ: 9 cho 9 giờ sáng và 15 cho 3 giờ chiều."
                                                           max="23" value="21" data-original-title="" title=""></div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mbot font-medium">Overdue Notices</h4>
                            <p>Overdue notices are sent when the invoice becomes overdue.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"
                                 app-field-wrapper="settings[automatically_send_invoice_overdue_reminder_after]"><label
                                    for="settings[automatically_send_invoice_overdue_reminder_after]"
                                    class="control-label">Tự động gửi nhắc nhở sau (ngày)</label><input type="number"
                                                                                                        id="settings[automatically_send_invoice_overdue_reminder_after]"
                                                                                                        name="settings[automatically_send_invoice_overdue_reminder_after]"
                                                                                                        class="form-control"
                                                                                                        value="1"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"
                                 app-field-wrapper="settings[automatically_resend_invoice_overdue_reminder_after]">
                                <label for="settings[automatically_resend_invoice_overdue_reminder_after]"
                                       class="control-label">Tự động gửi lại nhắc nhở sau (ngày)</label><input
                                    type="number" id="settings[automatically_resend_invoice_overdue_reminder_after]"
                                    name="settings[automatically_resend_invoice_overdue_reminder_after]"
                                    class="form-control" value="3"></div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="no-mbot font-medium">Due Reminders</h4>
                            <p>Due reminders are sent to unpaid and partially paid invoices as reminder to the customer
                                to pay the invoice before is due.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" app-field-wrapper="settings[invoice_due_notice_before]"><label
                                    for="settings[invoice_due_notice_before]" class="control-label">Send due reminder X
                                    days before due date</label><input type="number"
                                                                       id="settings[invoice_due_notice_before]"
                                                                       name="settings[invoice_due_notice_before]"
                                                                       class="form-control" value="2"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" app-field-wrapper="settings[invoice_due_notice_resend_after]"><label
                                    for="settings[invoice_due_notice_resend_after]" class="control-label">Tự động gửi
                                    lại nhắc nhở sau (ngày)</label><input type="number"
                                                                          id="settings[invoice_due_notice_resend_after]"
                                                                          name="settings[invoice_due_notice_resend_after]"
                                                                          class="form-control" value="0"></div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="mbot20 font-medium">Các hóa đơn gửi định kỳ</h4>
                    <div class="radio radio-info">
                        <input type="radio" id="generate_and_send" name="settings[new_recurring_invoice_action]"
                               value="generate_and_send" checked="">
                        <label for="generate_and_send">Generate and Autosend the renewed invoice to the customer</label>
                    </div>
                    <div class="radio radio-info">
                        <input type="radio" id="generate_unpaid_invoice" name="settings[new_recurring_invoice_action]"
                               value="generate_unpaid">
                        <label for="generate_unpaid_invoice">Generate a Unpaid Invoice</label>
                    </div>
                    <div class="radio radio-info">
                        <input type="radio" id="generate_draft_invoice" name="settings[new_recurring_invoice_action]"
                               value="generate_draft">
                        <label for="generate_draft_invoice">Generate a Draft Invoice</label>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="create_invoice_from_recurring_only_on_paid_invoices" class="control-label clearfix">
                            <i class="fa-regular fa-circle-question" data-toggle="tooltip"
                               data-title="Nếu mục này được đặt là CÓ và các hóa đơn định kỳ không mang trạng thái ĐÃ THANH TOÁN, thì hóa đơn mới sẽ KHÔNG được tạo."></i>
                            Chỉ tạo hóa đơn mới từ hóa đơn định kỳ khi hóa đơn mang trạng thái đã thanh toán? </label>
                        <div class="radio radio-primary radio-inline">
                            <input type="radio"
                                   id="y_opt_1_invoices_create_invoice_from_recurring_only_on_paid_invoices"
                                   name="settings[create_invoice_from_recurring_only_on_paid_invoices]" value="1">
                            <label for="y_opt_1_invoices_create_invoice_from_recurring_only_on_paid_invoices">
                                Có </label>
                        </div>
                        <div class="radio radio-primary radio-inline">
                            <input type="radio"
                                   id="y_opt_2_invoices_create_invoice_from_recurring_only_on_paid_invoices"
                                   name="settings[create_invoice_from_recurring_only_on_paid_invoices]" value="0"
                                   checked="">
                            <label for="y_opt_2_invoices_create_invoice_from_recurring_only_on_paid_invoices">
                                Không </label>
                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane" id="tasks">
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="24 hours format eq. 9 for 9am or 15 for 3pm. It is used for recurring Task, Task reminders etc."></i>
                    <div class="form-group" app-field-wrapper="settings[tasks_reminder_notification_hour]"><label
                            for="settings[tasks_reminder_notification_hour]" class="control-label">Số giờ thực hiện thao
                            tác tự động mỗi ngày</label><input type="number"
                                                               id="settings[tasks_reminder_notification_hour]"
                                                               name="settings[tasks_reminder_notification_hour]"
                                                               class="form-control" data-toggle="tooltip"
                                                               data-title="Định dạng thời gian 24 tiếng, ví dụ: 9 cho 9 giờ sáng và 15 cho 3 giờ chiều."
                                                               max="23" value="21" data-original-title="" title="">
                    </div>
                    <hr>
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="Thông báo hạn chót cho người đảm nhiệm phân công trước X ngày. Thông báo/thư chỉ được gửi cho duy nhất người đảm nhiệm. Nếu khoảng cách giữa ngày bắt đầu và ngày chốt nhỏ hơn nhắc nhở thì hệ thống sẽ không gửi thông báo."></i>
                    <div class="form-group" app-field-wrapper="settings[tasks_reminder_notification_before]"><label
                            for="settings[tasks_reminder_notification_before]" class="control-label">Nhắc nhở hết hạn
                            phân công trong (ngày) nữa</label><input type="number"
                                                                     id="settings[tasks_reminder_notification_before]"
                                                                     name="settings[tasks_reminder_notification_before]"
                                                                     class="form-control" value="2"></div>
                    <div class="form-group" app-field-wrapper="settings[automatically_stop_task_timer_after_hours]">
                        <label for="settings[automatically_stop_task_timer_after_hours]" class="control-label">automatically_stop_task_timer_after_hours</label><input
                            type="number" id="settings[automatically_stop_task_timer_after_hours]"
                            name="settings[automatically_stop_task_timer_after_hours]" class="form-control" value="8">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="reminder_for_completed_but_not_billed_tasks" class="control-label clearfix">
                            Send an email reminder of billable tasks completed but not billed </label>
                        <div class="radio radio-primary radio-inline">
                            <input type="radio" id="y_opt_1_send_reminder_for_completed_but_not_billed_tasks"
                                   name="settings[reminder_for_completed_but_not_billed_tasks]" value="1">
                            <label for="y_opt_1_send_reminder_for_completed_but_not_billed_tasks">
                                Có </label>
                        </div>
                        <div class="radio radio-primary radio-inline">
                            <input type="radio" id="y_opt_2_send_reminder_for_completed_but_not_billed_tasks"
                                   name="settings[reminder_for_completed_but_not_billed_tasks]" value="0" checked="">
                            <label for="y_opt_2_send_reminder_for_completed_but_not_billed_tasks">
                                Không </label>
                        </div>
                    </div>
                    <div class="staff_notify_completed_but_not_billed_tasks_fields hide">
                        <div class="form-group"
                             app-field-wrapper="settings[staff_notify_completed_but_not_billed_tasks][]"><label
                                for="settings[staff_notify_completed_but_not_billed_tasks][]" class="control-label">Select
                                which staff members you want to receive the reminder</label>
                            <div class="dropdown bootstrap-select show-tick bs3" style="width: 100%;"><select
                                    id="settings[staff_notify_completed_but_not_billed_tasks][]"
                                    name="settings[staff_notify_completed_but_not_billed_tasks][]" class="selectpicker"
                                    multiple="1" data-width="100%" data-none-selected-text="Không có mục nào được chọn"
                                    data-live-search="true" tabindex="-98">
                                    <option value="1" selected="">Huỳnh Trình</option>
                                </select>
                                <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown"
                                        role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox"
                                        aria-expanded="false"
                                        data-id="settings[staff_notify_completed_but_not_billed_tasks][]"
                                        title="Huỳnh Trình">
                                    <div class="filter-option">
                                        <div class="filter-option-inner">
                                            <div class="filter-option-inner-inner">Huỳnh Trình</div>
                                        </div>
                                    </div>
                                    <span class="bs-caret"><span class="caret"></span></span></button>
                                <div class="dropdown-menu open">
                                    <div class="bs-searchbox"><input type="search" class="form-control"
                                                                     autocomplete="off" role="combobox"
                                                                     aria-label="Search" aria-controls="bs-select-1"
                                                                     aria-autocomplete="list"></div>
                                    <div class="inner open" role="listbox" id="bs-select-1" tabindex="-1"
                                         aria-multiselectable="true">
                                        <ul class="dropdown-menu inner " role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"
                             app-field-wrapper="settings[reminder_for_completed_but_not_billed_tasks_days][]"><label
                                for="settings[reminder_for_completed_but_not_billed_tasks_days][]"
                                class="control-label">Select days of the week reminder should be sent</label>
                            <div class="dropdown bootstrap-select show-tick bs3" style="width: 100%;"><select
                                    id="settings[reminder_for_completed_but_not_billed_tasks_days][]"
                                    name="settings[reminder_for_completed_but_not_billed_tasks_days][]"
                                    class="selectpicker" multiple="1" 0="data" data-width="100%"
                                    data-none-selected-text="Không có mục nào được chọn" data-live-search="true"
                                    tabindex="-98">
                                    <option value="Monday" selected="">Thứ hai</option>
                                    <option value="Tuesday">Thứ ba</option>
                                    <option value="Wednesday">Thứ tư</option>
                                    <option value="Thursday">Thứ năm</option>
                                    <option value="Friday">Thứ sáu</option>
                                    <option value="Saturday">Thứ bảy</option>
                                    <option value="Sunday">Chủ nhật</option>
                                </select>
                                <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown"
                                        role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox"
                                        aria-expanded="false"
                                        data-id="settings[reminder_for_completed_but_not_billed_tasks_days][]"
                                        title="Thứ hai">
                                    <div class="filter-option">
                                        <div class="filter-option-inner">
                                            <div class="filter-option-inner-inner">Thứ hai</div>
                                        </div>
                                    </div>
                                    <span class="bs-caret"><span class="caret"></span></span></button>
                                <div class="dropdown-menu open">
                                    <div class="bs-searchbox"><input type="search" class="form-control"
                                                                     autocomplete="off" role="combobox"
                                                                     aria-label="Search" aria-controls="bs-select-2"
                                                                     aria-autocomplete="list"></div>
                                    <div class="inner open" role="listbox" id="bs-select-2" tabindex="-1"
                                         aria-multiselectable="true">
                                        <ul class="dropdown-menu inner " role="presentation"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="contracts">
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="Định dạng thời gian 24 tiếng, ví dụ: 9 cho 9 giờ sáng và 15 cho 3 giờ chiều."></i>
                    <div class="form-group" app-field-wrapper="settings[contracts_auto_operations_hour]"><label
                            for="settings[contracts_auto_operations_hour]" class="control-label">Số giờ thực hiện thao
                            tác tự động mỗi ngày</label><input type="number"
                                                               id="settings[contracts_auto_operations_hour]"
                                                               name="settings[contracts_auto_operations_hour]"
                                                               class="form-control" max="23" value="21"></div>
                    <hr>
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="Thông báo hết thời hạn hợp đồng trong ngày"></i>
                    <div class="form-group" app-field-wrapper="settings[contract_expiration_before]"><label
                            for="settings[contract_expiration_before]" class="control-label">Gửi nhắc nhở hết hạn trước
                            (ngày)</label><input type="number" id="settings[contract_expiration_before]"
                                                 name="settings[contract_expiration_before]" class="form-control"
                                                 value="4"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="tickets">
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="Đặt 0 để vô hiệu hóa"></i>
                    <div class="form-group" app-field-wrapper="settings[autoclose_tickets_after]"><label
                            for="settings[autoclose_tickets_after]" class="control-label">Tự động khóa yêu cầu hỗ trợ
                            sau (tiếng)</label><input type="number" id="settings[autoclose_tickets_after]"
                                                      name="settings[autoclose_tickets_after]" class="form-control"
                                                      value="0"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="estimates">
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="Định dạng thời gian 24 tiếng, ví dụ: 9 cho 9 giờ sáng và 15 cho 3 giờ chiều."></i>
                    <div class="form-group" app-field-wrapper="settings[estimates_auto_operations_hour]"><label
                            for="settings[estimates_auto_operations_hour]" class="control-label">Số giờ thực hiện thao
                            tác tự động mỗi ngày</label><input type="number"
                                                               id="settings[estimates_auto_operations_hour]"
                                                               name="settings[estimates_auto_operations_hour]"
                                                               class="form-control" max="23" value="21"></div>
                    <hr>
                    <div class="form-group" app-field-wrapper="settings[send_estimate_expiry_reminder_before]"><label
                            for="settings[send_estimate_expiry_reminder_before]" class="control-label">Gửi nhắc nhở hết
                            hạn trước (ngày)</label><input type="number"
                                                           id="settings[send_estimate_expiry_reminder_before]"
                                                           name="settings[send_estimate_expiry_reminder_before]"
                                                           class="form-control" value="4"></div>
                </div>
                <div role="tabpanel" class="tab-pane" id="proposals">
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="Định dạng thời gian 24 tiếng, ví dụ: 9 cho 9 giờ sáng và 15 cho 3 giờ chiều."></i>
                    <div class="form-group" app-field-wrapper="settings[proposals_auto_operations_hour]"><label
                            for="settings[proposals_auto_operations_hour]" class="control-label">Số giờ thực hiện thao
                            tác tự động mỗi ngày</label><input type="number"
                                                               id="settings[proposals_auto_operations_hour]"
                                                               name="settings[proposals_auto_operations_hour]"
                                                               class="form-control" max="23" value="21"></div>
                    <hr>

                    <div class="form-group" app-field-wrapper="settings[send_proposal_expiry_reminder_before]"><label
                            for="settings[send_proposal_expiry_reminder_before]" class="control-label">Gửi nhắc nhở hết
                            hạn trước (ngày)</label><input type="number"
                                                           id="settings[send_proposal_expiry_reminder_before]"
                                                           name="settings[send_proposal_expiry_reminder_before]"
                                                           class="form-control" value="4"></div>
                </div>

                <div role="tablpanel" class="tab-pane" id="expenses">
                    <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip"
                       data-title="Định dạng thời gian 24 tiếng, ví dụ: 9 cho 9 giờ sáng và 15 cho 3 giờ chiều."></i>
                    <div class="form-group" app-field-wrapper="settings[expenses_auto_operations_hour]"><label
                            for="settings[expenses_auto_operations_hour]" class="control-label">Số giờ thực hiện thao
                            tác tự động mỗi ngày</label><input type="number"
                                                               id="settings[expenses_auto_operations_hour]"
                                                               name="settings[expenses_auto_operations_hour]"
                                                               class="form-control" max="23" value="21"></div>
                </div>

            </div>
        </div>
    </div>
</div>
