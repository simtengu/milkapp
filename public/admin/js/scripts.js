/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

        //searching user basing on their email...................................................
        $("#user_search_field").on('keyup', function () {
            var item = $(this).val().trim();
            var path = $("#user_search_path").val();
            if (item.length > 1) {

                $.ajax({
                    url: path + "/" + item,
                    method: "GET",
                    success: function (rs) {
                        $("#search_results_ul").html(rs);
                    },
                    error: function () {
                        console.log("something went wrong");
                    }
                })
            } else {
                $("#search_results_ul").html("");
            }
        });

        $(document).click(function () {
            $("#search_results_ul").html("");
        });
        $("#search_results_ul").click(function (e) {
            e.stopPropagation();
        });

  
})(jQuery);
