<?php
	header('Content-type: text/css');
?>

#testimonial{
        background-color: #EFEFEF;
        border: 1px solid #EFEFEF;
        -moz-background-clip:border;
        -moz-background-inline-policy:continuous;
        -moz-background-origin:padding;
        -moz-border-radius: 10px;	
		color:#999999;
		margin-left: 40px;
		margin-top: 30px;
        padding: 2px;
		font: 12px Georgia, "Times New Roman", Times, serif;
		letter-spacing: .1em;
		line-height: 1.5em;
        display: inline-block;
        -moz-box-shadow: 0 0 4px #AAAAAA;
}

.cnt{
    -moz-border-radius:5px;	
	color:#666666; 
	padding: 10px 10px 10px 10px;
	width: 500px;
	display: block;
	font-style: italic;
	background-color: #FFF;
}


#tAuthor{ 
background: url(images/PostQuote.png) no-repeat left top;
color: #<?php echo $_GET['author_txt_clr'] ?>; 
font-weight: 600;
padding: 8px 0px 0px 35px;
}

#tCompany{
color: #<?php echo $_GET['cmp_txt_clr'] ?>;
font-weight: 600;
}

#tWebsite{
color: #<?php echo $_GET['web_txt_clr'] ?>;
font-weight: 600;
}

.tTestimonial{
color: #<?php echo $_GET['tetm_txt_clr'] ?>;
display: block;
padding: 10px;
line-height: 20px;
}

#ipAuthor{ 
background: url(images/PostQuote.png) no-repeat left top;
color: #<?php echo $_GET['ipauthor_txt_clr'] ?>; 
font-weight: 600;
padding: 8px 0px 0px 35px;
}

#ipCompany{
color: #<?php echo $_GET['ipcmp_txt_clr'] ?>;
font-weight: 600;
}

#ipWebsite{
color: #<?php echo $_GET['ipweb_txt_clr'] ?>;
font-weight: 600;
}

.ipTestimonial{
color: #<?php echo $_GET['iptetm_txt_clr'] ?>;
display: block;
padding: 10px;
line-height: 20px;
}

#testimonial_author a:visited, #testimonial_author a{
text-decoration: none;
font-weight: normal;
}
.right {float: right}
.left {float: left}

.testimonials-avatar img{
	z-index:4;
	position: absolute;
	opacity: 0.9999;
	padding:3px;	
	border: 1px solid #DADADA;
	background: #FFFFFF;
	-moz-box-shadow: 0 0 4px #AAAAAA;
	float: right;
}

#author-dtls{
	color: #777777;
	font-weight: 600;
}

/************************ ADD FORM CSS *****************************/
#add_form{
	font-size: 12px;
}

#add_form label{
	color: #666666;
	font-weight: bold;
	line-height: 24px;
}

#add_form input[type=text]{
	width: 450px;
	height: 20px;
	color: #6d6d6d;
	padding: 5px;
	font-size: 14px;
	-moz-border-radius:4px 4px 4px 4px;
	background-color:#F5F5F5;
	border:1px solid #CECECE;
	margin-bottom: 10px;
}

#add_form input[type=text]:hover{
	background-color:#F9F9F9;
}

#add_form textarea{
	width: 450px;
	font-size: 14px;
	color: #6d6d6d;
	padding: 5px;
	-moz-border-radius:4px 4px 4px 4px;
	background-color:#F5F5F5;
	border:1px solid #CECECE;
	margin-bottom: 10px;
}

#add_form textarea:hover{
	background-color:#F9F9F9;
}

#add_form #btn{
	-moz-border-radius:20px;
	background-color:#F5F5F5;
	border:1px solid #CECECE;
	padding: 8px;
	font-size: 14px;
	color:#3d3d3d;
	cursor: pointer;
}

#add_form label.error, span.tfImage{display: none!important;}
.block{display: block}
#add_form textarea.error, #add_form input[type=text].error { 
	border: 1px solid #FD0000;
	background-color:#FDBCAC;
	color:#000000;
}

/*********************Widget ********************/
.wAvatar img{
	border: 1px solid #DFDFDF;
	padding: 2px;
	height: 48px;
	display: block;
	float: left;
	margin-right: 5px;
}

#testimonails-widget{
	clear: both;
	display: inline-block;
	padding: 10px 5px 10px 5px;
	width: 98%;
	line-height: 20px;
}

.wTestimonial{
color: #<?php echo $_GET['wtetm_txt_clr'] ?>;
}

.wAuthor{
color: #<?php echo $_GET['wauthor_txt_clr'] ?>;
font-weight: 600;
}

.wCompany{
color: #<?php echo $_GET['wcmp_txt_clr'] ?>;
font-weight: 600;
}

.wWebsite{
color: #<?php echo $_GET['wweb_txt_clr'] ?>;
font-weight: 600;
}

#testimonails-widget a, #testimonails-widget a:hover{
	text-decoration: none;
}

#sidebar .widget{
	background-color:#FFFFFF;
	-moz-border-radius: 10px;
	padding: 10px;
	border: 1px solid #DCDCDC;
}