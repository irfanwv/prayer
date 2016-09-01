<html>
    <head>
         <title>Registration Form</title> 
    </head>
    <body>
        <form action="../action_req.php" method="post" enctype="multipart/form-data">
            <table border="1px">
               
                <tr>
                    <td>Tag:</td>
                    <td><input type="text" name="tag" value="register"/></td>
                </tr>
                
               <!-- <tr>
                    <td>Upload photo:</td>
                    <td><input type="file" name="image"/></td>
                </tr>-->
                
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name"/></td>
                </tr>               
              
                
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email"/></td>
                </tr>
                
                <tr>
                    <td>Password:</td>
                    <td><input type="text" name="password"/></td>
                </tr>                         
         
                <tr>
                    <td><input type="submit" value="Sign Up"</td>
                </tr>
            </table>
        </form>
    </body>
</html>