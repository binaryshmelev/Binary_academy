<script type="text/template" id="users_header">
    <thead>
    <tr>
        <td>ID</td>
        <td>Fisrtname</td>
        <td>Lasttname</td>
        <td>Email</td>
        <td width="200">Actions</td>
    </tr>
    </thead>
    <tbody>
    </tbody>
</script>

<script type="text/template" id="user_item">
    <td><%- id %></td>
    <td><%- firstname %></td>
    <td><%- lastname %></td>
    <td><%- email %></td>
    <td>
        <a class="btn btn-small btn-info" href="#users/<%- id %>">Show this user</a>
    </td>
</script>

<script type="text/template" id="user_info">
    <h1>User info with ID <%- id %></h1>
    <h2>Firstname: <%- firstname %></h2>
    <h2>Lastname: <%- lastname %></h2>
    <h4>Email: <a href=""><%- email %></a></h4>
</script>