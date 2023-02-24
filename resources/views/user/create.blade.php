@extends('layoutv2.layout.app')

@section('content')
    <div id="wrapper" style="min-height: 1405px;">
        <div class="content">
            <div class="row">
                <form action="http://perfex.local/admin/staff/member" class="staff-form dirty" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                    <input type="hidden" name="csrf_token_name" value="4cc717a65960768358a1b772a9a88ccc">
                    <div class="col-md-8 col-md-offset-2" id="small-table">
                        <div class="panel_s">
                            <div class="panel-body">
                                <div class="horizontal-scrollable-tabs panel-full-width-tabs">
                                    <div class="scroller arrow-left" style="display: none;"><i class="fa fa-angle-left"></i></div>
                                    <div class="scroller arrow-right" style="display: none;"><i class="fa fa-angle-right"></i></div>
                                    <div class="horizontal-tabs">
                                        <ul class="nav nav-tabs nav-tabs-horizontal" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#tab_staff_profile" aria-controls="tab_staff_profile" role="tab" data-toggle="tab" aria-expanded="true">
                                                    Tiểu sử                                        </a>
                                            </li>
                                            <li role="presentation" class="">
                                                <a href="#staff_permissions" aria-controls="staff_permissions" role="tab" data-toggle="tab" aria-expanded="false">
                                                    Quyền hạn                                        </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content tw-mt-5">
                                    <div role="tabpanel" class="tab-pane active" id="tab_staff_profile">
                                        <div class="is-not-staff hide">
                                            <div class="checkbox checkbox-primary">
                                                <input type="checkbox" value="1" name="is_not_staff" id="is_not_staff">
                                                <label for="is_not_staff">Không phải nhân viên</label>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="form-group">
                                            <label for="profile_image" class="profile-image">Ảnh đại diện</label>
                                            <input type="file" name="profile_image" class="form-control" id="profile_image">
                                        </div>
                                        <div class="form-group" app-field-wrapper="firstname"><label for="firstname" class="control-label"> <small class="req text-danger">* </small>Tên</label><input type="text" id="firstname" name="firstname" class="form-control" autofocus="1" value=""></div>                                                                <div class="form-group" app-field-wrapper="lastname"><label for="lastname" class="control-label"> <small class="req text-danger">* </small>Họ</label><input type="text" id="lastname" name="lastname" class="form-control" value=""></div>                                                                <div class="form-group" app-field-wrapper="email"><label for="email" class="control-label"> <small class="req text-danger">* </small>Email</label><input type="email" id="email" name="email" class="form-control" autocomplete="off" value=""></div>                                <div class="form-group">
                                            <label for="hourly_rate">Tiền công theo giờ</label>
                                            <div class="input-group">
                                                <input type="number" name="hourly_rate" value="0" id="hourly_rate" class="form-control">
                                                <span class="input-group-addon">
                                            đ                                        </span>
                                            </div>
                                        </div>
                                        <div class="form-group" app-field-wrapper="phonenumber"><label for="phonenumber" class="control-label">Điện thoại</label><input type="text" id="phonenumber" name="phonenumber" class="form-control" value=""></div>                                <div class="form-group">
                                            <label for="facebook" class="control-label"><i class="fa-brands fa-facebook-f"></i>
                                                Facebook</label>
                                            <input type="text" class="form-control" name="facebook" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="linkedin" class="control-label"><i class="fa-brands fa-linkedin-in"></i>
                                                LinkedIn</label>
                                            <input type="text" class="form-control" name="linkedin" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="skype" class="control-label"><i class="fa-brands fa-skype"></i>
                                                Skype</label>
                                            <input type="text" class="form-control" name="skype" value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="default_language" class="control-label">Ngôn ngữ mặc định</label>
                                            <div class="dropdown bootstrap-select form-control bs3"><select name="default_language" data-live-search="true" id="default_language" class="form-control selectpicker" data-none-selected-text="Không có mục nào được chọn" tabindex="-98">
                                                    <option value="">Mặc định hệ thống</option>
                                                    <option value="bulgarian">
                                                        Bulgarian</option>
                                                    <option value="catalan">
                                                        Catalan</option>
                                                    <option value="chinese">
                                                        Chinese</option>
                                                    <option value="czech">
                                                        Czech</option>
                                                    <option value="dutch">
                                                        Dutch</option>
                                                    <option value="english">
                                                        English</option>
                                                    <option value="french">
                                                        French</option>
                                                    <option value="german">
                                                        German</option>
                                                    <option value="greek">
                                                        Greek</option>
                                                    <option value="indonesia">
                                                        Indonesia</option>
                                                    <option value="italian">
                                                        Italian</option>
                                                    <option value="japanese">
                                                        Japanese</option>
                                                    <option value="persian">
                                                        Persian</option>
                                                    <option value="polish">
                                                        Polish</option>
                                                    <option value="portuguese">
                                                        Portuguese</option>
                                                    <option value="portuguese_br">
                                                        Portuguese_br</option>
                                                    <option value="romanian">
                                                        Romanian</option>
                                                    <option value="russian">
                                                        Russian</option>
                                                    <option value="slovak">
                                                        Slovak</option>
                                                    <option value="spanish">
                                                        Spanish</option>
                                                    <option value="swedish">
                                                        Swedish</option>
                                                    <option value="turkish">
                                                        Turkish</option>
                                                    <option value="ukrainian">
                                                        Ukrainian</option>
                                                    <option value="vietnamese">
                                                        Vietnamese</option>
                                                </select><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="combobox" aria-owns="bs-select-1" aria-haspopup="listbox" aria-expanded="false" data-id="default_language" title="Mặc định hệ thống"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Mặc định hệ thống</div></div> </div><span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-1" aria-autocomplete="list"></div><div class="inner open" role="listbox" id="bs-select-1" tabindex="-1"><ul class="dropdown-menu inner " role="presentation"></ul></div></div></div>
                                        </div>
                                        <i class="fa-regular fa-circle-question pull-left tw-mt-0.5 tw-mr-1" data-toggle="tooltip" data-title="Nếu để trống thì sẽ sử dụng chữ ký email mặc định trong tùy chỉnh"></i>
                                        <div class="form-group" app-field-wrapper="email_signature"><label for="email_signature" class="control-label">Chữ kí email</label><textarea id="email_signature" name="email_signature" class="form-control" data-entities-encode="true" rows="4"></textarea></div>                                <div class="form-group">
                                            <label for="direction">Định hướng</label>
                                            <div class="dropdown bootstrap-select bs3" style="width: 100%;"><select class="selectpicker" data-none-selected-text="Mặc định hệ thống" data-width="100%" name="direction" id="direction" tabindex="-98">
                                                    <option value=""></option>
                                                    <option value="ltr">LTR</option>
                                                    <option value="rtl">RTL</option>
                                                </select><button type="button" class="btn dropdown-toggle btn-default bs-placeholder" data-toggle="dropdown" role="combobox" aria-owns="bs-select-2" aria-haspopup="listbox" aria-expanded="false" data-id="direction" title="Mặc định hệ thống"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Mặc định hệ thống</div></div> </div><span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open"><div class="inner open" role="listbox" id="bs-select-2" tabindex="-1"><ul class="dropdown-menu inner " role="presentation"></ul></div></div></div>
                                        </div>
                                        <div class="form-group">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <hr class="hr-10">
                                                <div class="checkbox checkbox-primary">
                                                    <input type="checkbox" name="administrator" id="administrator">
                                                    <label for="administrator">Người quản lý</label>
                                                </div>
                                                <div class="checkbox checkbox-primary">
                                                    <input type="checkbox" name="send_welcome_email" id="send_welcome_email" checked="">
                                                    <label for="send_welcome_email">Gửi thư chào mừng</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- fake fields are a workaround for chrome autofill getting the wrong fields -->
                                        <input type="text" class="fake-autofill-field" name="fakeusernameremembered" value="" tabindex="-1">
                                        <input type="password" class="fake-autofill-field" name="fakepasswordremembered" value="" tabindex="-1">
                                        <div class="clearfix form-group"></div>
                                        <label for="password" class="control-label"> <small class="req text-danger">* </small>Mật khẩu</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control password" name="password" autocomplete="off">
                                            <span class="input-group-addon tw-border-l-0">
                                        <a href="#password" class="show_password" onclick="showPassword('password'); return false;"><i class="fa fa-eye"></i></a>
                                    </span>
                                            <span class="input-group-addon">
                                        <a href="#" class="generate_password" onclick="generatePassword(this);return false;"><i class="fa fa-refresh"></i></a>
                                    </span>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="staff_permissions">
                                        <div class="form-group" app-field-wrapper="role"><label for="role" class="control-label">Vị trí</label><div class="dropdown bootstrap-select bs3" style="width: 100%;"><select id="role" name="role" class="selectpicker" data-width="100%" data-none-selected-text="Không có mục nào được chọn" data-live-search="true" tabindex="-98"><option value=""></option><option value="1" selected="">Employee</option></select><button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="combobox" aria-owns="bs-select-3" aria-haspopup="listbox" aria-expanded="false" data-id="role" title="Employee"><div class="filter-option"><div class="filter-option-inner"><div class="filter-option-inner-inner">Employee</div></div> </div><span class="bs-caret"><span class="caret"></span></span></button><div class="dropdown-menu open"><div class="bs-searchbox"><input type="search" class="form-control" autocomplete="off" role="combobox" aria-label="Search" aria-controls="bs-select-3" aria-autocomplete="list"></div><div class="inner open" role="listbox" id="bs-select-3" tabindex="-1"><ul class="dropdown-menu inner " role="presentation"></ul></div></div></div></div>                                <hr>
                                        <h4 class="font-medium mbot15 bold">Quyền hạn</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered roles no-margin">
                                                <thead>
                                                <tr>
                                                    <th>Feature</th>
                                                    <th>Capabilities</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr data-name="bulk_pdf_exporter">
                                                    <td>
                                                        <b>Xuất tập tin PDF lớn</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="bulk_pdf_exporter_view" name="permissions[bulk_pdf_exporter][]" value="view" disabled="">
                                                            <label for="bulk_pdf_exporter_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="contracts">
                                                    <td>
                                                        <b>Hợp đồng</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" type="checkbox" class="capability" id="contracts_view_own" name="permissions[contracts][]" value="view_own" disabled="">
                                                            <label for="contracts_view_own">
                                                                Xem (riêng)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="contracts_view" name="permissions[contracts][]" value="view" disabled="">
                                                            <label for="contracts_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="contracts_create" name="permissions[contracts][]" value="create" disabled="">
                                                            <label for="contracts_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="contracts_edit" name="permissions[contracts][]" value="edit" disabled="">
                                                            <label for="contracts_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="contracts_delete" name="permissions[contracts][]" value="delete" disabled="">
                                                            <label for="contracts_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="credit_notes">
                                                    <td>
                                                        <b>Credit Notes</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" type="checkbox" class="capability" id="credit_notes_view_own" name="permissions[credit_notes][]" value="view_own" disabled="">
                                                            <label for="credit_notes_view_own">
                                                                Xem (riêng)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="credit_notes_view" name="permissions[credit_notes][]" value="view" disabled="">
                                                            <label for="credit_notes_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="credit_notes_create" name="permissions[credit_notes][]" value="create" disabled="">
                                                            <label for="credit_notes_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="credit_notes_edit" name="permissions[credit_notes][]" value="edit" disabled="">
                                                            <label for="credit_notes_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="credit_notes_delete" name="permissions[credit_notes][]" value="delete" disabled="">
                                                            <label for="credit_notes_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="customers">
                                                    <td>
                                                        <b>Khách hàng</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" data-not-applicable="true" type="checkbox" class="capability" id="customers_view_own" name="permissions[customers][]" value="view_own" disabled="">
                                                            <label for="customers_view_own">
                                                                Xem (riêng)                  </label>
                                                            <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-title="Dựa trên quản trị khách hàng"></i>               </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="customers_view" name="permissions[customers][]" value="view" disabled="">
                                                            <label for="customers_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="customers_create" name="permissions[customers][]" value="create" disabled="">
                                                            <label for="customers_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="customers_edit" name="permissions[customers][]" value="edit" disabled="">
                                                            <label for="customers_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="customers_delete" name="permissions[customers][]" value="delete" disabled="">
                                                            <label for="customers_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="email_templates">
                                                    <td>
                                                        <b>Email mẫu</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="email_templates_view" name="permissions[email_templates][]" value="view" disabled="">
                                                            <label for="email_templates_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="email_templates_edit" name="permissions[email_templates][]" value="edit" disabled="">
                                                            <label for="email_templates_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="estimates">
                                                    <td>
                                                        <b>Báo giá</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" type="checkbox" class="capability" id="estimates_view_own" name="permissions[estimates][]" value="view_own" disabled="">
                                                            <label for="estimates_view_own">
                                                                Xem (riêng)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="estimates_view" name="permissions[estimates][]" value="view" disabled="">
                                                            <label for="estimates_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="estimates_create" name="permissions[estimates][]" value="create" disabled="">
                                                            <label for="estimates_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="estimates_edit" name="permissions[estimates][]" value="edit" disabled="">
                                                            <label for="estimates_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="estimates_delete" name="permissions[estimates][]" value="delete" disabled="">
                                                            <label for="estimates_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="expenses">
                                                    <td>
                                                        <b>Chi phí</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" type="checkbox" class="capability" id="expenses_view_own" name="permissions[expenses][]" value="view_own" disabled="">
                                                            <label for="expenses_view_own">
                                                                Xem (riêng)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="expenses_view" name="permissions[expenses][]" value="view" disabled="">
                                                            <label for="expenses_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="expenses_create" name="permissions[expenses][]" value="create" disabled="">
                                                            <label for="expenses_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="expenses_edit" name="permissions[expenses][]" value="edit" disabled="">
                                                            <label for="expenses_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="expenses_delete" name="permissions[expenses][]" value="delete" disabled="">
                                                            <label for="expenses_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="invoices">
                                                    <td>
                                                        <b>Hóa đơn</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" type="checkbox" class="capability" id="invoices_view_own" name="permissions[invoices][]" value="view_own" disabled="">
                                                            <label for="invoices_view_own">
                                                                Xem (riêng)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="invoices_view" name="permissions[invoices][]" value="view" disabled="">
                                                            <label for="invoices_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="invoices_create" name="permissions[invoices][]" value="create" disabled="">
                                                            <label for="invoices_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="invoices_edit" name="permissions[invoices][]" value="edit" disabled="">
                                                            <label for="invoices_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="invoices_delete" name="permissions[invoices][]" value="delete" disabled="">
                                                            <label for="invoices_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="items">
                                                    <td>
                                                        <b>Sản phẩm</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="items_view" name="permissions[items][]" value="view" disabled="">
                                                            <label for="items_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="items_create" name="permissions[items][]" value="create" disabled="">
                                                            <label for="items_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="items_edit" name="permissions[items][]" value="edit" disabled="">
                                                            <label for="items_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="items_delete" name="permissions[items][]" value="delete" disabled="">
                                                            <label for="items_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="knowledge_base">
                                                    <td>
                                                        <b>Kiến thức chuyên môn</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="knowledge_base_view" name="permissions[knowledge_base][]" value="view" disabled="">
                                                            <label for="knowledge_base_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="knowledge_base_create" name="permissions[knowledge_base][]" value="create" disabled="">
                                                            <label for="knowledge_base_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="knowledge_base_edit" name="permissions[knowledge_base][]" value="edit" disabled="">
                                                            <label for="knowledge_base_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="knowledge_base_delete" name="permissions[knowledge_base][]" value="delete" disabled="">
                                                            <label for="knowledge_base_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="payments">
                                                    <td>
                                                        <b>Thanh toán</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" data-not-applicable="true" type="checkbox" class="capability" id="payments_view_own" name="permissions[payments][]" value="view_own" disabled="">
                                                            <label for="payments_view_own">
                                                                Xem (riêng)                  </label>
                                                            <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-title="Dựa trên quyền hạn XEM (riêng) của hóa đơn"></i>               </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="payments_view" name="permissions[payments][]" value="view" disabled="">
                                                            <label for="payments_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="payments_create" name="permissions[payments][]" value="create" disabled="">
                                                            <label for="payments_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="payments_edit" name="permissions[payments][]" value="edit" disabled="">
                                                            <label for="payments_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="payments_delete" name="permissions[payments][]" value="delete" disabled="">
                                                            <label for="payments_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="projects">
                                                    <td>
                                                        <b>Các dự án</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" data-not-applicable="true" type="checkbox" class="capability" id="projects_view_own" name="permissions[projects][]" value="view_own" disabled="">
                                                            <label for="projects_view_own">
                                                                Xem (riêng)                  </label>
                                                            <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-title="Nếu nhân viên không có thẩm quyền, chức năng XEM (chung) sẽ chỉ hiển thị những dự án mà nhân viên đó được chỉ định làm thành viên."></i>               </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="projects_view" name="permissions[projects][]" value="view" disabled="">
                                                            <label for="projects_view">
                                                                Xem(Chung)                  </label>
                                                            <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-title="Chức năng XEM cho phép nhân viên xem TẤT CẢ dự án. Nếu bạn chỉ muốn họ xem dự án do họ đảm nhiệm (với tư cách thành viên) thì không nên cấp quyền này."></i>               </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="projects_create" name="permissions[projects][]" value="create" disabled="">
                                                            <label for="projects_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="projects_edit" name="permissions[projects][]" value="edit" disabled="">
                                                            <label for="projects_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="projects_delete" name="permissions[projects][]" value="delete" disabled="">
                                                            <label for="projects_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="projects_create_milestones" name="permissions[projects][]" value="create_milestones" disabled="">
                                                            <label for="projects_create_milestones">
                                                                Tạo Bảng chấm công                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="projects_edit_milestones" name="permissions[projects][]" value="edit_milestones" disabled="">
                                                            <label for="projects_edit_milestones">
                                                                Chỉnh sửa các cột mốc                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="projects_delete_milestones" name="permissions[projects][]" value="delete_milestones" disabled="">
                                                            <label for="projects_delete_milestones">
                                                                Xóa cột mốc                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="proposals">
                                                    <td>
                                                        <b>Đề xuất kế hoạch</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" type="checkbox" class="capability" id="proposals_view_own" name="permissions[proposals][]" value="view_own" disabled="">
                                                            <label for="proposals_view_own">
                                                                Xem (riêng)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="proposals_view" name="permissions[proposals][]" value="view" disabled="">
                                                            <label for="proposals_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="proposals_create" name="permissions[proposals][]" value="create" disabled="">
                                                            <label for="proposals_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="proposals_edit" name="permissions[proposals][]" value="edit" disabled="">
                                                            <label for="proposals_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="proposals_delete" name="permissions[proposals][]" value="delete" disabled="">
                                                            <label for="proposals_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="reports">
                                                    <td>
                                                        <b>Reports</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="reports_view" name="permissions[reports][]" value="view" disabled="">
                                                            <label for="reports_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="reports_view-timesheets" name="permissions[reports][]" value="view-timesheets" disabled="">
                                                            <label for="reports_view-timesheets">
                                                                View Timesheets Report                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="roles">
                                                    <td>
                                                        <b>Vị trí nhân viên</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="roles_view" name="permissions[roles][]" value="view" disabled="">
                                                            <label for="roles_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="roles_create" name="permissions[roles][]" value="create" disabled="">
                                                            <label for="roles_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="roles_edit" name="permissions[roles][]" value="edit" disabled="">
                                                            <label for="roles_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="roles_delete" name="permissions[roles][]" value="delete" disabled="">
                                                            <label for="roles_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="settings">
                                                    <td>
                                                        <b>Cài đặt</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="settings_view" name="permissions[settings][]" value="view" disabled="">
                                                            <label for="settings_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="settings_edit" name="permissions[settings][]" value="edit" disabled="">
                                                            <label for="settings_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="staff">
                                                    <td>
                                                        <b>Nhân viên</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="staff_view" name="permissions[staff][]" value="view" disabled="">
                                                            <label for="staff_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="staff_create" name="permissions[staff][]" value="create" disabled="">
                                                            <label for="staff_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="staff_edit" name="permissions[staff][]" value="edit" disabled="">
                                                            <label for="staff_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="staff_delete" name="permissions[staff][]" value="delete" disabled="">
                                                            <label for="staff_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="subscriptions">
                                                    <td>
                                                        <b>Subscriptions</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" type="checkbox" class="capability" id="subscriptions_view_own" name="permissions[subscriptions][]" value="view_own" disabled="">
                                                            <label for="subscriptions_view_own">
                                                                Xem (riêng)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="subscriptions_view" name="permissions[subscriptions][]" value="view" disabled="">
                                                            <label for="subscriptions_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="subscriptions_create" name="permissions[subscriptions][]" value="create" disabled="">
                                                            <label for="subscriptions_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="subscriptions_edit" name="permissions[subscriptions][]" value="edit" disabled="">
                                                            <label for="subscriptions_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="subscriptions_delete" name="permissions[subscriptions][]" value="delete" disabled="">
                                                            <label for="subscriptions_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="tasks">
                                                    <td>
                                                        <b>Phân công</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" data-not-applicable="true" type="checkbox" class="capability" id="tasks_view_own" name="permissions[tasks][]" value="view_own" disabled="">
                                                            <label for="tasks_view_own">
                                                                Xem (riêng)                  </label>
                                                            <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-title="Nếu nhân viên không có thẩm quyền, chức năng XEM (chung) sẽ chỉ hiển thị những phân công mà nhân viên đó được chỉ định làm người theo dõi hoặc đảm nhiệm. Phân công được hiển thị công khai hoặc vào Thiết lập -> Tùy chỉnh -> Phân công -> Chọn CÓ ở mục Cho phép tất cả nhân viên nhìn thấy phân công liên quan đến dự án khi phân công được dẫn liên kết đến dự án."></i>               </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="tasks_view" name="permissions[tasks][]" value="view" disabled="">
                                                            <label for="tasks_view">
                                                                Xem(Chung)                  </label>
                                                            <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-title="Chức năng XEM cho phép nhân viên xem tất cả phân công. Nếu bạn chỉ muốn cho họ xem phân công mà họ được chỉ định hoặc đang theo dõi thì không nên cấp quyền này."></i>               </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="tasks_create" name="permissions[tasks][]" value="create" disabled="">
                                                            <label for="tasks_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="tasks_edit" name="permissions[tasks][]" value="edit" disabled="">
                                                            <label for="tasks_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="tasks_delete" name="permissions[tasks][]" value="delete" disabled="">
                                                            <label for="tasks_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="tasks_edit_timesheet" name="permissions[tasks][]" value="edit_timesheet" disabled="">
                                                            <label for="tasks_edit_timesheet">
                                                                Chỉnh Sửa Bảng Chấm Công (Global)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="tasks_edit_own_timesheet" name="permissions[tasks][]" value="edit_own_timesheet" disabled="">
                                                            <label for="tasks_edit_own_timesheet">
                                                                Chỉnh Sửa Bảng Chấm Công của chính họ                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="tasks_delete_timesheet" name="permissions[tasks][]" value="delete_timesheet" disabled="">
                                                            <label for="tasks_delete_timesheet">
                                                                Xóa Bảng Chấm Công (Global)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="tasks_delete_own_timesheet" name="permissions[tasks][]" value="delete_own_timesheet" disabled="">
                                                            <label for="tasks_delete_own_timesheet">
                                                                Xóa Bảng Chấm Công của chính họ                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="checklist_templates">
                                                    <td>
                                                        <b>Task Checklist Templates</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="checklist_templates_create" name="permissions[checklist_templates][]" value="create" disabled="">
                                                            <label for="checklist_templates_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="checklist_templates_delete" name="permissions[checklist_templates][]" value="delete" disabled="">
                                                            <label for="checklist_templates_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="estimate_request">
                                                    <td>
                                                        <b>Estimate request</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view-own="" type="checkbox" class="capability" id="estimate_request_view_own" name="permissions[estimate_request][]" value="view_own" disabled="">
                                                            <label for="estimate_request_view_own">
                                                                Xem (riêng)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="estimate_request_view" name="permissions[estimate_request][]" value="view" disabled="">
                                                            <label for="estimate_request_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="estimate_request_create" name="permissions[estimate_request][]" value="create" disabled="">
                                                            <label for="estimate_request_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="estimate_request_edit" name="permissions[estimate_request][]" value="edit" disabled="">
                                                            <label for="estimate_request_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="estimate_request_delete" name="permissions[estimate_request][]" value="delete" disabled="">
                                                            <label for="estimate_request_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="leads" class="hide">
                                                    <td>
                                                        <b>Khách tìm năng</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="leads_view" name="permissions[leads][]" value="view" disabled="">
                                                            <label for="leads_view">
                                                                Xem(Chung)                  </label>
                                                            <i class="fa-regular fa-circle-question" data-toggle="tooltip" data-title="If this permission is not checked, a staff member will be only able to view leads to where is assigned, leads created by the staff member and leads that are marked as public"></i>               </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="leads_delete" name="permissions[leads][]" value="delete" disabled="">
                                                            <label for="leads_delete">
                                                                Xóa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr data-name="translations">
                                                    <td>
                                                        <b>Bản dịch</b>
                                                    </td>
                                                    <td>
                                                        <div class="checkbox">
                                                            <input data-can-view="" type="checkbox" class="capability" id="translations_view" name="permissions[translations][]" value="view" disabled="">
                                                            <label for="translations_view">
                                                                Xem(Chung)                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="translations_create" name="permissions[translations][]" value="create" disabled="">
                                                            <label for="translations_create">
                                                                Tạo                  </label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="capability" id="translations_edit" name="permissions[translations][]" value="edit" disabled="">
                                                            <label for="translations_edit">
                                                                Sửa                  </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-bottom-toolbar text-right">
                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                    </div>
                </form>                    </div>
            <div class="btn-bottom-pusher"></div>
        </div>
        <!-- Likes -->
        <div class="modal likes_modal fade" id="modal_post_likes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Những đồng nghiệp thích bài đăng này</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="modal_post_likes_wrapper">

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary load_more_post_likes">Tải thêm</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Likes -->
        <div class="modal likes_modal animated fadeIn" id="modal_post_comment_likes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Những đồng nghiệp thích bình luận này</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div id="modal_comment_likes_wrapper">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-primary load_more_post_comment_likes">Tải thêm</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="event"></div>
        <div id="newsfeed" class="animated fadeIn hide">
        </div>
        <!-- Task modal view -->
        <div class="modal fade task-modal-single" id="task-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content data">

                </div>
            </div>
        </div>

        <!--Add/edit task modal-->
        <div id="_task"></div>

        <!-- Lead Data Add/Edit-->
        <div class="modal fade lead-modal" id="lead-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
            <div class="modal-dialog modal-lg">
                <div class="modal-content data">

                </div>
            </div>
        </div>

        <div id="timers-logout-template-warning" class="hide">
            <h2 class="bold">Phát hiện mục tính thời gian đang chạy!<br>Bạn có chắc chắn muốn đăng xuất mà không dừng chức năng lại??</h2>
            <hr>
            <a href="http://perfex.local/admin/authentication/logout" class="btn btn-danger">Đăng xuất</a>
        </div>

        <!--Lead convert to customer modal-->
        <div id="lead_convert_to_customer"></div>

        <!--Lead reminder modal-->
        <div id="lead_reminder_modal"></div>


        <script type="text/javascript" id="vendor-js" src="http://perfex.local/assets/builds/vendor-admin.js?v=3.0.4"></script>
        <script type="text/javascript" id="jquery-migrate-js" src="http://perfex.local/assets/plugins/jquery/jquery-migrate.min.js?v=3.0.4"></script>
        <script type="text/javascript" id="datatables-js" src="http://perfex.local/assets/plugins/datatables/datatables.min.js?v=3.0.4"></script>
        <script type="text/javascript" id="moment-js" src="http://perfex.local/assets/builds/moment.min.js?v=3.0.4"></script>
        <script type="text/javascript" id="bootstrap-select-js" src="http://perfex.local/assets/builds/bootstrap-select.min.js?v=3.0.4"></script>
        <script type="text/javascript" id="tinymce-js" src="http://perfex.local/assets/plugins/tinymce/tinymce.min.js?v=3.0.4"></script>
        <script type="text/javascript" id="jquery-validation-js" src="http://perfex.local/assets/plugins/jquery-validation/jquery.validate.min.js?v=3.0.4"></script>
        <script type="text/javascript" id="jquery-validation-lang-js" src="http://perfex.local/assets/plugins/jquery-validation/localization/messages_vi.min.js?v=3.0.4"></script>
        <script type="text/javascript" id="google-js" src="https://apis.google.com/js/api.js?onload=onGoogleApiLoad" defer=""></script>
        <script type="text/javascript" id="common-js" src="http://perfex.local/assets/builds/common.js?v=3.0.4"></script>
        <script type="text/javascript" id="app-js" src="http://perfex.local/assets/js/main.min.js?v=3.0.4"></script>
        <script type="text/javascript" id="translations-js" src="http://perfex.local/modules/translations/assets/translations.js?v=1.0.3"></script>
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
                                            "Ấn vào đây để thêm liên kết"));
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
            $(function() {

                $('select[name="role"]').on('change', function() {
                    var roleid = $(this).val();
                    init_roles_permissions(roleid, true);
                });

                $('input[name="administrator"]').on('change', function() {
                    var checked = $(this).prop('checked');
                    var isNotStaffMember = $('.is-not-staff');
                    if (checked == true) {
                        isNotStaffMember.addClass('hide');
                        $('.roles').find('input').prop('disabled', true).prop('checked', false);
                    } else {
                        isNotStaffMember.removeClass('hide');
                        isNotStaffMember.find('input').prop('checked', false);
                        $('.roles').find('.capability').not('[data-not-applicable="true"]').prop('disabled',
                            false)
                    }
                });

                $('#is_not_staff').on('change', function() {
                    var checked = $(this).prop('checked');
                    var row_permission_leads = $('tr[data-name="leads"]');
                    if (checked == true) {
                        row_permission_leads.addClass('hide');
                        row_permission_leads.find('input').prop('checked', false);
                    } else {
                        row_permission_leads.removeClass('hide');
                    }
                });

                init_roles_permissions();

                appValidateForm($('.staff-form'), {
                    firstname: 'required',
                    lastname: 'required',
                    username: 'required',
                    password: {
                        required: {
                            depends: function(element) {
                                return ($('input[name="isedit"]').length == 0) ? true : false
                            }
                        }
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: admin_url + "misc/staff_email_exists",
                            type: 'post',
                            data: {
                                email: function() {
                                    return $('input[name="email"]').val();
                                },
                                memberid: function() {
                                    return $('input[name="memberid"]').val();
                                }
                            }
                        }
                    }
                });
            });
        </script>


    </div>
@endsection
@push('script')
    {{ $dataTable->scripts() }}
@endpush
