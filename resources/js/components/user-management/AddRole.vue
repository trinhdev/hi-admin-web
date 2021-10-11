<template>
    <!--begin::Modal - Add role-->
    <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-750px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Add a Role</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-lg-5 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_add_role_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px" style="max-height: 630px;">
                            <!--begin::Input group-->
                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bolder form-label mb-2">
                                    <span class="required">Role name</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name" v-model="rolegroup.group_name">
                                <!--end::Input-->
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <!--end::Input group-->
                            <!--begin::Permissions-->
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bolder form-label mb-2">Role Permissions</label>
                                <!--end::Label-->
                                <!--begin::Table wrapper-->
                                <div class="row">
                                    <div class="mt-4 col-lg-12" v-for="(service,index) in rolegroup.data" :key="index">
                                        <div class="col-lg-2 mt-2">
                                            <span class="text-gray-800" style="font-weight:bolder;">{{ service.service_name}}</span>
                                        </div>

                                        <div class="col-lg-10 mt-2 d-flex" v-for="(permission, index_p) in service.permissions" :key="index_p">
                                            <!--begin::Text-->
                                            <div class="col-lg-2">
                                                <label class="">
                                                    <i class="form-check-label">{{ permission.permission_name}}</i>
                                                </label>
                                            </div>
                                            
                                            <!--end::Text-->
                                            <div class="col-lg-12 d-flex" style="margin-left:3rem">
                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" type="checkbox" @change="updateValueRole(index, index_p,'READ')" name="role_read">
                                                    <span class="form-check-label">Read</span>
                                                </label>
                                                <!--end::Checkbox-->

                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" type="checkbox" @change="updateValueRole(index, index_p,'UPDATE')" name="role_update">
                                                    <span class="form-check-label">Update</span>
                                                </label>
                                                <!--end::Checkbox-->

                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" type="checkbox" @change="updateValueRole(index, index_p,'CREATE')" name="role_create">
                                                    <span class="form-check-label">Create</span>
                                                </label>
                                                <!--end::Checkbox-->

                                                <!--begin::Checkbox-->
                                                <label class="form-check form-check-custom form-check-solid">
                                                    <input  class="form-check-input" type="checkbox" @change="updateValueRole(index, index_p,'DEL')" name="role_del">
                                                    <span class="form-check-label">Delete</span>
                                                </label>
                                                <!--end::Checkbox-->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
                            <button type="button" class="btn btn-primary" @click="submitAddRole" data-kt-roles-modal-action="submit">
                                <span class="indicator-label ">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    <div></div></form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Add role-->
</template>

<script>
export default {
    name:"add-role",
    data(){
        return {
            rolegroup:{
                "group_name":"",
                "data":[]
            }
        }
    },
    created(){
        axios.get('/admin/role-list')
        .then((val)=>{
            if(val.data.statusCode == 0){
                this.rolegroup.data = val.data.data
                console.log(this.rolegroup)
            }
        })
    },
    methods:{
        submitAddRole(){
            axios.post('/admin/role-group-add',this.rolegroup)
            .then((res)=>{
                if(res.data.statusCode == 0){
                    this.$router.go()
                }
            })
        },
        updateValueRole(index,permission,role){
            switch(role){
                case "CREATE":
                    if(this.rolegroup.data[index].permissions[permission].permission_create == 1){
                        delete this.rolegroup.data[index].permissions[permission].permission_create
                    } 
                    else{
                        this.rolegroup.data[index].permissions[permission].permission_create = 1
                    }
                    break;
                case "READ":
                    if(this.rolegroup.data[index].permissions[permission].permission_read == 1){
                        delete this.rolegroup.data[index].permissions[permission].permission_read
                    } 
                    else{
                        this.rolegroup.data[index].permissions[permission].permission_read = 1
                    }
                    break;
                case "UPDATE":
                    if(this.rolegroup.data[index].permissions[permission].permission_update == 1){
                        delete this.rolegroup.data[index].permissions[permission].permission_update
                    } 
                    else{
                        this.rolegroup.data[index].permissions[permission].permission_update = 1
                    }
                    break;
                case "DEL":
                    if(this.rolegroup.data[index].permissions[permission].permission_del == 1){
                        delete this.rolegroup.data[index].permissions[permission].permission_del
                    } 
                    else{
                        this.rolegroup.data[index].permissions[permission].permission_del = 1
                    }
                    break;
                default:
                    break;
            }
        }
    }
}
</script>