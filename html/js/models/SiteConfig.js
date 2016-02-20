/**
 * Created by nicholas on 16-2-20.
 */
AGarage.Models.SiteConfig = Backbone.Model.extend({
    idAttribute: 'name'
});

AGarage.Collections.SiteConfigs = Backbone.Collection.extend({
    model: AGarage.Models.SiteConfig,
    url: '/api/v1/site',
    parse: function (data) {
        return data.data;
    },
    all: function () {
        return this.reduce(function (obj, config) {
            obj[config.id] = config.get('value');
            return obj;
        }, {});
    }
});