/**
 * Created by nicholas on 16-2-20.
 */
AGarage.Views.SimpleMustacheView = Backbone.View.extend({
        data: function () {
            return {};
        },
        mustachify: function (templateName, attributes) {
            return Mustache.to_html($('script[type="text/x-mustache-template"][name="' + templateName + '"]').html(), attributes);
        },
        render: function () {
            this.$el.html(this.mustachify(this.template, this.data()));
            return this;
        }
    });