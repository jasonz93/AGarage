/**
 * Created by nicholas on 16-2-20.
 */
AGarage.Models.SiteConfig = Backbone.Model.extend({
    defaults: {
        name: '',
        value: ''
    }
});

AGarage.Collections.SiteConfigs = Backbone.Collection.extend({
    model: AGarage.Models.SiteConfig,
    url: '/api/v1/site',
    parse: function (data) {
        console.log(data);
        return data.data;
    },
    all: function () {

    }
});