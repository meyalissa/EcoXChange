<?php
// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
    <link rel="stylesheet" href="../style/alert.css">
    <title>Insert Data</title>

    <!------------Style Dropdown-------------->
    <style>
       .dropdown{
        display: flex;
        flex-wrap: wrap;
        width: 50%;
        padding-bottom: 15px;}

       .dropdown label{
        width: 95%;
        color: black;
        margin: 5px 0;}

       .dropdown select{
        height: 40px;
        width: 95%;
        padding: 0 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        outline: none;}
    </style>
</head>
<body>
    <!------Insert Coding--------->    
    <div class="Container">
        <form action="submit-records.php" method="post">
            <input type="hidden" name="staff_ID" value="<?php echo $id; ?>">
            <h2>Add Collection Data</h2>
            <div class="content">
                <div class="input-box">
                    <label for="collect_weight">Collect Weight</label>
                    <input type="text" name="collect_weight" value="" required>
                </div>
               
                <div class="dropdown">
                    <label for="book_ID">Book ID</label>
                    <select name="book_ID" required>
                    <?php
                            $sql = "SELECT * FROM booking WHERE book_status = 'inProgress'";
                            $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<option value='".$row["book_ID"]."'>".$row["book_ID"]."</option>";
                            }
                    ?>
                    </select>
                    
                </div>
                <div class="dropdown">
                    <label for="item_ID">Item Type</label>
                    <select name="item_ID" required>
                        <?php
                            $sql = "SELECT * FROM item";
                            $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error($dbconn));

                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "<option value='".$row["item_ID"]."'>".$row["item_name"]."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="button-add">
                    <button type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>
