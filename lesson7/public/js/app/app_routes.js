App = new Backbone.Marionette.Application();
App.addRegions({content: "#content"});

new Marionette.AppRouter({
    appRoutes: {
        "books": "books",
        "books/create": "bookCreate",
        "books/:id/edit": "bookEdit",
        "books/:id/delete": "bookDelete",
        "users": "users",
        "users/:id": "user"
    },

    controller: {
        books: function () {
            var books = new Books_Model();
            books.fetch({success: function (collection) {App.content.show(new Books_View({collection: collection}));}});
        },

        bookCreate: function () {
            var book = new Book_Model();
            App.content.show(new Book_Edit_View({ model: book}));
        },

        bookEdit: function (id) {
            var book = new Book_Model({id: id});
            book.fetch({success: function (book) {App.content.show(new Book_Edit_View({model: book}));}});
        },

        bookDelete: function (id) {
            var book = new Book_Model({id: id});
            book.destroy();
            Backbone.history.navigate('/books', {trigger: true});
        },

        users: function () {
            var users = new Users_Model();
            users.fetch({success: function (coll) {App.content.show(new Users_View({collection: coll}));}});
        },

        user:function (id) {
            var user = new User_Model({id: id});
            user.fetch({success: function (user) {App.content.show(new User_Info_View({model: user}));}})
        },
    },
});

App.addInitializer(function(options){
    Backbone.history.start();
});

$(document).ready(function(){
    App.start();
});