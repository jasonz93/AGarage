/**
 * Created by nicholas on 16-2-20.
 */

var AppView = Backbone.View.extend({
    el: $('#garageapp'),
    initialize: function () {
        var testView = new AGarage.Views.Index({
            el: $('#content'),
            ttt: 'test data'
        });
        testView.render();
        var configs = new AGarage.Collections.SiteConfigs();
        var navbar = new AGarage.Views.Navbar({
            el: $('#navbar'),
            model: configs
        });
        navbar.render();
        configs.fetch({
            reset: true
        });
    }
});

var App = new AppView();

