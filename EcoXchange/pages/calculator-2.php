
<?php
include '../includes/dbconn.php';

function getItemPrice($itemName) {
    global $conn;

    $sql = "SELECT item_price FROM item WHERE item_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $itemName);
    $stmt->execute();
    $stmt->bind_result($price);
    $stmt->fetch();
    $stmt->close();

    return $price;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_name'])) {
    $itemName = $_POST['item_name'];
    $weight = floatval($_POST['weight']);
    $price = getItemPrice($itemName);

    $subtotal = $price * $weight;
    echo json_encode(['subtotal' => 'RM' . number_format($subtotal, 2)]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXchange | Calculator</title>
    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../style/calculator.css">


</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-2.php'); ?>

        <!-- ========================= Main ==================== -->
            <?php include('header.php'); ?>
            <div class="content">
                <div clas="nav-title"><h3>Dashboard</h3></div>
                <!-- !!!!!!!!!!CODES HERE!!!!!!!! -->
                <div class="top-content">
                        <div class="searchbar">
                            <label>
                                <input type="text" name="" id="search-item" placeholder="Item's name" onkeyup="search()">
                                <ion-icon name="search-outline"></ion-icon>
                                
                            </label>
                        </div>       
                </div>

                <div class="item-list" id="item-list">
                    <form method="POST" action="calculator-2.php">
                    <?php
                        $items = ['Cardboard', 'Old News Paper', 'Black & White Paper', 'Glass', 'Plastic Bottle', 'Aluminium Can', 'Tin', 'Used Cooking Oil'];
                        foreach ($items as $item):
                            $key = 'weight-' . strtolower(str_replace(' ', '', $item));
                            $weightValue = isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : '';
                            $subtotalValue = isset($subtotals[$item]) ? $subtotals[$item] : 'RM0.00';
                    ?>

                    <!---item 1-->
                    <div class="items">
                        <div class="items-content">
                            <div class="title">Cardboard</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/cardboard.png" alt=""></div>
                                <div class="inpWeight">
                                    <div class="each-wlbl">
                                        <p class="txtcalc">Enter the weight:</p>
                                        <div class="inputbar">
                                            <label>
                                            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" placeholder="0.00" value="<?php echo $weightValue; ?>">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="each-wlbl">
                                        <p class="txtcalc">Subtotal:</p>
                                        <div class="inputbar2">
                                            <label>
                                            <input type="text" id="subtotal-<?php echo strtolower(str_replace(' ', '', $item)); ?>" value="<?php echo $subtotalValue; ?>" readonly>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!---item 2-->
                    <div class="items">
                        <div class="items-content">
                            <div class="title">Old News Paper</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/newpaper.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-newspaper" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-newspaper" value="<?php echo calculateSubtotal('Old News Paper', $_POST['weight-newspaper']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        
                    <div class="items">
                        <div class="items-content">
                            <div class="title">Black & White Paper</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/bnw paper.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-bnwpaper" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-bnwpaper" value="<?php echo calculateSubtotal('Black & White Paper', $_POST['weight-bnwpaper']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="items">
                        <div class="items-content">
                            <div class="title">Glass</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/glass bottle.png" alt=""></div>
                                <div class="inpWeight">
                                    <p class="txtcalc">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-glass" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="txtcalc">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-glass" value="<?php echo calculateSubtotal('Glass', $_POST['weight-glass']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="items">
                        <div class="items-content">
                            <div class="title">Plastic Bottle</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/plasticBot.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-plasticbot" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-plasticbot" value="<?php echo calculateSubtotal('Plastic Bottle', $_POST['weight-plasticbot']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="items">
                        <div class="items-content">
                            <div class="title">Aluminium Can</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/alCan.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-alcan" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-alcan" value="<?php echo calculateSubtotal('Aluminium Can', $_POST['weight-alcan']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="items">
                        <div class="items-content">
                            <div class="title">Tin</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/tin.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-tin" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-tin" value="<?php echo calculateSubtotal('Tin', $_POST['weight-tin']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                    

                    <div class="items">
                        <div class="items-content">
                            <div class="title">Used Cooking Oil</div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/usedOil.png" alt=""></div>
                                <div>
                                    <p class="p1">Enter the weight:</p>
                                    <div class="inputbar">
                                        <label>
                                            <input type="text" id="weight-usedoil" placeholder="0.00">
                                        </label>
                                    </div>
                                    <p class="p2">Subtotal:</p>
                                    <div class="inputbar2">
                                        <label>
                                        <input type="text" id="subtotal-usedoil" value="<?php echo calculateSubtotal('Used Cooking Oil', $_POST['weight-usedoil']); ?>" readonly>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                        <button type="submit">Calculate</button>
            </form>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script src="../js/calculatorfunc.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function calculateSubtotal(itemName, weight) {
            if (weight === '') {
                document.getElementById('subtotal-' + itemName.toLowerCase().replace(/\s+/g, '')).value = 'RM0.00';
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'calculator-2.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById('subtotal-' + itemName.toLowerCase().replace(/\s+/g, '')).value = response.subtotal;
                }
            };
            xhr.send('item_name=' + encodeURIComponent(itemName) + '&weight=' + encodeURIComponent(weight));
        }
    </script>
</body>

</html>
