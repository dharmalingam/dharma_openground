<?php echo $this->load->view("blog/header");?>

<style  type="text/css">
* {
	margin:0;
	padding:0;
}
body {
	background:#e0e0e0;
	font:normal 11px/1.5em Arial, Helvetica, sans-serif;
}
a {
	outline:none;
}
#tabContaier {
	background:#99958B;
	border:1px solid #fff;
	margin:100px auto;
	padding:20px;
	position:relative;
	width:900px;
}
#tabContaier ul {
	overflow:hidden;
	border-right:1px solid #fff;
	height:35px;
	position:absolute;
	z-index:100;
}
#tabContaier li {
	float:left;
	list-style:none;
}
#tabContaier li a {
	background:#ddd;
	border:1px solid #fcfcfc;
	border-right:0;
	color:#666;
	cursor:pointer;
	display:block;
	height:35px;
	line-height:35px;
	padding:0 30px;
	text-decoration:none;
	text-transform:uppercase;
}
#tabContaier li a:hover {
	background:#A52511;
	color:#FFFFFF; 
	font:bold;
}
#tabContaier li a.active {
	background:#fbfbfb;
	border:1px solid #fff;
	border-right:0;
	color:#333;
}
.tabDetails {
	background:#fbfbfb;
	border:1px solid #fff;
	margin:34px 0 0;
	height:700px; 
	width:700px;
	font: Geneva, Arial, Helvetica, sans-serif;
}
.tabDetails h2{
font:Arial, Helvetica, sans-serif;


  
  
}
.tabContents {
	padding:20px
}
.tabContents h1 {
	font:normal 24px/1.1em Georgia, "Times New Roman", Times, serif;
	padding:0 0 10px;
}
.tabContents p {
	padding:0 0 10px;
}
</style>
<script  type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

<div id="blogContainer">

<div id="tabContaier">

 <div class="tabDetails" >
 <br>
	<p> <h2>All Forums</h2></p>
    <hr color="#C6C6C6"/>
    
  </div>


</div>

<div id="sidebarContainer" >
<?php //echo $this->load->view("blog/sidebar");?>
</div>

</div>





<?php echo $this->load->view("blog/footer");?>