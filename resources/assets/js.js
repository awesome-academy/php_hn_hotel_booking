$(document).ready(function () {
    $('.sidebar .nav-item a.nav-link').each(function (e) {
        if (this.getAttribute('href') === window.location.href) {
            $(this).addClass('active');
            $(this).parents('li').siblings().children('a').removeClass('active');
        }
    });
})
