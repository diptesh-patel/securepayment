$(window).on("load", (function() {
    "use strict";
    var e, o, t, r, a, s = "#ebf0f7",
        i = "#5e5873",
        n = "#ebe9f1",
        d = document.querySelector("#gained-chart"),
        l = document.querySelector("#order-chart"),
        h = document.querySelector("#avg-sessions-chart"),
        p = document.querySelector("#support-trackers-chart"),
        c = document.querySelector("#sales-visit-chart"),
        w = "rtl" === $("html").attr("data-textdirection");
     e = {
        chart: {
            height: 100,
            type: "area",
            toolbar: {
                show: !1
            },
            sparkline: {
                enabled: !0
            },
            grid: {
                show: !1,
                padding: {
                    left: 0,
                    right: 0
                }
            }
        },
        colors: [window.colors.solid.primary],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: .9,
                opacityFrom: .7,
                opacityTo: .5,
                stops: [0, 80, 100]
            }
        },
        series: [{
            name: "Subscribers",
            data: [28, 40, 36, 52, 38, 60, 55]
        }],
        xaxis: {
            labels: {
                show: !1
            },
            axisBorder: {
                show: !1
            }
        },
        yaxis: [{
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding: {
                left: 0,
                right: 0
            }
        }],
        tooltip: {
            x: {
                show: !1
            }
        }
    }
}));