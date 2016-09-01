 <html>
    <head>
         <title>Forget password Form</title> 
    </head>
    <body>
        <form action="../action_req.php" method="post" enctype="multipart/form-data">
            <table border="1px">
                <tr>
                    <td>Tag:</td>
                    <td><input type="text" name="tag" value="forget_pass_local"/></td>
                </tr>
                
                  <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email"/></td>
                </tr>
               
                <tr>
                    <td><input type="submit" value="Send"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>