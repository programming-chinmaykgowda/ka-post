<!DOCTYPE html>
<html>
  <head>
    <title>Net Addition Month wise</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
    <script src="main.js"></script>
    <!--<link rel="stylesheet" href="style.css" />-->
    <script id="wpcp_disable_Right_Click" type="text/javascript">
      //<![CDATA[
      document.ondragstart = function() { return false;}
      /* ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
      Disable context menu on images by GreenLava Version 1.0
      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^ */
          function nocontext(e) {
             return false;
          }
          document.oncontextmenu = nocontext;
      //]]>
    </script> 
    
     <style> 
    
    
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

/* Basic layout */
body {
	font-family: Arial, sans-serif;
	background-color: #fff;
}

#search-container {
  display: flex;
  align-items: center;
  justify-content: flex-start;
  flex-wrap: wrap;
  margin-bottom:-5px;
}

.inputbox {
  outline: none;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-left: 3%;
  padding: 0.4vw 0.7vw;
  display: inline;
  width: 20%;
  margin-top:-10px;
  margin-bottom:-10px;
}

/* Dropdown styles */
/* Dropdown styles */
label,
select {
	margin-bottom: 10px;
	margin-left: 10px;
	font-weight: bold;
	color: #0000CD;
}

select {
	width: 50%;
	max-width: 160px;
	/* Set a maximum width if necessary */
	padding: 8px;
	border: 1px solid #ccc;
	border-radius: 4px;
	background-color: #fff;
	font-size: 16px;
	margin-left: 10px;
}

/* Button styles */
button {
	padding: 8px 20px;
	background-color: #b22222;
	color: #fff;
	border: none;
	border-radius: 4px;
	font-size: 1.2vw;
	font-weight: bold;
	cursor: pointer;
	margin-left: 20px;
	/* Adjust the margin value as needed */
	transition: 0.3s linear;
}

button:hover {
	background-color: #0056b3;
}

/* Increase font size for specific dropdowns */
select {
	/* Adjust the value as needed */
	color: #000000;
	font-weight: normal;
}

body {
	font-family: Arial, sans-serif;
}

h1 {
	width: 100%;
	background: #B22222;
	color: #f8f7f7;
	padding: 0.5rem 1rem;
	font-family: Poppins;
	font-size: 24px;
	font-weight: bold;
	box-sizing: border-box;
	text-align: center;
	margin-top: 10px;
	margin-bottom: 20px;
}



h3 {
	
		text-align: left;
		color:red;
		margin-top:-8px;
		margin-bottom:5px;
	}


label {
	margin-right: 10px;
}

select {
	padding: 0.44vw;
	max-width: 260px;
	font-size: 0.82vw;
	margin-right: 10px;
	width: 100%;
	border: 2px solid pink;
	border-bottom-width: 4px;
	border-radius: 4px;
	background-color: #fff;
	font-size: 15px;
	margin-left: 10px;
}

/* Table styles */

.table-container {
    max-height: 400px; /* Adjust the maximum height as needed */
    overflow-y: auto; /* Enable vertical scrolling */
  }




.sticky-row {
    position: sticky;
    top: 0; /* Stick to the top of the container */
    z-index: 1; /* Ensure the first row is on top of the content */
    background-color: #fff; /* Optional: Set background color for the sticky row */
  }


table {
	width: 100%;
	border-collapse: collapse;
	margin-top: 20px;
}

th,
td {
	border: 1px solid #000000;
	padding: 0.3vw 0.4vw;
	text-align: left;
	font-size: 1.1vw;
	color: black;
	/* Set the text color to black */
}

th {
	background-color: #e3dac9;
	color: #b22222;
	text-align: center;
	padding: 0.5vw 0.4vw;
	/* Center-align the table headings */
}

td {
	text-align: center;
}

td:first-of-type {
	text-align: left;
	padding: 0.4vw 1vw;
}

tr:last-of-type>td {
	font-size: 1.15vw;
}

th,
td.total-cell {
	color: #b22222
}

.total-cell {
	font-weight: bold;
}

 .left-align {
        text-align: left;
    }



#buttons {
	display: inline-block;
}

#showingresults {
	margin-left: 0.6vw;
	display: inline;
}

#options-container {
	padding: 0.4vw 0.7vw 0.7vw 0.7vw;

	border: 1px solid #b213bcc9;
	border-bottom-width: 2px;
	border-radius: 20px;
	margin-bottom: 20px;
	background-color: #f9f9f9;
}

