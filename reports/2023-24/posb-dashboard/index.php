<!DOCTYPE html>
<html>
	<head>
		<title>POSB Dashboard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <style>
    	
			h1 {
				width: 100%;
				background: #940404;
				color: #f8f7f7;
				padding: 0.5rem 1rem;
				font-family: Poppins;
				font-size: 20px;
				font-weight: bold;
				box-sizing: border-box;
				text-align: center;
				margin-top: 10px;
				margin-bottom: 20px;
			}
    	
    	#app > .table > .table-row:nth-child(1) {
    		position: sticky;
    		top: 0;
    		z-index: 9;
    		left: 0;
    		border-top-color: #ccc;
			
    	}
    	
    	#app > .table > .table-row:last-child {
    		/* position: sticky; */
    		bottom: 0;
    		z-index: 9;
    		left: 0;
    	}
    	
    	.table .table-row {
    		display: grid;
    		background: #fff;
    		border: 1px solid #ccc;
    		border-top-color: transparent;
    		grid-template-columns: 1fr 5vw 6vw 6vw 7vw 8vw 8vw 8vw 8.5vw 8.5vw 5vw 5.5vw;	
    	}
    	
    	.table > .table-row {
    		background:#1c8282;
    	}
    	
    	.table > div > .table-row >h3{
    		background: #fff0f5;
    		color:#000000;
    	}
    	
    	.table > div > div > .table-row>h3 {
    		background: #f0ffff;
    		color: #00008b ;
    	}
    	
    	.table > div > div > div > .table-row>h3 {
    		background: #f5f0e4;
    		color: #69359c;
    	}
    	
    	.table > div > div > div > div > .table-row >h3 {
    		background: #F6EEF9;
    		color:#008080 ;
    	}
    	
    	.table > .table-row:last-child {
    		background: #b9f2ff ;
    	}
    	
    	.table > .table-row:nth-child(1) > h3 {
    		font-size: 1.30vw;
    		color: #ffffff;
    		
    	}
    	
    
       
        
    	
    	.table > .table-row:last-child > h3 {
    		font-size: 1.30vw;
    		color: #ff0000;
    	}
    	
    	.table .table-row h3 {
    		color: #000;
    		border-right: 1px solid #ccc;
    		padding: 0.5vw 0.7vw;
    		word-break: break-all;
    		font-size: 1.1vw;
    		margin: 0;
    		text-align: center;
    	}
    	
    	.table .table-row h3:first-child {
    		text-align: left;
    	}
    	
   .table > div > .table-row:nth-child(2) {
    color: red;
}
    	
    	.toggler {
    		background: #fff4;
    		color: #ff0000;
    		outline: none;
    		border: 1px solid #000000;
    		border-radius: 5px;
    		width: 1.8vw;
    		height: 1.8vw;
    		margin-right: 0.3vw;
    	}
    	
    	.table .table-row h3:last-of-type {
    		border-right: none;	
    	}
    	
    	
			select {
				width: 14rem;
				color: #000000;
				/* Set a maximum width if necessary */
				font-weight: 500;
				padding: 8px;
				border: 1px solid #ccc;
				border-radius: 4px;
				background-color: #fff;
				font-size: 16px;
				margin-left: 10px;
			
			}
			/*Mobile responsive*/
			
			@media screen and (max-width: 900px) and (orientation: portrait) {
			    
			 
				h1 {
					font-size: 3vh;
				}
	    	
	    	.table > div {
	    		overflow-x: auto;
	    		overflow-y: auto;
	    	}
			
				.table .table-row {
				    /* This is old- below is new grid-template-columns:30vh 10vh 10vh 11vh 12vh 13vh 13vh 15vh 17.5vh 18vh 10vh 20vh;*/
					grid-template-columns:30vh 10vh 10vh 11vh 12vh 12vh 13vh 14vh 16vh 12vh 8vh 34vh;
					
					width: 181vh;
				}
				
				.table > .table-row {
					width: 100%;
					overflow-x: auto;
					overflow-y: clip;
				}
				
				.table .table-row > h3:first-child {
					position: sticky;
					background: inherit;
					left: 0;
				}
			/*Region name color*/	
			.table > div > div > .table-row>h3 {
    		background: #f0ffff;
    		color: #00008b ;
    	}
				
				
				.table .table-row h3 {
					font-size: 2vh;
					word-break: no-break;
				}
				
				.table > .table-row:nth-child(1) > h3 {
	    		font-size: 2.3vh;
	    		color: #ffffff;
	    	}
	    	
	    	.table > .table-row:last-child > h3 {
	    		font-size: 2.3vh;
	    		color: #ff0000;
	    	}
	    	
	    	.toggler {
	    		width: 3vh;
	    		height: 3vh;
	    		margin-right: 1vh;
	    	}
			}
			
			
			
			/*Portriot responsive*/
			@media screen and (max-height: 527px) and (orientation: landscape) {
			
			h1 {
					font-size: 5vh;
				}
			
			.table .table-row {
    		display: grid;
    		background: #fff;
    		border: 1px solid #ccc;
    		border-top-color: transparent;
    		grid-template-columns: 35vh 4vw 7vw 7vw 8vw 8vw 8vw 9vw 10vw 8.5vw 5vw 6vw;	
    	}	
			
			.table > .table-row {
    		background:#1c8282;
    	}
    	
    	.table > div > .table-row {
    		background: #fff0f5;
    		
    	}
    	
    	.table > div > div > .table-row {
    		background: #f0ffff;
    	}
    	
    	.table > div > div > div > .table-row {
    		background: #f5f0e4;
    	}
    	
    	.table > div > div > div > div > .table-row {
    		background: #f0e4f5;
    	}
    	
    	.table > .table-row:last-child {
    		background: #b9f2ff ;
    	}
    	
    	.table > .table-row:nth-child(1) > h3 {
    		font-size: 1.50vw;
    		color: #ffffff;
    	}
    	
    	.table > .table-row:last-child > h3 {
    		font-size: 1.50vw;
    		color: #ff0000;
    	}	
    	
    		.table .table-row h3 {
    		color: #000;
    		border-right: 1px solid #ccc;
    		padding: 0.5vw 0.7vw;
    		word-break: break-all;
    		font-size: 1.3vw;
    		margin: 0;
    		text-align: center;
    	}
    	
    	
    	.toggler {
    		background: #fff4;
    		color: #ff0000;
    		outline: none;
    		border: 1px solid #000000;
    		border-radius: 5px;
    		width: 1vw;
    		height: 2.4vw;
    		margin-right: 0.3vw;
    		Margin-left: -0.5vw;
    	}
    	
    	.table .table-row h3:last-of-type {
    		border-right: none;	
    	}
			}
    	
			
    </style>
    
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
	</head>
	<body>
		<h1>POSB Monitoring Dashboard  South Karnataka Region as on 31.03.2024</h1>
		<div id="app"></div>
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="monitoroffices.js"></script>
	</body>
</html>