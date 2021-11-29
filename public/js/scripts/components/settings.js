let settingPage = {};
if ($("#settings_page").length > 0) {
    let settings = {
        name: 'SettingsPage',
        el: '#settings_page',
        data: {
            status: null, // true, false
            message: '',
            currentFormType: '',
            isLoader:false,
        },
        components: {
          
            
        },
        computed: {

        },
        beforeMount() {
           
        },
        mounted: function () {
            console.log("setting load");
            this.onLoad();
        },
        methods: {
            onLoad() {
                ! function(t, n, e) {
                    "use strict";
                    var h = e(".nav-left + .tab-content").height();
                    e("ul.nav-left").height(h);
                    var i = e(".nav-right + .tab-content").height();
                    e("ul.nav-right").height(i)
                }(window, document, jQuery);
                
            },
           
            

        }
    };
    settingPage = new Vue(settings);
}

