<form action="submit-records.php" method="post">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
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
        
            <h2>Add Collection Data</h2>
            <div class="content">
                <div class="input-box">
                    <label for="collect_ID">Collect Id</label>
                    <input type="text" name="collect_ID" value="">
                </div>
                
                <div class="input-box">
                    <label for="collect_weight">Collect Weight</label>
                    <input type="text" name="collect_weight" value="">
                </div>
                <div class="input-box">
                    <label for="total_amount">Total Amount</label>
                    <input type="text" name="total_amount" value="">
                </div>
                <div class="input-box">
                    <label for="collect_date">Collect Date</label>
                    <input type="text" name="collect_date" value="">
                </div>
                <div class="input-box">
                    <label for="collect_time">Collect Time</label>
                    <input type="text" name="collect_time" value="">
                </div>
                <div class="input-box">
                    <label for="reward_status">Reward Status</label>
                    <input type="text" name="reward_status" value="">
                </div>
                <div class="input-box">
                    <label for="book_ID">Book ID</label>
                    <input type="text" name="book_ID" value="">
                </div>
                <div class="input-box">
                    <label for="item_ID">Item ID</label>
                    <input type="text" name="item_ID" value="">
                </div>
                <div class="input-box">
                    <label for="staff_ID">Staff ID</label>
                    <input type="text" name="staff_ID" value="">
                </div>
                <div class="button-add">
                        <a href='submit-records.php'><button>Submit</button></a> <!--submit-records.php-->
                </div>
            </div>
    </div>
</body>
</html>