<html>
    <head>
         <title>Registration Form</title> 
    </head>
    <body>
        <form action="../action_req.php" method="post" enctype="multipart/form-data">
            <table border="1px" style="width: 55%;">
               
                <tr>
                    <td>Tag:</td>
                    <td><input type="text" name="tag" value="church_register" readonly/></td>
                </tr>
                
               <!-- <tr>
                    <td>Type:(Church)</td>
                    <td><input type="text" name="type" value="1" readonly/></td>
                </tr> -->
                
                <tr>
                    <td>Church Name:</td>
                    <td><input type="text" name="name"/></td>
                </tr>
                
                 <tr>
                    <td>City:</td>
                    <td><input type="text" name="city"/></td>
                </tr>
                 
                 <tr>
                    <td>State:</td>
                    <td><input type="text" name="state"/></td>
                </tr>
                 
                  <tr>
                    <td>Country :</td>
                    <td><input type="text" name="country"/></td>
                </tr>
                  
                <tr>
                    <td>Denomination:</td>
                    <td><input type="text" name="denomination"/></td>
                </tr>
                
                 <tr>
                    <td>Church Leader:</td>
                    <td><input type="text" name="leader"/></td>
                </tr>
                 
                  <tr >
                    <td>Phone:</td>
                    <td><input type="text" name="phone"/></td>
                </tr> 
              
                
                <tr>
                    <td>Leader's Email:</td>
                    <td><input type="text" name="email"/></td>
                </tr>
                
                <tr>
                    <td  >URL for your church (i.e. PrayerGrid.org/ExampleChurchName):</td>
                    <td><input type="text"  value="http://www.prayergrid.org/" disabled/><input type="text" name="linkname"/></td>
                </tr>
                
                <tr>
                    <td>Password:</td>
                    <td><input type="text" name="password"/></td>
                </tr>
                
                  <tr>
                    <td>Automatically approve requests to join church prayer group:</td>
                    <td><input type="radio"  value="1" name="memberapproval"/>Yes<input type="radio" value="0" name="memberapproval"/>No</td>
                </tr>
                  
               <!-- <tr>
                    <td>Do you want notified when prayer requests are posted? :</td>
                    <td><input type="radio"  value="1"  name="nofificationpost"/>Yes<input type="radio" value="0" name="nofificationpost"/>No</td>
                </tr>-->
                
                 <tr>
                    <td style="width:5%">Would you like to contribute recorded sermons to ThePrayerPeople TV for the purpose of sharing the Gospel to the world? :</td>
                    <td><input type="radio"  value="1" name="tv"/>Yes<input type="radio" value="0" name="tv"/>No</td>
                </tr>
         
                <tr>
                    <td><input type="submit" value="Sign Up"</td>
                </tr>
            </table>
        </form>
    </body>
</html>