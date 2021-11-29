$(document).ready(function() {
    $( "#target" ).click(function() {
        alert( "Handler for .click() called." );
    });
    const app = new Vue({
        el: '#admin_merchant',
        data: {

            status: null, // true, false
            message: '',
            currentFormType: '',
            isLoader:false,
            viewpasswordtype:'password',
            email:'',
            name:"",
            notification_url:'',
            // password:'',
            errorMessage:''
        },
        mounted: function() {
            console.log("merchant admin mounted");
            this.onLoad();
        },
        methods: {
            switchVisibility() {
                this.viewpasswordtype = this.viewpasswordtype === 'password' ? 'text' : 'password'
            },
            clearform(){
                this.name= '';
                this.notification_url= '';
                this.email= '';
                // this.password= '';
            },
            addOnSubmit(e){
                this.currentFormType = 'addMerchantForm';
                e.preventDefault();
                var _that = this;
                if( !_that.name || !_that.notification_url || !_that.email ){
                    return false
                }
                _that.isLoader = true;

                var addFormData = $("#addMerchantForm").serializeArray();
                var ajaxUrl = $('#addMerchantForm').attr('action');
                _that.message = '';
		        _that.status = null;
                var addRequest = $.ajax({
                    method: "POST",
                    url: ajaxUrl,
                    data: addFormData
                });
                addRequest.done(function (res) {
                    console.log('res', res);
                    _that.isLoader = false;
                    _that.errorMessage = '';
                    _that.status = res.status;
                    //close modal
                    _that.clearform();
                    $("#closebtn").trigger('click');
                    _that.onLoad();
                    if(_that.status == true){
                        toastr.success("You have successfully Added", "Success!", {
                            closeButton: !0,
                            tapToDismiss: !1,
                            rtl: "rtl" === $("html").attr("data-textdirection")
                        })
                        setTimeout((function() {
                            window.location = res.redirect_url;
                           
                        }), 1000)
                        
                    }
                });
        
                addRequest.fail(function (err) {
                    _that.isLoader = false;
                    _that.status = err.responseJSON.status;
                    if(_that.status == false){
                        _that.errorMessage = err.responseJSON.errors;
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
                var ee = $(".add-new-record");
                ee.length && ee.validate({
                    rules: {
                        "name": {
                            required: !0,
                        },
                        "email": {
                            required: !0,
                            email: !0
                        },
                        "notification_url": {
                            required: !0,
                        }
                        
                    }
                })
               
                
            },
            
            
        }
    });
});

