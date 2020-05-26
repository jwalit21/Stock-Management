<html>

<head>
    <meta charset="utf-8">
    <title>Add Stock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js">
    </script>

</head>
<style>
    body,
    h1 {
        font-family: "Raleway", sans-serif
    }
    
    body,
    html {
        height: 100%
    }
    
    .bgimg {
        min-height: 100%;
        background-position: center;
        background-size: cover;
    }
    
    .top {
        background-color: #333;
        overflow: hidden;
    }
    
    .top a {
        float: left;
        color: #ffffff;
        text-align: center;
        padding: 14px 16px;
        font-size: 17px;
    }
    
    .top a:hover {
        background-color: #ddd;
        color: black;
    }
    
    .top a.active {
        background-color: #A64564;
        color: white;
    }
    
    .pp {
        margin-top: 95px;
        font-size: 23px;
        text-align: center;
    }
    
    .ppp {
        margin-top: 30px;
        text-align: center;
        margin-bottom: 30px;
    }
    
</style>

<body>
    
    <?php 
            session_start();
            if(!isset($_SESSION['username']))
            {
                header("location:login.php?msg=Please Login");
            }
            $username=$_SESSION['username'];
            
            if(isset($_GET['name']))
            {
                $name=$_GET['name'];
                $id=$_GET['id'];
                $prize=$_GET['prize'];
                $quantity=$_GET['quantity'];
                $catagory=$_GET['catagory'];
                $minstock=$_GET['minstock'];
                $username=$_SESSION['username'];
                
                try
                {
                    $dbhandler = new PDO('mysql:host=localhost;dbname=dm_project','root','');
                    //echo "Connection is established...<br/>";
                    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $query=$dbhandler->prepare("INSERT INTO stock(name,id,prize,quantity,catagory,username,minstock) VALUES (?,?,?,?,?,?,?) ");
                    $query->execute(array($name,$id,$prize,$quantity,$catagory,$username,$minstock));
                    header("location:addstock.php?msg=Item Inserted Sucessfully");
                }
                catch(PDOException $e)
                {
                    //echo $e->getMessage();
                    if($e->errorInfo[1]==1062)
                    {
                        header("location:addstock.php?msg=id is already Taken");
                    
                       
                    }
                    die();
                } 
            }
        ?>
    <div style="padding-top: 7px;"></div>
    <div class="top">
        <a href="dashboard.php">Dashboard</a>
        <a class="active"  href="addstock.php">Add Stock</a>
        <a href="viewstock.php">View and Manage Stock</a>
        <a href="feedback.php">Feedback</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="teal lighten-2">
        <h6 style="padding-top: 7px;color:black;" class="center large">Welcome <?php echo $username;?> !!! you are logged in !!</h6>
        <div id="chart" class="card-panel lighten-2 z-depth-1" style="background: #333;color: white;">
            <table>
            <tr class="row">
            <td class="col s6">
            <form class="form-inline my-2 my-lg-0" action="searchbyname.php">
                <table>
                <tr class="row">
                <td class="col s1">
                <i class="material-icons white">search</i>
                </td>
                <td class="col s9">
                    <input style="color: white;" class="form-control mr-sm-1" type="search" placeholder="Search by names" aria-label="Search" name="name" >
                </td> 
                <td class="col s2">   
                    <input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="search">
                </td>
                </tr>
                </table>
            </form>
            </td>
            <td class="col s6">
                <form class="form-inline my-2 my-lg-0" action="searchbycat.php">
                <table>
                <tr class="row">
                <td class="col s1">
                <i class="material-icons white">search</i>
                </td>
                <td class="col s9">
                    <input style="color: white;" class="form-control mr-sm-1" type="search" placeholder="Search by catagories" aria-label="Search" name="catagory" >
                </td> 
                <td class="col s2">   
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </td>
                </tr>
                </table>
            </form>
            </td>
            </tr>
            </table>
        </div>
    </div>
    <div class="row">

        
        <div class="col s8">
            <?php 
                if(isset($_GET['msg']))
                {
                    ?>
            <p class="error"><h4> <?php echo "          ".$_GET['msg'];?> </h4></p>
            <?php
                }
            
            ?>
            <div class="row" style= "padding-top: 4%;padding-right: 4%;padding-left: 4%;">
                <form action="addstock.php"  class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                            <input name="name" id="stock_name" type="text" required placeholder="Enter stock name">
                            <label for="stock_name">Stock Name</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="stock_id1" type="number" name="id" required placeholder="Enter unique Id">
                            <label for="stock_id1">Id</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="stock_cat" type="text" name="catagory" required placeholder="Enter catagory of stock">
                            <label for="stock_cat">Catagory</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="stock_prize" type="number" name="prize" required placeholder="Enter prize per each item">
                            <label for="stock_prize">Prize</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="stock_quantity" type="number" name="quantity" required placeholder="Enter current quantity">
                            <label for="stock_quantity">Quantity</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="stock_empty" type="number" name="minstock" required placeholder="Enter minimum amount of stock required">
                            <label for="stock_empty">Minimum required stock</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input class="btn green" type="submit" value="submit">
                            <input class="btn blue" type="reset" value="reset">
                        </div>
                    </div>
                </form>
            </div>
            <p style="padding-left: 5.5%;">
                <a href="viewstock.php">Click to view stock records.</a>
            </p>
        </div>
    </div>
    <script>

        var date = new Date();
            var d = date.getDay();
            yr = date.getFullYear();
            mon = date.getMonth() + 1;
            dt = date.getDate();
            var str = "d";
            if (d == 0)
                str = "Sunday";
            if (d == 1)
                str = "Monday";
            if (d == 2)
                str = "Tuesday";
            if (d == 3)
                str = "Wednesday";
            if (d == 4)
                str = "Thursday";
            if (d == 5)
                str = "Friday";
            if (d == 6)
                str = "Saturday";
            var s=["JAN","FEB","MARCH","APRIL","MAY","JUNE","JULY","SEPT","OCT","NOV","DEC"];
            document.getElementById("date").innerHTML = "It's" + str;
            document.getElementById("day").innerHTML =  dt + " " + s[mon-1];

    </script>
</body>
</html>