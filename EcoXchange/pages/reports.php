<?php

// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');

$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$view = isset($_GET['view']) ? $_GET['view'] : 'yearly';

if ($view == 'monthly') {
    $query = "SELECT 
                MONTH(collect_date) as month, 
                COALESCE(SUM(total_amount), 0) as total_sales 
                FROM collection_record
                WHERE YEAR(collect_date) = $year
                GROUP BY MONTH(collect_date)";
} else {
    $query = "SELECT 
                YEAR(collect_date) as year,
                SUM(total_amount) as total_sales
                FROM collection_record
                GROUP BY YEAR(collect_date)";
}

$result = mysqli_query($dbconn, $query);
$sales = array();

// Process fetched data
while ($row = mysqli_fetch_assoc($result)) {
    if ($view == 'monthly') {
        $month = (int)$row['month'];
        $sales[$month] = (float)$row['total_sales'];
    } else {
        $sales[] = array('year' => (int)$row['year'], 'total_sales' => (float)$row['total_sales']);
    }
}

// Encode sales data in JSON format for JavaScript
$sales_json = json_encode($sales);

//-- overall sales --//
// Query to fetch total sales data
$query_total_sales = "SELECT SUM(total_amount) AS total_sales FROM collection_record";
$result_total_sales = mysqli_query($dbconn, $query_total_sales);
$total_sales_row = mysqli_fetch_assoc($result_total_sales);
$total_sales = $total_sales_row['total_sales'];

// Query to fetch years for the year button
$query = "SELECT DISTINCT YEAR(collect_date) AS year FROM collection_record";
$result = mysqli_query($dbconn, $query);

if ($result) {
    $years = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $years[] = $row['year'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoXchange | Reports</title>
    <!-- ===== BOX ICONS ===== -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../style/SidebarUser.css">
    <link rel="stylesheet" href="../style/reports.css">
</head>
<body>
    
    <!-- =============== Navigation ================ -->
    <div class="container">
        <?php include('sidebar-1.php'); ?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <?php include('header.php'); ?>
            <!-- ============== Content ============== -->
            <div class="content">
                <div class="nav-title"><h3>Reports</h3></div>  
                <div class="box1">
                    <!-- Add year selection -->
                       <div class="select-year">
                          <label for="yearSelect">Select Year:</label>
                          <select id="yearSelect">
                          <?php foreach ($years as $yr): ?>
                            <option value="<?php echo $yr; ?>" <?php echo $yr == $year ? 'selected' : ''; ?>><?php echo $yr; ?></option>
                          <?php endforeach; ?>
                          </select>
                        </div>
                    <?php if($view=='monthly'): ?>
                    <div class="overall-sales">
                        Overall Sales
                        <p>RM <?php echo $total_sales; ?></p>
                    </div>
                    <?php endif; ?>
                    <canvas id="salesChart" style="width:100%;max-width:700px"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!-- Sales chart -->  
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesData = <?php echo $sales_json; ?>;
        var labels, values;

        if (salesData.length > 0 && salesData[0].hasOwnProperty('year')) {
            // Yearly data
            labels = salesData.map(d => d.year);
            values = salesData.map(d => d.total_sales);
        } else {
            // Monthly data
            labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
             var values = [];
                for (var index = 0; index < labels.length; index++) {
                    var salesValue = salesData[index + 1] || 0; // Get sales data for the current month
                    values.push(salesValue); // Add the sales value to the values array       
               }

        }

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: salesData.length > 0 && salesData[0].hasOwnProperty('year') ? 'Yearly Sales (RM)' : 'Monthly Sales (RM)',
                    data: values,
                    backgroundColor: '#94AB6F',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                legend: { display: false },
                title: {
                    display: true,
                    text: salesData.length > 0 && salesData[0].hasOwnProperty('year') ? 'Yearly Sales' : 'Monthly Sales'
                },
                layout: {
                    padding: {
                        left: 50,
                        right: 50,
                        top: 50,
                        bottom: 50
                    }
                }
            }
        });

        document.getElementById('yearSelect').addEventListener('change', function() {
            var year = this.value;
            window.location.href = 'reports.php?year=' + year;
        });
    });
    </script>
     
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
