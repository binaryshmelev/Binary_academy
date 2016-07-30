<script type="text/template" id="books_headers">
    <thead>
    <tr>
        <td>ID</td>
        <td>Title</td>
        <td>Author</td>
        <td>Year</td>
        <td>Genre</td>
        <td>Users</td>
        <td width="250">Actions</td>
    </tr>
    </thead>
    <tbody>
    </tbody>
</script>

<script type="text/template" id="book_item">
    <td><%- id %></td>
    <td><%- title %></td>
    <td><%- author %></td>
    <td><%- year %></td>
    <td><%- genre %></td>
    <td><%- user_id %></td>
    <td>
        <a class="btn btn-small btn-info" href="#books/<%- id %>/edit">Edit this book</a>
        <a class="btn btn-danger" href="#books/<%- id %>/delete">Delete Book</a>
    </td>
</script>

<script type="text/template" id="book_edit">
    <div class="content_edit">
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" name="title" type="text" value="<%- title %>" id="title">
            <label for="author">Author</label>
            <input class="form-control" name="author" type="text" value="<%- author %>" id="author">
            <label for="genre">Genre</label>
            <input class="form-control" name="genre" type="text" value="<%- genre %>" id="genre">
            <label for="year">Year</label>
            <input class="form-control" name="year" type="number" value="<%- year %>" id="year">
            <label for="year">User ID</label>
            <input class="form-control" name="user_id" type="number" value="<%- user_id %>" id="user_id">
            <input class="btn btn-primary but_edit" type="submit" value="Save">
        </div>
    </div>
</script>