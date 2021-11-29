$(document).ready(function() {

    const app = new Vue({
        el: '#global_login',
        data: {

            status: null, // true, false
            message: '',
            currentFormType: '',
            isLoader:false,
            viewpasswordtype:'password',
            email:'',
            password:'',
            authentication_code:''
            //input_type:'password'
        },
        mounted: function() {
            console.log("login mounted");
            this.onLoad();
        },
        methods: {
            switchVisibility() {
                this.viewpasswordtype = this.viewpasswordtype === 'password' ? 'text' : 'password'
            },
            // showpassword(){
            //     this.input_type = this.input_type == 'password' ? 'text':'password';
            // },
            onLoad() {
                var e = $(".auth-login-form");
                e.length && e.validate({
                    rules: {
                        "login-email": {
                            required: !0,
                            email: !0
                        },
                        "login-password": {
                            required: !0
                        }
                    }
                })
            },
            closemodal(){
                this.authentication_code='';
            },
            loginOnSubmit(e){
                this.currentFormType = 'loginForm';
                e.preventDefault();
                var _that = this;
                if(!_that.email || !_that.password){
                    return false
                }
                _that.isLoader = true;

                var loginFormData = $("#loginForm").serializeArray();
                var ajaxUrl = $('#loginForm').attr('action');
                _that.message = '';
		        _that.status = null;
                var loginRequest = $.ajax({
                    method: "POST",
                    url: ajaxUrl,
                    data: loginFormData
                });
                loginRequest.done(function (res) {
                    // console.log('res', res.redirect_url);
                    _that.isLoader = false;
                    _that.status = res.status;
                    if(_that.status == true){
                        toastr.success("You have successfully logged in to SecureEpayments . Now you can start to explore!", "Success!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                            rtl: "rtl" === $("html").attr("data-textdirection")
                        })
                        setTimeout((function() {
                            window.location = res.redirect_url;
                           
                        }), 1000)
                        
                    }
                });
        
                loginRequest.fail(function (err) {
                    _that.isLoader = false;
                    _that.status = err.responseJSON.status;
                    if(_that.status == false){
                        if(err.responseJSON.google_auth_required){
                            //open google 2fa popup
                            var t = new bootstrap.Modal(document.getElementById("verifyTwoFactorAuth"));
                            t.show();
                            toastr.info(err.responseJSON.message, "Info!", {
                                closeButton: !0,
                                tapToDismiss: !1,
                                rtl: "rtl" === $("html").attr("data-textdirection")
                            })
                            _that.message = err.responseJSON.message;
                        }else{
                            toastr.error(err.responseJSON.message, "Error!", {
                                closeButton: !0,
                                tapToDismiss: !1,
                                rtl: "rtl" === $("html").attr("data-textdirection")
                            })
                            _that.message = err.responseJSON.message;
                        }
                        
                    }
                    // console.log('err', err.responseJSON.message);
                    
                });
            }
        }
    });
});
