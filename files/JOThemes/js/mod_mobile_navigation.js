document.addEvent('domready', function (event) {

    // redirect to the search form
    $$('.top_nav .toggle_search').addEvent('click', function () {
        window.location.href = "suchen.html";
    });

    $$('.mod_navigation ul.level_1>li>a').setProperty('href', 'javascript:void(0);');
    var mobileNav = $$('.mod_navigation')[0];

    var button = $$('.top_nav .toggle_menu');
    button.addEvent('click', function (event) {
        event.stop();
        mobileNav.toggle();
    });


    //unfold submenu
    $$('.mod_navigation .level_1>li>a').addEvent('click', function (event) {
        toggleSubmenu(event.target.getParent('li'));
        return false;

    });
    $$('.mod_navigation .level_1>li>span').addEvent('click', function (event) {
        toggleSubmenu(event.target.getParent('li'));
        return false;


    });
    //unfold submenu
    function toggleSubmenu(el) {
        var mainList = el;
        if (mainList.hasClass('unfolded')) {
            el.removeClass('unfolded');
            return;
        }
        $$('.unfolded').each(function (el) {
            el.removeClass('unfolded');
        });
        mainList.addClass('unfolded');
        var myFx = new Fx.Scroll(window).toElement(mainList);
    }
});

