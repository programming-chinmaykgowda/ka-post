<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kar-POSB</title> <!-- CSS -->
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <h1 class="header">South Karnataka Region POSB Monitoring Portal</h1>
  <div class="main-container">
    <marquee width="100%" direction="left" scrollamount="5" height="20px"> Region/Division/Sub Division wise POSB
      performance analysis report </marquee>
    <div class="container-flex">
      <div class="sub-container"> <!-- POSB Reports Section -->
        <div class="main-button" onclick="toggleSubButtons('main2')">POSB Reports</div>
        <div class="sub-buttons" id="main2">
          <div class="sub-button" onclick="toggleSubSubButtons('sub2_link3')">2024-2025</div>
          <div class="sub-sub-buttons" id="sub2_link3"> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/posb-new-accounts1/index.php">POSB New A/cs</a> <a
              class="sub-sub-button" href="https://dopindia.com/ka-post/reports/2024-25/ssa-new-accounts/index.php">SSA
              New Accounts</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/mssc-new-accounts/index.php">MSSC New Accounts</a> <a
              class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/posb-category-wise/index.php">New A/cs Category
              wise</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/posb-net-addition/index.php">POSB Net Addition
              Report</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/new-accounts-monthwise/index.php">POSB New A/cs month
              wise</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/net-addition-monthwise/index.php">POSB Net addition
              monthwise</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/posb-dashboard/index.php">POSB Dashboard</a> </div>
          <!-- Additional Years -->
          <div class="sub-button" onclick="toggleSubSubButtons('sub2_link1')">2023-2024</div>
          <div class="sub-sub-buttons" id="sub2_link1"> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2023-24/posb-new-accounts/index.php">POSB New A/cs</a> <a
              class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2023-24/posb-category-wise/index.php">New A/cs Category
              wise</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2023-24/posb-net-addition/index.php">POSB Net Addition
              Report</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2023-24/posb-dashboard/index.php">POSB Dashboard</a> </div>
          <div class="sub-button" onclick="toggleSubSubButtons('sub2_link2')">2022-2023</div>
          <div class="sub-sub-buttons" id="sub2_link2"> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2022-23/index.php">New A/cs Category wise</a> </div>
        </div> <!-- Top Performers Section -->
        <div class="main-button" onclick="toggleSubButtons('main10')">Top Performers</div>
        <div class="sub-buttons" id="main10">
          <div class="sub-button" onclick="toggleSubSubButtons('sub10_link1')">2024-2025</div>
          <div class="sub-sub-buttons" id="sub10_link1"> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/top-performing/posb-top-performer-region/index.php">POSB
              Top 3 offices in Region</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/top-performing/ssa-top-performer-region/index.php">SSA
              Top 3 offices in Region</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/top-performing/mssc-top-performer-region/index.php">MSSC
              Top 3 offices in Region</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/top-performing/posb-top-performer-division/index.php">POSB
              Top 3 offices in Division</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/top-performing/ssa-top-performer-division/index.php">SSA
              Top 3 offices in Division</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2024-25/top-performing/mssc-top-performer-division/index.php">MSSC
              Top 3 offices in Division</a> </div> <!-- Additional Years -->
          <div class="sub-button" onclick="toggleSubSubButtons('sub10_link2')">2023-2024</div>
          <div class="sub-sub-buttons" id="sub10_link2"> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2023-24/top-performing/top3-ho-so-bo-region/index.php">Top
              Performers in Region</a> <a class="sub-sub-button"
              href="https://dopindia.com/ka-post/reports/2023-24/top-performing/top3-ho-so-bo-division-sk/index.php">Top
              Performers in Division</a> </div>
        </div> <!-- Monitoring Links Section -->
        <div class="main-button" onclick="toggleSubButtons('main4')">Monitoring Links</div>
        <div class="sub-buttons" id="main4">
          <div class="sub-button" onclick="toggleSubSubButtons('sub4_link1')">Daily Monitoring</div>
          <div class="sub-sub-buttons" id="sub4_link1"> <a class="sub-sub-button"
              href="https://mis.cept.gov.in/pma/pma.aspx">PMA Monitoring</a> <a class="sub-sub-button"
              href="https://mis.cept.gov.in/Techops-dashboard.aspx">Tech-OPS Report</a> <a class="sub-sub-button"
              href="https://mis.cept.gov.in/MMU/MMU_division.aspx">MMU Reports</a> <a class="sub-sub-button"
              href="https://mis.cept.gov.in/CBS/Dbt_Dash.aspx">CBS-MIS</a> <a class="sub-sub-button"
              href="https://bi.indiapost.gov.in/BOE/BI">BI Reports</a> </div>
        </div> <!-- Additional Sections --> <!-- Add remaining sections here following the same format -->
        <div class="main-button" onclick="toggleSubButtons('main6')">SAP</div>
        <div class="sub-buttons" id="main6">
          <div class="sub-button" onclick="toggleSubSubButtons('sub6_link2')">SAP Reports</div>
          <div class="sub-sub-buttons" id="sub6_link2"> <a class="sub-sub-button"
              href="https://sapep.indiapost.gov.in:8065/sap/bc/gui/sap/its/webgui?~TRANSACTION=&sap-client=400&sap-language=EN#">
              SAP Login </a> <a class="sub-sub-button" href="https://sapep.indiapost.gov.in/irj/portal">Employee
              Portal</a> </div>
        </div>
        <div class="main-button" onclick="toggleSubButtons('main8')">Miscellaneous</div>
        <div class="sub-buttons" id="main8">
          <div class="sub-button" onclick="toggleSubSubButtons('sub8_link1')">Reports</div>
          <div class="sub-sub-buttons" id="sub8_link1"> <a class="sub-sub-button"
              href="https://dopindia.com/hassan-division-emp-corner.php">DOP Employee Corner</a> <a
              class="sub-sub-button"
              href="https://drive.google.com/drive/u/3/folders/1YD6n0nc2Ait-aJXCR0DVP6WNh01rDy_z">Forms/Applications</a>
            <a class="sub-sub-button"
              href="https://drive.google.com/file/d/1H1j9tdAyYQsyQ3DJHDh-w16EjlhNz_uP/view?usp=drive_link">Holiday List
              2025</a>
          </div>
        </div>


        
        <div class="main-button" onclick="toggleSubButtons('main11')">Admin</div>
        <div class="sub-buttons" id="main11">


          <div class="sub-button" onclick="toggleSubSubButtons('sub11_link1')">Data Uplaod </div>
          <div class="sub-sub-buttons" id="sub11_link1">
          <a class="sub-sub-button" href="https://dopindia.com/ka-post/reports/2024-25/data-import-tool/upload.php">
            POSB Report 2024-25</a>

        </div>
      </div>

    </div> <!-- Visitor Counter -->
    <div class=" view-count-div">
      <?php $con = mysqli_connect('localhost', 'root', '', 'u562946175_kapost');
      $sql = 'SELECT * from tbl_visitor1';
      $res = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($res);
      $counter = str_pad($row[0], 9, '0', STR_PAD_LEFT);
      $up_count = $row[0] + 1;
      $sql = "UPDATE `tbl_visitor1` SET `count`= '$up_count' WHERE 1";
      mysqli_query($con, $sql); ?>
      <div class='view-count'>
        <h7 class='text-danger'>Total Page Views:</h7>
        <table class='text-white bg-info table-sm'>
          <tr> <?php foreach (str_split($counter) as $digit): ?>
              <td style='border:1px solid yellow'><?php echo $digit; ?></td> <?php endforeach; ?>
          </tr>
        </table>
      </div>
    </div>
  </div>
  </div>
  <p class="pBottom">Designed & maintained by: AB Kantharaja, ASP, O/o PMG SK Region, Bangalore</p> <!-- Scripts -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script> var previousSubButtons = null; var previousSubSubButtons = null; function toggleSubButtons(mainId) { var subButtons = document.getElementById(mainId); if (previousSubButtons && previousSubButtons !== subButtons) { previousSubButtons.style.display = 'none'; } subButtons.style.display = subButtons.style.display === 'flex' ? 'none' : 'flex'; previousSubButtons = subButtons; if (previousSubSubButtons) { previousSubSubButtons.style.display = 'none'; } } function toggleSubSubButtons(subId) { var subSubButtons = document.getElementById(subId); if (previousSubSubButtons && previousSubSubButtons !== subSubButtons) { previousSubSubButtons.style.display = 'none'; } subSubButtons.style.display = subSubButtons.style.display === 'flex' ? 'none' : 'flex'; previousSubSubButtons = subSubButtons; } </script>
</body>

</html>