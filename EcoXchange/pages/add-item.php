

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/form.css">
    <title>Add New Item</title>
</head>
<body>
    <div class="Container">
        <form action="add.php" method="post">
            <h2>Item Detail</h2>
            <div class="content">
                <div class="input-box">
                    <label for="itemid">Item Id</label>
                    <input type="text" name="itemid" value="">
                </div>
                <div class="input-box">
                    <label for="itemname">Item Name</label>
                    <input type="text" name="itemname" value="">
                </div>
                <div class="input-box">
                    <label for="itemprice">Item Price</label>
                    <input type="text" name="itemprice" value="">
                </div>
                <div class="input-box">
                    <label for="itempict">Item Picture</label>
                    <input type="file" name="itempict" value="">
                </div>
                <div class="button-add">
                    <button>Add New Item</button>
                </div>
            </div>
         </form>
    </div>
</body>
</html>