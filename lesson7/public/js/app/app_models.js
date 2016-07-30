{
    User_Model = Backbone.Model.extend({
        urlRoot: '/users'
    });

    Users_Model = Backbone.Collection.extend({
        model: User_Model,
        url: '/users'
    });

    Book_Model = Backbone.Model.extend({
        defaults: {
            title: "",
            author: "",
            year: "",
            genre: "",
            user_id: ""
        },

        validate: function (attr) {
            var validRooles = /([A-z]+)/;
            if(!attr.title.match(validRooles))
                return "Title can contains only chars";
            if(!attr.author.match(validRooles))
                return "Author can contains only chars";
            if(!attr.genre.match(validRooles))
                return "Genre can contains only chars";
            var validRooles = /([0-9]{4})/;
            if(!attr.year.match(validRooles))
                return "Year can contains 4 digits";
            var validRooles = /([0-9])/;
            if(!attr.user_id.match(validRooles))
                return "User must contains only digits";
        },

        urlRoot: '/books'
    });

    Books_Model = Backbone.Collection.extend({
        model: Book_Model,
        url: '/books'
    });
}
