$(document).ready(function() {
   
    const app = new Vue({
        el: '#admin_user_assign',
        data: {

            status: null, // true, false
            message: '',
            isLoader:false,
            selected_user:[],
            selected_user_ids:'',
            errorMessage:''
        },
        mounted: function() {
            console.log("user assign mounted");
            //this.onLoad();
        },
        methods: {
            clickevent(action) {
                var _that = this;
                // console.log("clickevent mounted",_that.selected_user);
                let isValid = false;
                if(action == 'add'){
                    !$('#availableSelect option:selected').remove().appendTo('#selectedSelect').prop("selected", true);; 
                    isValid = true;
                }else{
                    !$('#selectedSelect option:selected').remove().appendTo('#availableSelect').prop("selected", true);;
                    isValid = true;
                }
               
                if(isValid){
                    _that.isLoader = true;
                    _that.selected_user=[];
                    $('#selectedSelect option').each(function(i) {  
                        var obj = $(this);
                        _that.selected_user.push(obj.val())
                    }); 

                   $("#selected_user_ids").val(_that.selected_user.toString());
                   setTimeout(function(){
                        var ajaxUrl = $('#selectedMerchant').attr('action');
                        _that.message = '';
                        _that.status = null;
                        var addRequest = $.ajax({
                            method: "POST",
                            url: ajaxUrl,
                            data: {
                                "_token":$('input[name="_token"]').val(),
                                "user_id":$('input[name="user_id"]').val(),
                                "selected_id":_that.selected_user.toString()
                            }
                        });
                        addRequest.done(function (res) {
                            // console.log('res', res);
                            _that.isLoader = false;
                            _that.errorMessage = '';
                            _that.status = res.status;
                            //close modal
                        
                            if(_that.status == true){
                                let msg = "You have successfully Added";
                                if(action !== 'add'){
                                    msg = "You have successfully removed";
                                }
                                toastr.success(msg, "Success!", {
                                    closeButton: !0,
                                    tapToDismiss: !1,
                                    rtl: "rtl" === $("html").attr("data-textdirection")
                                })
                                // if( res.redirect_url){
                                    setTimeout((function() {
                                       window.location = res.redirect_url;
                                    
                                    }), 1000)
                                // }
                                
                                
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
                   }, 1000);
                   
                    
                }
                
            },
        }
    });
});

