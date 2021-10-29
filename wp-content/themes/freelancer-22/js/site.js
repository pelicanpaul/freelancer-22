
var utility = {
    getParameterByName: function(name) {
        name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
        var regexS = "[\\?&]" + name + "=([^&#]*)";
        var regex = new RegExp(regexS);
        var results = regex.exec(window.location.search);
        if(results == null)
            return "";
        else
            return decodeURIComponent(results[1].replace(/\+/g, " "));
    },

    isMobile: function(){
        if( /Android|webOS|iPhone|iPod|iPad|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            return 'true';
        }
    },

    getInternetExplorerVersion: function() {
        var rv = -1; // Return value assumes failure.
        if (navigator.appName == 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    },

    getOS: function() {
    var userAgent = window.navigator.userAgent,
        platform = window.navigator.platform,
        macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
        windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
        iosPlatforms = ['iPhone', 'iPad', 'iPod'],
        os = null;

        if (macosPlatforms.indexOf(platform) !== -1) {
            os = 'Mac OS';
        } else if (iosPlatforms.indexOf(platform) !== -1) {
            os = 'iOS';
        } else if (windowsPlatforms.indexOf(platform) !== -1) {
            os = 'Windows';
        } else if (/Android/.test(userAgent)) {
            os = 'Android';
        } else if (!os && /Linux/.test(platform)) {
            os = 'Linux';
        }

        return os;
    },

    setCookie: function (cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    },

    getCookie: function(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
        }
        return "";
    },

    checkCookie: function (cname) {
        var cookie = utility.getCookie(cname);
        var result = false;

        if (cookie != "" && cookie != null) {
            result = true;
        }

        return result;

    },

    getExternalLink: function(url){
        var extLink = jQuery('#external-link-go');
        jQuery(extLink).attr('rel', url);
        var counter = 0;

        jQuery(extLink).click(function(){
            var rel = jQuery(this).attr('rel');

            if(counter == 0){
            window.open(rel);
            }
            counter++
        })
    }


};

jQuery(document).ready(function($) {

    var windowWidth = $(window).innerWidth();
    var windowHeight = $(window).innerHeight();

    var hamburger = $('.hamburger');

    hamburger.on('click', function(e){

        e.preventDefault();

        var mainMenu = $('#container-main-menu');

        if(mainMenu.hasClass('active')){
            mainMenu.removeClass('active');
        } else {
            mainMenu.addClass('active');
        }

        $('.main-menu').toggle();

    });

    $('.go-to-next-section').click(function(e){

        e.preventDefault();

        var nextSection = $(this).parent('section').next('section');

        var topDistance = $(nextSection).offset().top;

        setTimeout(function () {
            $('html, body').stop().animate({
                scrollTop: topDistance
            }, 250, 'easeInOutExpo');
        }, 250);

    })

    if(windowWidth > 1080){
        window.addEventListener("scroll", function(event) {

            var siteHeader = $('#site-header');

            var top = this.scrollY;

            if(top > 10){
                siteHeader.addClass('get-small');
            } else {
                siteHeader.removeClass('get-small');
            }
        }, false);

    }



});

