<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="company_logo" class="control-label">Logo công ty</label>
            <input type="file" name="company_logo" class="form-control" value="" data-toggle="tooltip" title="" data-original-title="Kích thước khuyến nghị: 150 x 34px">
        </div>
        <hr>
        <div class="form-group">
            <label for="company_logo_dark" class="control-label">Company Logo Dark</label>
            <input type="file" name="company_logo_dark" class="form-control" value="" data-toggle="tooltip" title="" data-original-title="Kích thước khuyến nghị: 150 x 34px">
        </div>
        <hr>
        <div class="form-group favicon_upload">
            <label for="favicon" class="control-label">Favicon</label>
            <input type="file" name="favicon" class="form-control">
        </div>
        <hr>
        <div class="form-group" app-field-wrapper="settings[companyname]"><label for="settings[companyname]" class="control-label">Tên công ty</label><input type="text" id="settings[companyname]" name="settings[companyname]" class="form-control" value="TrinhDev.net"></div>		<hr>
        <div class="form-group" app-field-wrapper="settings[main_domain]"><label for="settings[main_domain]" class="control-label">Tên miền chính của công ty</label><input type="text" id="settings[main_domain]" name="settings[main_domain]" class="form-control" value="TrinhDev.net"></div>		<hr>
        <div class="form-group">
            <label for="rtl_support_admin" class="control-label clearfix">
                Khu vực admin RTL (Phải sang Trái)    </label>
            <div class="radio radio-primary radio-inline">
                <input type="radio" id="y_opt_1_settings_rtl_support_admin" name="settings[rtl_support_admin]" value="1">
                <label for="y_opt_1_settings_rtl_support_admin">
                    Có        </label>
            </div>
            <div class="radio radio-primary radio-inline">
                <input type="radio" id="y_opt_2_settings_rtl_support_admin" name="settings[rtl_support_admin]" value="0" checked="">
                <label for="y_opt_2_settings_rtl_support_admin">
                    Không        </label>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label for="rtl_support_client" class="control-label clearfix">
                Khu vực khách hàng RTL (Phải sang Trái)    </label>
            <div class="radio radio-primary radio-inline">
                <input type="radio" id="y_opt_1_settings_rtl_support_client" name="settings[rtl_support_client]" value="1">
                <label for="y_opt_1_settings_rtl_support_client">
                    Có        </label>
            </div>
            <div class="radio radio-primary radio-inline">
                <input type="radio" id="y_opt_2_settings_rtl_support_client" name="settings[rtl_support_client]" value="0" checked="">
                <label for="y_opt_2_settings_rtl_support_client">
                    Không        </label>
            </div>
        </div>
        <hr>
        <div class="form-group" app-field-wrapper="settings[allowed_files]"><label for="settings[allowed_files]" class="control-label">Các dạng tập tin cho phép</label><input type="text" id="settings[allowed_files]" name="settings[allowed_files]" class="form-control" value=".png,.jpg,.pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.txt"></div>	</div>
</div>
