<!DOCTYPE html>
<html>
<head>
    <title>Top Deptl Offices</title>
    
    <style>
        /* Add some basic CSS for layout */
.container {
    display: flex;
    justify-content: space-between;
    padding: 20px;
    background-color: #f0f0f0;
}

.office-list {
    width: 100%;
    padding: 10px;
    margin-top:-20px;
    border: 1px solid #000000;
    background-color: #fff;
}

.office-list h2 {
    margin: 0;
    padding-bottom: 10px;
    font-size: 30px;
    text-decoration: underline;
    color:red;
    border-bottom: 1px solid #ddd;
}



body {
            padding: 20px;
            background-color: #f0f0f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 26px; /* Increase the font size to 16px */
        }

table, th, td {
    border: 1px solid #ddd;
    
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}
/* Decrease column width and center-align "Ser" column */
th:nth-child(4),
td:nth-child(4) {
    text-align: center;
    width: 40px; /* Adjust the width as needed */
}




/* Decrease the width of the "Total Accounts" column */
th:nth-child(3),
td:nth-child(3),
th:nth-child(5),
td:nth-child(5) {
    text-align: center;
    width: 40px; /* Adjust the width as needed */
}
/* Increase the width of the "Office Name" column */
th:nth-child(1),
td:nth-child(1) {
    text-align: left;
    width: 200px; /* Adjust the width as needed */
}
/* Increase the width of the "Office Name" column */
th:nth-child(2),
td:nth-child(2) {
    
    width: 200px; /* Adjust the width as needed */
}



/* Media query for screens smaller than 768px (typical mobile devices) */
    @media (max-width: 768px) {
        /* Remove table headers from mobile view */
        th {
            display: none;
        }

        /* Adjust table cells for mobile view */
        td {
            display: block;
            padding: 5px;
        }

        /* Add some spacing between rows */
        tr {
            margin-bottom: 10px;
        }

        /* Center align text in mobile view */
        td {
            text-align: center;
        }
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="office-list">
            <?php
$officeType = 'H.O'; // Replace with 'S.O' or 'B.O' for other office types
//include 'display_office_type.php';
 include 'display_office_type(%age wise).php';
?>
        </div>
        
        
</body>
</html>