#options-container #dataavailablefrom,
#options-container #dataavailableupto {
	font-size: 0.8vw;
	margin-top: 0;
	margin-bottom: 0.3vw;
}

#options-container #dataavailablefrom {
	color: #dd0d7efc;
}

#options-container #dataavailableupto {
	color: #2327ca;
	margin-bottom: 2vw;
}

th {
	position: relative;
}

th .sort-icons {
	position: absolute;
	right: 0.1vw;
	display: flex;
	flex-direction: column;
	top: 50%;
	transform: translateY(-80%);
}


th .sort-icons .asc-sort-icon {
	width: 0;
	height: 0;
	border-left: 4px solid transparent;
	border-right: 4px solid transparent;

	border-bottom: 5px solid #988;
}

th .sort-icons .desc-sort-icon {
	margin-top: 3px;
	width: 0;
	height: 0;
	border-left: 4px solid transparent;
	border-right: 4px solid transparent;

	border-top: 5px solid #988;
}

th .sort-icons .asc-sort-icon.active {
	border-bottom: 5px solid #b22222;
}

th .sort-icons .desc-sort-icon.active {
	border-top: 5px solid #b22222;
}

#data {
	width: 100%;
	overflow-x: auto;
}

.dropdown-and-dropdown-buttons {
	display: flex;
	justify-content: space-between;
	flex-wrap: wrap;
}

.dropdown-and-dropdown-buttons>div:first-of-type {
	display: flex;
}

/* Mobile responsiveness */
@media screen and (max-width: 900px) and (orientation: portrait) {

	h1 {
		font-size: 2vh;
		font-weight:bold;
	}
	
	h1 {

	background: #B22222;
	color: #f8f7f7;
	padding: 0.5rem 1rem;
	font-family: Poppins;
/*	font-size: 18px;*/
	font-weight: bold;
	box-sizing: border-box;
	text-align: center;
	margin-top: 10px;
	margin-bottom: 5px;
}
	
	
	

	.dropdown-and-dropdown-buttons>div:first-of-type {
		display: flex;
		flex-wrap: wrap;
	}


	/* Dropdown styles */
	label {
		display: none;
	}

	select {
		display: block;
		margin-bottom: 10px;
		margin-left: 10px;
		width: 100%;
		max-width: 500px;
		/* Set a maximum width if necessary */
		padding: 8px;
		border-radius: 8px;
		border: 1px solid pink;
		border-bottom-width: 2px;
		background-color: #fff;
		font-size: 1.85vh;
		margin-left: 10px;
	}

	/* Button styles */
	button {
		padding: 10px 30px;
		text-align: center;
		background-color: #B22222;
		color: #fff;
		border: none;
		border-radius: 4px;
		font-size: 4.8vw;
		font-weight: bold;
		cursor: pointer;
		margin: 0;
		margin-top:-15px;
		margin-bottom: 0vh;
		/* Adjust the margin value as needed */
	}


select {
	padding: 1.84vw;
	font-size: 0.92vw;
	margin-right: 10px;
	width: 100%;
	border: 2px solid pink;
	border-bottom-width: 4px;
	border-radius: 4px;
	background-color: #fff;
	font-size: 18px;
	margin-left: 10px;
}


	th,
	td {
		font-size: 1.9vh;
	}

	tr:last-of-type>td {
		font-size: 1.98vh;
		padding: 1vh 0.5vh;
	}

	#buttons {
		margin-top: 2.3vh;
		display: flex;
		justify-content: space-around;
		width: 100%;
	}

	button:hover {
		background-color: #0056b3;
	}

	#options-container {
		padding: 0.8vh 0.5vh 0.5vh 0.5vh;
	}

	#options-container #dataavailablefrom,
	#options-container #dataavailableupto {
		font-size: 1.4vh;
	}
	
	.inputbox {
	   width: 90%;
	   margin-top: 0vh;
	   margin-bottom: 2vh;
	   margin-left: 0;
	  padding: 1vh 1.5vh;
	    margin-top:-2px;
      margin-bottom:-10px;
	}
}












