<template>
    <div class="container">
    <!--begin::Toolbar-->
        <form>
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-start" data-kt-user-table-toolbar="base">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1" style="margin-right: 10px">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text" v-model="phone" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="OTP Lookup">
                    </div>
                    <!--end::Search-->
                    <!--begin::Filter-->
                    <button type="button" @click="submitGetOTPByPhone()" class="btn btn-primary me-3 my-1" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->

                    <!--end::Svg Icon-->Search</button>

                </div>
                <!--end::Toolbar-->
                <div v-if="error" :class="[isError ? alertDangerClass : 'alert-success', alertClass]">
                    {{ error }}
                </div>
            </div>
        </form>
        <hr>

        <div class="card-header">
            <!--begin::Heading-->
            <div class="card-title">
                <h3>List OTP</h3>
            </div>
            <!--end::Heading-->

        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-0">
            <!--begin::Table wrapper-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                    <!--begin::Thead-->
                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <th class="min-w-250px">OTP</th>
                            <th class="min-w-250px">Reset OTP</th>
                            <th class="min-w-250px">Number Phone</th>
                            <th class="min-w-250px">Status</th>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fw-6 fw-bold text-gray-600">
                        <tr v-if="otp != ''">
                            <td>
                                {{ otp }}
                            </td>
                            <td>
                                <button v-if="otp" @click="resetOTP(phone)" class="btn btn-primary">Reset</button>
                                <span v-else class="badge badge-light-success fs-7 fw-bolder">Reseted</span>
                            </td>
                            <td>{{ phone }}</td>
                            <td><span class="badge badge-light-success fs-7 fw-bolder">active</span></td>
                        </tr>
                        <tr v-else>
                            Chưa có OTP để nào hiển thị
                        </tr>
                    </tbody>
                    <!--end::Tbody-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table wrapper-->
        </div>
    </div>
</template>

<script>
    export default {
        name:"check-otp-component",
        data() {
            return {
                phone:"",
                otp:"",
                error: null,
                alertClass: 'alert',
                alertDangerClass:'alert-danger',
                isError: false,
            }
        },
        mounted() {
            console.log("Mount thanh cong")
        },
        methods: {
            submitGetOTPByPhone(){
                axios.post('/user/check-otp',{"phone": this.phone})
                .then((res)=>{
                    if(res.data.statusCode == 0){
                        this.otp = res.data.data
                        this.error = res.data.message
                        this.isError = false
                    }
                    else{
                        this.error = res.data.message
                        this.isError = true
                    }
                })
            },
            resetOTP(phone){
                 axios.post('/user/reset-otp',{"phone": this.phone})
                .then((res)=>{
                    if(res.data.statusCode == 0){
                        this.otp = "____"
                        this.isError = false

                    }
                    else{
                        this.isError = true
                        this.error = res.data.message
                    }
                })
            }
        }
    }
</script>
