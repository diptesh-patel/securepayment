$((function() {
    "use strict";
    var e = "ltr";
    "rtl" == $("html").data("textdirection") && (e = "rtl");
    
    var m = document.getElementById("default-color-slider");
       
    var y = {
            start:0,
            behaviour: "drag",
            connect: 'lower',
            step: 5,
            tooltips: !0,
            range: {
                min: 0,
                max: 100
            },
            pips: {
                mode: "steps",
                stepped: !0,
                density: 5
            },
            direction: e
        };
    void 0 !== typeof m && null !== m && noUiSlider.create(m, y);
    
}));