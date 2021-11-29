$(document).ready(function() {
    const app = new Vue({
        el: '#ApiKeyPage',
        data: {

            status: null, // true, false
            message: '',
            currentFormType: 'createApiForm',
            isLoader:false,
            email:'',
        },
        mounted: function() {
            console.log("key mounted");
            this.onLoad();
        },
        methods: {
           
            onLoad() {
                var t = $("#createApiForm");
                t.length && t.validate({
                    rules: {
                        apiKeyName: {
                            required: !0
                        }
                    }
                })
            },
           createApi(e){
                this.currentFormType = 'createApiForm';
                e.preventDefault();
                var _that = this;
                _that.isLoader = true;
                console.log("hello");
                var formData = $("#createApiForm").serializeArray();
                var ajaxUrl = $('#createApiForm').attr('action');
                _that.message = '';
                _that.status = null;
                var createRequest = $.ajax({
                    method: "POST",
                    url: ajaxUrl,
                    data: formData
                });
                createRequest.done(function (res) {
                    // console.log('res', res.redirect_url);
                    _that.isLoader = false;
                    _that.status = res.status;
                    if(_that.status == true){
                        toastr.success("Access Key Created Successfully", "Success!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                            rtl: "rtl" === $("html").attr("data-textdirection")
                        })
                        setTimeout((function() {
                            window.location = res.redirect_url;
                           
                        }), 1000)
                        
                    }
                });
                createRequest.fail(function (err) {
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
           removeApi(e){
                this.currentFormType = 'removeApikeyForm';
                e.preventDefault();
                var _that = this;
                _that.isLoader = true;
                var formData = $("#removeApikeyForm").serializeArray();
                var ajaxUrl = $('#removeApikeyForm').attr('action');
                _that.message = '';
                _that.status = null;
                var removeRequest = $.ajax({
                    method: "POST",
                    url: ajaxUrl,
                    data: formData
                });
                removeRequest.done(function (res) {
                    // console.log('res', res.redirect_url);
                    _that.isLoader = false;
                    _that.status = res.status;
                    if(_that.status == true){
                        toastr.success("Access Key Removed Successfully", "Success!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                            rtl: "rtl" === $("html").attr("data-textdirection")
                        })
                        setTimeout((function() {
                            window.location = res.redirect_url;
                           
                        }), 1000)
                        
                    }
                });
                removeRequest.fail(function (err) {
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
