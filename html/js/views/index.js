/**
 * Created by nicholas on 16-2-20.
 */
AGarage.Views.Index = AGarage.Views.SimpleMustacheView.extend({
    el: $('#content'),
    template: 'test',
    data: function () {
        return {
            ttt: 'This is test data'
        };
    }
});