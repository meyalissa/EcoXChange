<?php
include '../includes/dbconn.php';

function calculateSubtotal($itemName, $weight) {
    global $dbconn;

    $sql = "SELECT * FROM item WHERE item_name = ?";
    $stmt = $dbconn->prepare($sql);
    $stmt->bind_param('s', $itemName);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    $price = $item['item_price'];
    $subtotal = $price * $weight;

    return 'RM' . number_format($subtotal, 2);
}

$subtotals = [];
$debug_info = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = ['Cardboard', 'Old News Paper', 'Black & White Paper', 'Glass', 'Plastic Bottle', 'Aluminium Can', 'Tin', 'Used Cooking Oil'];
    foreach ($items as $item) {
        $key = 'weight-' . strtolower(str_replace(' ', '', $item));
        if (isset($_POST[$key]) && $_POST[$key] !== '') {
            $weight = floatval($_POST[$key]);
            $subtotals[$item] = calculateSubtotal($item, $weight);
            $debug_info[$item] = "Weight: $weight, Subtotal: " . $subtotals[$item];
        } else {
            $subtotals[$item] = 'RM0.00';
            $debug_info[$item] = "Weight: 0, Subtotal: RM0.00";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXchange | Calculator</title>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../style/calculator.css">
</head>

<body>
    <div class="container">
        <?php include('sidebar-2.php'); ?>
        <?php include('header.php'); ?>
        <div class="content">
            <div class="nav-title">
                <h3>Dashboard</h3>
            </div>
            <div class="top-content">
                <div class="searchbar">
                    <label>
                        <input type="text" name="" id="search-item" placeholder="Item's name" onkeyup="search()">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
            </div>
            <div class="item-list" id="item-list">
                <form method="POST" action="">
                    <?php
                    // List of items
                    $items = ['Cardboard', 'Old News Paper', 'Black & White Paper', 'Glass', 'Plastic Bottle', 'Aluminium Can', 'Tin', 'Used Cooking Oil'];
                    foreach ($items as $item):
                        $key = 'weight-' . strtolower(str_replace(' ', '', $item));
                        $weightValue = isset($_POST[$key]) ? htmlspecialchars($_POST[$key]) : '';
                        $subtotalValue = isset($subtotals[$item]) ? $subtotals[$item] : 'RM0.00';
                    ?>

                    <div class="items">
                        <div class="items-content">
                            <div class="title"><?php echo $item; ?></div>
                            <div class="items-incontent">
                                <div class="img"><img src="../images/items <?php echo strtolower(str_replace(' ', '', $item)); ?>.png" alt=""></div>
                                <div class="inpWeight">
                                    <div class="each-wlbl">
                                        <p class="txtcalc">Enter the weight:</p>
                                        <div class="inputbar">
                                            <label>
                                                <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" placeholder="0.00 KG" value="<?php echo $weightValue; ?>">
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
                                <div class="submit-button">
                                    <button type="submit" name="calculate-<?php echo strtolower(str_replace(' ', '', $item)); ?>">Calculate</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/main.js"></script>
    <script src="../js/calculatorfunc.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>