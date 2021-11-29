
$(document).ready(function() {

    const app = new Vue({
        el: '#global_register',
        data: {

            status: null, // true, false
            message: '',
            currentFormType: '',
            isLoader:false,
            viewpasswordtype:'password',
            viewcpasswordtype:'password',
            name:'',
            email:'',
            password:'',
            password_confirmation:'',
            privacy_policy:''
           
        },
        mounted: function() {
            console.log("Register mounted");
            this.onLoad();
        },
        methods: {
            switchVisibility(type) {
                if(type == 'password'){
                    this.viewpasswordtype = this.viewpasswordtype === 'password' ? 'text' : 'password';
                }else{
                    this.viewcpasswordtype = this.viewcpasswordtype === 'password' ? 'text' : 'password'
                }
            },
            registerOnSubmit(e){
                //console.log("Register call");
                this.currentFormType = 'registerForm';
                e.preventDefault();
                var _that = this;
                if(!_that.name && !_that.email || !_that.password){
                    return false
                }
                console.log("Register call");
                _that.isLoader = true;
                var registerFormData = $("#registerForm").serializeArray();
                var ajaxUrl = $('#registerForm').attr('action');
                _that.message = '';
		        _that.status = null;
                var registerRequest = $.ajax({
                    method: "POST",
                    url: ajaxUrl,
                    data: registerFormData
                });
                registerRequest.done(function (res) {
                    // console.log('res', res.redirect_url);
                    _that.isLoader = false;
                    _that.status = res.status;
                    if(_that.status == true){
                        toastr.success("You have successfully registerd in to SecureEpayments . Now you can start to explore!", "Success!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                            rtl: "rtl" === $("html").attr("data-textdirection")
                        })
                        setTimeout((function() {
                            window.location = res.redirect_url;
                           
                        }), 1000)
                        
                    }
                });
        
                registerRequest.fail(function (err) {
                    _that.isLoader = false;
                    _that.status = err.responseJSON.status;
                    if(_that.status == false){
                        toastr.error(err.responseJSON.message, "Error!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                            rtl: "rtl" === $("html").attr("data-textdirection")
                        })
                        _that.message = err.responseJSON.message;
                        
                    }
                    // console.log('err', err.responseJSON.message);
                    
                });
            },
            onLoad() {
                var e = "../../../app-assets/",
        
                t = $(".auth-register-form");
            
                if ("laravel" === $("body").attr("data-framework") && (e = $("body").attr("data-asset-path")),
                t.length && t.validate({
                        rules: {
                            "name": {
                                required: !0
                            },
                            "email": {
                                required: !0,
                                email: !0
                            },
                            "password": {
                                required: !0,
                                minlength: 8
                            },
                            "password_confirmation": {
                                required: !0,
                                minlength: 8,
                                equalTo: "#password"
                            },
                            "register-privacy-policy": {
                                required: !0,
                            },
                        },
                        messages: {
                            password: {
                                required: "Enter new password",
                                minlength: "Enter at least 8 characters"
                            },
                            "password_confirmation": {
                                required: "Please confirm new password",
                                minlength: "Enter at least 8 characters",
                                equalTo: "The password and its confirm are not the same"
                            }
                        },
                })) ;
            },
           
        }
    });
});