@media screen and (max-height: 527px) and (orientation: landscape) {
	button {
		font-size: 3vh;
	}
	
	th,td {
	  font-size: 2vw;
	}
	
	tr:last-of-type > td {
	  font-size: 2.427vw;
	}

	#options-container {
		padding: 0.8vw 0.5vw 0.5vw 0.5vw;
	}

	#options-container #dataavailablefrom,
	#options-container #dataavailableupto {
		font-size: 1.6vw;
	}
}
    @keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .blinking-text {
            animation: blink 1s linear infinite;
        }
    
    
    
    
    
    
    </style>
    
    
    
    
    
    
    
    
  </head>
  <body>
    <h1>POSB net addition month wise for the financial year  2024-25 [Region/Division/Sub Division/AO wise]</h1>
		<div id="options-container">
			<div style="display: flex; justify-content: space-between;">
				<div></div>
				<div style="display: flex; align-items: flex-end; flex-direction: column;">
					<h3 id="dataavailablefrom"> Data Available from: 01/04/2024 </h3>
					<h3 class="blinking-text" id="dataavailableupto">  Data Updated upto: 30/11/2024  </h3>
				</div>
			</div>
	    <div class="dropdown-and-dropdown-buttons">
	    	<div>
			    <select id="region" onchange="loadDivisions()">
			      <option value="all">Select Region</option>
			      <option value="all">All Regions</option>
			    </select>
			    <select id="division" onchange="loadSubdivisions()">
			      <option value="">Select Division</option>
			      <option value="all">All Divisions</option>
			    </select>
			    <select id="subdivision" onchange="loadAONames()">
			      <option value="">Select Sub Division</option>
			      <option value="all">All Sub Divisions</option>
			    </select>
			    <select id="aoname">
			      <option value="">Select Office</option>
			      <option value="all_acs">All Account Offices</option>
			      <option value="all">All Offices</option>
			    </select>
			    <select id="officeType">
			      <option value="all">Select Office Type</option>
			      <option value="all">All</option>
			     
			    </select>
			    <select id="category">
			      <option value="">Select Category</option>
			                
			             <option value="tot_24"> Total A/cs Opened</option>	
			             <option value="apr_24">Apr 24</option>	
                         <option value="may_24">May 24</option>	
                       <option value="jun_24">Jun 24</option>	
                        <option value="jul_24">Jul 24</option>	
                        <option value="aug_24">Aug 24</option>	
                         <option value="sep_24">Sep 24</option>	
                        <option value="oct_24">Oct 24</option>	
                         
          
                       
					
						<option value = "`%age`">Yearly Target Achieved</option>
						<option value = "`%age1`">Proportion Target Achieved</option>					
			    </select>
			    
			    
			    
			    <select id="top-bottom-offices">
			    	<option value="">Select Filter By</option>
			        <option value="top-3">Top 3</option>
			        <option value="top-10">Top 10</option>
			        <option value="top-20">Top 20</option>
			        <option value="bottom-3">Bottom 3</option>
			        <option value="bottom-10">Bottom 10</option
			        <option value="bottom-25">Bottom 20</option>
			       
			        <option value="<= 5000">< 5000</option>
			        <option value="<= 10000">< 10000</option>
			        <option value="<= 15000">< 15000</option>
			        <option value="<= 20000">< 20000</option>
			        <!--<option value="<= 200">< 200</option>-->
			        <!--<option value="<= 500">< 500</option>-->-->
			        <!--<option value="<= 1000">< 1000</option>-->
			        <!--<option value=">= 10">> 10</option>-->
			        <!--<option value=">= 25">> 25</option>-->
			        <option value=">= 5000">> 5000</option>
			        <option value=">= 10000">> 10000</option>
			        
			        <option value=">= 15000">> 15000</option>
			        
			          <option value=">= 20000">> 20000</option>
			        <option value=">= 25000">> 25000</option>
			        <option value=">= 30000">> 30000</option>
			        
			    </select>
			    
			    
			  </div>
		    <div id="buttons">
			    <button onclick="loadData()">Load Data</button>
			    <button onclick="exportToExcel()">Export Data</button>
		    </div>
		 </div>
	 </div>
	 	<div id="search-container">
	    <h3 id="showingresults">Showing </span> results</h3>
	    <input type="text" name="search" id="search" class="inputbox" value="" placeholder="Search..." onkeyup="search()" />
    </div>
   <div class="table-container" id="data"></div>
    <div id="data"></div>
    <input type="text" id="sortBy" value="Name ASC " hidden />
      <h5>Note: The above target & achievement is  including POSB & SSA A/cs excluding MSSC/KVP/NSC.</h5>
  </body>
</html>
