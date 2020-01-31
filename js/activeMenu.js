var url = window.location.pathname;
if (url == "/") {
    url = "/index";
} url = url.substring(1)
var cat = jQuery("#navbar-nav").children().toArray();


cat.forEach(function (s) {


    if (jQuery(s).html().indexOf(url) > -1)
    { jQuery(s).addClass("current") }
})
cat = jQuery("#dropdown-menu").children().toArray();


cat.forEach(function (s) {


    if (jQuery(s).html().indexOf(url) > -1)
    { jQuery(s).addClass("current") }
})