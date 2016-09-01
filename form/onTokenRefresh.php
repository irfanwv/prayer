<html>
    <head>
         <title>Login Form</title> 
    </head>
    <body>
        <form action="../action_req.php" method="post" enctype="multipart/form-data">
            <table border="1px">
                <tr>
                    <td>Tag:</td>
                    <td><input type="text" name="tag" value="onTokenRefresh"/></td>
                </tr>
                <tr>
                    <td>user_id:</td>
                    <td><input type="text" name="user_id"/></td>
                </tr>
                <tr>
                    <td>gpmessage:</td>
                    <td><input type="text" name="gpmessage"/></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Login"</td>
                </tr>
            </table>
        </form>
    </body>
</html>