 <html>
    <head>
         <title>Pdf generation Form</title> 
    </head>
    <body>
        <form action="../action_req.php" method="post" enctype="multipart/form-data">
            <table border="1px">
                <tr>
                    <td>Tag:</td>
                    <td><input type="text" name="tag" value="pdf_generation"/></td>
                </tr>
                
                  <tr>
                    <td>Proposal Id:</td>
                    <td><input type="text" name="proposal_id"/></td>
                </tr>
                  
                  <tr>
                    <td>user Id:</td>
                    <td><input type="text" name="user_id"/></td>
                </tr>
                  
                <tr>
                    <td><input type="submit" value="Submit"</td>
                </tr>
            </table>
        </form>
    </body>
</html>