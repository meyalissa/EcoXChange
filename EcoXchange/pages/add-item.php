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
        <form action="../includes/process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="addItem">

            <h2>Item Detail</h2>
            <div class="content">
                <div class="input-box">
                    <label for="itemname">Item Name</label>
                    <input type="text" name="itemname" required>
                </div>
                <div class="input-box">
                    <label for="itemprice">Item Price per KG</label>
                    <input type="text" name="itemprice" required>
                </div>
                <div class="input-box">
                    <label for="itempict">Item Picture</label>
                    <input type="file" name="itempict" required>
                </div>
                <div class="button-add">
                    <button type="submit">Add Item</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
