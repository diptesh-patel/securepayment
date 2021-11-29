$(document).ready(function() {
   
    const app = new Vue({
        el: '#admin_mid',
        data: {

            status: null, // true, false
            message: '',
            currentFormType: '',
            isLoader:false,
            
            name:"",
            descriptor:'',
            connector:'',
            errorMessage:''
        },
        mounted: function() {
            console.log("user admin mounted");
            this.onLoad();
        },
        methods: {
           
            clearform(){
                this.name= '';
                this.descriptor= '';
                this.connector= '';
            },
            editOnSubmit(e){
                this.currentFormType = 'editMidForm';
                e.preventDefault();
                var _that = this;
                
                _that.isLoader = true;

                var addFormData = $("#editMidForm").serializeArray();
                var ajaxUrl = $('#editMidForm').attr('action');
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
                    _that.onLoad();
                    if(_that.status == true){
                        toastr.success("You have successfully Updated", "Success!", {
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
                        "descriptor": {
                            required: !0,
                        },
                        "connector": {
                            required: !0,
                        },
                        "status": {
                            required: !0,
                        }
                       
                    }
                })
               
                
            },
            
            
        }
    });
});

