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
	background:#f0f0f0;
	border:1px solid #fff;
	margin:100px auto;
	padding:20px;
	position:relative;
	width:700px;
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
  <ul>
    <li><a class="active" href="#tab1" id="1">Blog</a></li>
    <li><a href="#tab2" id="2">Products</a></li>
    <li><a href="#tab3" id="3">About</a></li>
  </ul>
  <div class="tabDetails">
    <div id="tab1" class="tabContents" style="height:auto; width:610px;" > 
    
     <?php if(count($post_list)==0)echo "<h3>There is no post created yet.</h3>";?>
   
     <br>
     <?php foreach($post_list as $post){?>
     
      <hr color="#A52511"/>
    	 <p>
         	
             <h2><?php echo $post->title;?></h2>
             
             <div style="float:right"><?php echo date("F d,Y",strtotime($post->created_date)) ;?></div>
             <br/><br/>
             
         	<div  style="text-align:justify; width:510px; height:auto">
            
         	 <?php echo $post->content;?>
             
             </div>
          
             
             
         </p>
     
     <?php }?>
    
    
    </div>
    
    
    
    <div id="tab2" class="tabContents" style="height:auto; width:610px; text-align:justify">

     
          <font color="#A52511" size="+5">:( </font>We are working on this script<br> <font color="#A52511" size="+5">:) </font> We will update you shortly

    </div>
    
    
    
    <div id="tab3" class="tabContents">
    

    
          Are you ready to take your business to new heights and penetrate the global market? A solid online presence is what you need to get started. But with all the competing online sites today, you just don't need any site -- that is, if you seriously want to stand out and make your target market and competitors take instant notice. You need a second to none Web Development Company, India!
          <br>

We at Cogzidel Technologies Private Limited thoroughly understand this need. A leading professional web development company in India, Cogzidel offers you unparalleled expertise and extensive experience to not just get you started, but to give you that cutting edge advantage your online business needs to hit the ground running.
	 
    
    </div>
    
  </div>
</div>

<div id="sidebarContainer" >
<?php echo $this->load->view("blog/sidebar");?>
</div>

</div>


<script type="text/javascript">
	$(document).ready(function(){
	
		$("#tab2,#tab3").hide();
		
		$('a#2,a#3').removeClass("active");
		//1.Tab one
		$("a#1").click(function(){ 
			$("#tab2,#tab3").hide();
			$('#tab1').fadeIn(1000);
			$('a#2,a#3').removeClass("active");
			$('a#1').addClass("active");
			
		});
		
		//2.Tab Two
		$("a#2").click(function(){ 
			$("#tab1,#tab3").hide();
			$('#tab2').fadeIn(1000);
			$('a#1,a#3').addClass("hide");
			$('a#1,a#3').removeClass("active");
			$('a#2').addClass("active");
			
			
		});

		//1.Tab Third
		$("a#3").click(function(){ 
			$("#tab1,#tab2").hide();
			$('#tab3').fadeIn(1000);
			$('a#1,a#2').removeClass("active");
			$('a#3').addClass("active");
			
		});

		
	});
</script>


<?php echo $this->load->view("blog/footer");?>