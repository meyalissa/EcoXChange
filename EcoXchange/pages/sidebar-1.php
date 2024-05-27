<div class="navigation">
            <ul>
                <li class = "comp-name">
                    <a href="#">
                        <span class="icon">
                            <img src="../images/logo-white-border.png" class="sidebar-logo" />
                        </span>
                        <span class="title">EcoXchange</span>
                    </a>
                </li>
             

                <li class="active" >
                    <a href="dashboard-1.php">
                        <span class="icon">
                            <i class='bx bx-history'></i>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="items-1.php">
                        <span class="icon">
                            <i class='bx bxl-spring-boot'></i>
                        </span>
                        <span class="title">Items</span>
                    </a>
                </li>

                <li>
                    <a href="Members.php">
                        <span class="icon">
                            <i class='bx bxs-group'></i>
                        </span>
                        <span class="title">Members</span>
                    </a>
                </li>

                <li>
                    <a href="VehicleBooking.php">
                        <span class="icon">
                            <i class='bx bxs-car'></i>
                        </span>
                        <span class="title">Vehicle Booking</span>
                    </a>
                </li>

                <li>
                    <a href="records.php">
                        <span class="icon">
                            <i class='bx bxs-receipt'></i>
                        </span>
                        <span class="title">Collection Records</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" onclick="toggleDropdown()">
                        <span class="icon">
                            <i class='bx bxs-bar-chart-alt-2'></i>
                        </span>
                        <span class="title">Reports</span>
                    </a>
                    <div class="dropdown-content" id="reportsDropDown">
                        <a href="reports.php?view=monthly">Monthly</a>
                        <a href="reports.php?view=yearly">Yearly</a>
                    </div>
                </li>
                <li>
                    <a href="profile.php">
                        <span class="icon">
                            <i class='bx bx-user-circle'></i>
                        </span>
                        <span class="title">Profile</span>
                    </a>
                </li>

                <li class="sign-out">
                    <a href="../includes/logout.inc.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

<style>
/* Dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    z-index: 1;
    top: 0;
    left: 200px; /* Adjust this value to position the dropdown content further to the right */
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
    background-color: #f1f1f1;
}

/* Show the dropdown menu when hovering over the dropdown or the content */
.dropdown:hover .dropdown-content {
    display: block;
}

/* Optional: change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}
</style>     