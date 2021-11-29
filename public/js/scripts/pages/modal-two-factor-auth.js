$(document).ready(function() {

    const app = new Vue({
        el: '#twoFactorAuthAppsModal',
        data: {

            status: null, // true, false
            message: '',
            currentFormType: '',
            isLoader:false,
            one_time_password:'',
            google2fa_secret:'',
        },
        mounted: function() {
            console.log("google2faFormOn mounted");
            this.onLoad();

        },
        methods: {
           
            onLoad() {
                $((function() {
                    var t = new bootstrap.Modal(document.getElementById("twoFactorAuthModal")),
                        o = new bootstrap.Modal(document.getElementById("twoFactorAuthAppsModal"));
                       // n = new bootstrap.Modal(document.getElementById("twoFactorAuthSmsModal"));
                    document.getElementById("nextStepAuth").onclick = function() {
                        "apps-auth" === document.querySelector("input[name=twoFactorAuthRadio]:checked").value ? (t.hide(), o.show()) : (t.hide())
                    };
                
                }));
            },
            google2faFormOnSubmit(e){
                this.currentFormType = 'google2faForm';
                e.preventDefault();
                var _that = this;
                if(!_that.one_time_password){
                    return false
                }
                _that.isLoader = true;

                var loginFormData = $("#google2faForm").serializeArray();
                var ajaxUrl = $('#google2faForm').attr('action');
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
                        toastr.success(res.message, "Success!", {
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
                        toastr.error(err.responseJSON.message, "Error!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                            rtl: "rtl" === $("html").attr("data-textdirection")
                        })
                        _that.message = err.responseJSON.message;
                    }
                    // console.log('err', err.responseJSON.message);
                    
                });
            }
        }
    });
});
