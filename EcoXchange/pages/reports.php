<?php

// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');

$query = "SELECT 
             MONTH(collect_date) as month, 
             SUM(total_amount) as total_sales 
            FROM collection_record 
            GROUP BY MONTH(collect_date)";

$result = mysqli_query($dbconn, $query);

$monthly_sales = array_fill(1, 12, 0); // Initialize an array to hold sales for each month

// Query to fetch sales data
$query_total_sales  = "SELECT SUM(total_amount) AS total_sales FROM collection_record";
$result_total_sales = mysqli_query($dbconn, $query_total_sales);
// Fetch the total sales from the result set
$total_sales_row = mysqli_fetch_assoc($result_total_sales);
// Extract the total sales value
$total_sales = $total_sales_row['total_sales'];

while ($row = mysqli_fetch_assoc($result)) {
    $monthly_sales[$row['month']] = $row['total_sales'];
}

// Encode the data to JSON format to use in JavaScript
$monthly_sales_json = json_encode(array_values($monthly_sales));

//query to fetch years from database
$query = "SELECT DISTINCT YEAR(collect_date) AS year FROM collection_record";
$result = mysqli_query($dbconn, $query);

//if successfull
if ($result)
{
    $years=array();

    //fetch each year and store in array
    while ($row = mysqli_fetch_assoc($result)){
        $years[]=$row['year'];
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
                <!-- Chart canvas -->   
                <div class="box1">
                <canvas id="monthlyChart" style="width:100%;max-width:700px"></canvas>
                    <div class="overall-sales">
                        Overall Sales
                        <p>RM <?php echo $total_sales; ?></p>
                    </div>
                    <div class="list-button">
                        <button class="button-year">
                            <?php echo $years[0]; ?>
                        </button>
                            <!-- list down??-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('monthlyChart').getContext('2d');
        var yValues = <?php echo $monthly_sales_json; ?>;
        var backgroundColor = Array(12).fill('#94AB6F'); //all 12months in the same color//

        var monthlyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Monthly Sales (RM)',
                    data: yValues,
                    backgroundColor: backgroundColor,
                    
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
                    text: 'Monthly Sales'
                },
                layout:{
                    padding: {
                        left: 50,
                        right:50,
                        top:50,
                        bottom:50
                    }
                }
            }
        });
    });
    </script>


    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>