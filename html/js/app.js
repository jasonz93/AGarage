/**
 * Created by nicholas on 16-2-20.
 */

var AppView = Backbone.View.extend({
    el: $('#garageapp'),
    initialize: function () {
        var testView = new AGarage.Views.Index({
            ttt: 'test data'
        });
        $('#content').append(testView.render().el);
        var configs = new AGarage.Collections.SiteConfigs();
        configs.fetch();
        console.log(configs);
    }
});

var App = new AppView();

