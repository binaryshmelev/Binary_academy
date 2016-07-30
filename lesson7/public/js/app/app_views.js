{
    User_View = Marionette.ItemView.extend({
        template: "#user_item",
        tagName: 'tr'
    });

    Users_View = Marionette.CompositeView.extend({
        className: "table table-responsive table-hover table-bordered",
        template: "#users_header",
        childView: User_View,
        tagName: "table"
    });

    User_Info_View = Marionette.LayoutView.extend({
        tagName: "div",
        className: "details",
        template: "#user_info"
    });

    Book_View = Marionette.ItemView.extend({
        template: "#book_item",
        tagName: 'tr'
    });

    Books_View = Marionette.CompositeView.extend({
        className: "table table-responsive table-hover table-bordered",
        template: "#books_headers",
        childView: Book_View,
        tagName: "table"
    });

    Book_Edit_View = Marionette.ItemView.extend({
        template: "#book_edit",
        tagName: "form",
        events: {
            'submit': 'Save',
        },
        Save: function (e) {
            e.preventDefault();
            var model = this.model;
            var data = _(this.$el.serializeArray()).reduce(function (acc, field) {model.set(field.name, field.value);}, {});
            if (!model.isValid()) {
                alert(model.validationError);
                return;
            }
            model.save(data);
            alert('Done');
            Backbone.history.navigate('/books', {trigger: true});
        }
    });
}