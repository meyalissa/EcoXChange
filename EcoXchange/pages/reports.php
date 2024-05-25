<?php

// Include database connection and fetch user data
include('../includes/dbconn.php');
include('../includes/fetchUserData.php');

$year = isset($_GET['year']) ?intval($_GET['year']) :date('Y');
$view = isset($_GET['view']) ?$_GET['view'] : 'yearly';


if ($view == 'monthly' && isset($_GET['year'])) {
    $query = "SELECT 
                MONTH(collect_date) as month, 
                COALESCE(SUM(total_amount), 0) as total_sales 
                FROM collection_record
                WHERE YEAR(collect_date) = $year
                GROUP BY MONTH(collect_date)";
}
else {
    $query = "SELECT 
                YEAR(collect_date) as year,
                SUM(total_amount) as total_sales
                FROM collection_record
                GROUP BY YEAR (collect_date)"; 
}

$result = mysqli_query($dbconn, $query);
$sales = array();
// Process fetched data for monthly view
if ($view == 'monthly') {
    $months = range(1, 12); // Array of month numbers from 1 to 12
    $sales = array_fill_keys($months, 0); // Initialize sales array for each month and start with 0
    
    // Iterate over fetched data and populate sales array
    while ($row = mysqli_fetch_assoc($result)) {
        if (isset($row['month'])) {
            $month = $row['month'];
            $sales[$month] = $row['total_sales'];
        }
    }
} else {
    // Process fetched data for yearly view
    $sales = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = array('year' => $row['year'], 'total_sales' => $row['total_sales']);
    }
}


//encode sales data in JSON format for Java Script
$sales_json = json_encode($sales);

//-- overall sales --//
// Query to fetch sales data
$query_total_sales  = "SELECT SUM(total_amount) AS total_sales FROM collection_record";
$result_total_sales = mysqli_query($dbconn, $query_total_sales);
// Fetch the total sales from the result set
$total_sales_row = mysqli_fetch_assoc($result_total_sales);
// Extract the total sales value
$total_sales = $total_sales_row['total_sales'];

// year button//
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
                                    <?php if ($view == 'monthly'): ?>
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
        var view = '<?php echo $view; ?>';

        var labels = view === 'monthly' ? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] : salesData.map(d => d.year);
        var values = view === 'monthly' ? Object.values(salesData): salesData.map(d => d.total_sales);

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: view.charAt(0).toUpperCase() + view.slice(1)+'Sales (RM)',
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
                    text: view.charAt(0).toUpperCase() +view.slice(1) + 'Sales'
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
        document.getElementById('yearSelect').addEventListener('change', function() {
            var year=this.value;
            var view=document.getElementById('viewSelect').value;
            window.location.href = 'reports.php?year=' + year + '&view=' +view;
        });

        document.getElementById('viewSelect').addEventListener('change', function() {
            var view=this.value;
            var year=document.getElementById('yearSelect').value;
            window.location.href = 'reports.php?year=' + year + '&view=' +view;
        });
    });

    function toggleDropdown()
    {
        document.getElementById("reportsDropdown").classList.toggle("show");
    }

    //close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i=0;i<dropdowns.lenght;i++) {
                var openDropdown = dropdowns [i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
    </script>
     
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>