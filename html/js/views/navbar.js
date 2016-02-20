/**
 * Created by nicholas on 16-2-20.
 */
AGarage.Views.Navbar = AGarage.Views.SimpleMustacheView.extend({
    template: 'navbar',
    data: function () {
        return this.model.all();
    },
    initialize: function () {
        this.model.bind('reset', this.r, this);
    },
    r: function () {
        console.log('rendering...');
        console.log(this.model.all());
        this.render();
    }
});