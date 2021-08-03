$(document).ready(function () {
    $('.select2').select2();

    $('.sidebar .nav-item a.nav-link').each(function (e) {
        if (this.getAttribute('href') === window.location.href) {
            $(this).addClass('active');
            $(this).parents('li').siblings().children('a').removeClass('active');
            $(this).parents('ul').siblings().addClass('active');
            $(this).parents('li.is-open').siblings().removeClass('menu-open');
            $(this).parents('li.is-open').addClass('menu-open');
        }
    });
});
