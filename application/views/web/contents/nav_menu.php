<div class="card win-nav-menu hide-on-med-and-down border2-1px z-depth-0 zero_margin">
	<div class="pp-container">
		<div class="pp-row zero_margin">
			<div class="nav-menus">
				<div class="nav_wrapper ">
					<ul class="valign-wrapper font-karla">
						<li><a href="<?php echo site_url(); ?>"><i class="fa font24 fa-home" aria-hidden="true"></i></a></li>
						<?php
$positions = $menu_data['position'];
$links     = json_decode(stripslashes($menu_data['links']));
$names     = json_decode(stripslashes($menu_data['names']));
$types     = json_decode(stripslashes($menu_data['types']));
foreach ($positions as $key => $value) {
	?>
	<li>
	<?php
if (!empty($links->$value['id'])) {
		echo '<a href="';
		echo (filter_var($links->$value['id'], FILTER_VALIDATE_URL)) ? $links->$value['id'] : site_url($links->$value['id']);
		echo '">';
	}
	echo $names->$value['id'];
	echo (isset($links->$value['id'])) ? '</a>' : '';
	if (isset($value['children'])) {
		?>
<ul class="z-depth-1">
<?php
foreach ($value['children'] as $key1 => $value1) {
			?>
<li>
<div class="pp-col zero_margin z-depth-0 p-padding_10 card ps12">
<ul>
<?php
if (isset($value1['children'])) {
				foreach ($value1['children'] as $key2 => $value2) {
					echo ($types->$value2['id'] == 'title') ? '<li class="font18 title p-padding_7">' : '<li>';
					if (!empty($links->$value2['id'])) {
						echo '<a class="zero_padding li_link" href="';
						echo (filter_var($links->$value2['id'], FILTER_VALIDATE_URL)) ? $links->$value2['id'] : site_url($links->$value2['id']);
						echo '">';
					}

					echo $names->$value2['id'];
					echo (isset($links->$value2['id'])) ? '</a>' : '';
					echo "</li>";
				}
			}
			?>
</ul>
</div>
</li>
	<?php }?>
</ul>
<?php }
	?>
	</li>
<?php }
?>



				</ul>
			</div>
		</div>
	</div></div></div>
	<style type="text/css">
	.nav-menus{
	width: 100%;
	}
	.nav-menus>.nav_wrapper{
		margin: 0 auto;
		padding: 0px 45px;
		text-align: left;
	}
		.nav-menus>.nav_wrapper>ul{
			padding: 0px;
			list-style-type: none;
			margin: 0px;
			position: relative;
		}
		.nav-menus>.nav_wrapper>ul>li{
			-webkit-transition: all .40s ;
			-moz-transition: all .40s ;
			-ms-transition: all .40s ;
			-o-transition: all .40s ;
			transition: all .40s ;
			display: inline-block;
		}
		.nav-menus>.nav_wrapper>ul>li:hover{
			background-color: #ddd;
		}
		.nav-menus>.nav_wrapper>ul>li>a{
			color: #545454;
			display: block;
			text-transform: uppercase;
			cursor: pointer;
			padding: 15px;
	/* 		font-family: "dosis",sans-serif; */
			font-size: 14px;
			font-weight: 600;
			letter-spacing: 1.2px;
			text-decoration: none;
		}
		.nav-menus>.nav_wrapper>ul>li a:hover{
			color: #333;
		}
		.nav-menus>.nav_wrapper>ul li:hover>ul{
			display: inline-flex;
		}
		.nav-menus>.nav_wrapper>ul>li>ul{
	position: absolute;
	display: none;
	z-index: 101;
	background-color: #fff;
	border-bottom: 2px solid rgb(152,25,55);
		}
		.nav-menus>.nav_wrapper>ul>li>ul>li{
	display: inline-block;
	width: 240px;
		}
		.nav-menus>.nav_wrapper>ul>li>ul>li ul li{
			padding: 5px 15px;
			-webkit-transition: all .40s ;
			-moz-transition: all .40s ;
			-ms-transition: all .40s ;
			-o-transition: all .40s ;
			transition: all .40s ;
			border-bottom: 1px solid #fff;
		}
		.nav-menus>.nav_wrapper>ul>li>ul>li ul li>a.li_link{
		color: #333;
		font-size: 14px;
		/* font-family: "Fira Sans",sans-serif; */
		transition: all .40s;
		}
		.nav-menus>.nav_wrapper>ul>li>ul>li ul li>a.li_link:hover{
cursor: none;
		color: rgb(152,25,55);
		}

		.nav-menus>.nav_wrapper>ul>li>ul>li ul li:hover a{
	/* background-color: #fff; */
	color: rgb(152,25,55);
		}
		.nav-menus>.nav_wrapper>ul>li>ul>li .title{
	color: rgb(152,25,55);
	font-weight: 500;
	border-bottom: 1px solid rgb(152,25,55);
	/* font-family: 'Raleway', sans-serif; */
		}
		.nav-menus>.nav_wrapper>ul>li>ul>li{
			/* width: 210px; */
		}
		.nav-menus>.nav_wrapper>ul>li>ul>li .card{
		}

.fixed {
    position: fixed;
    top: 0;
    z-index: 1002;
    width: 100%;
}
	</style>
	<!-- .nav-menus>.nav_wrapper>ul li

.nav-menus>.nav_wrapper>ul>li>ul
.nav-menus> .nav_wrapper > ul > li > ul > li .title -->
	<script>
$(document).ready(function() {

	var navigation = $('.win-nav-menu');
var navPositon = navigation.offset().top;

var setNavFixed = function() {
    if($(this).scrollTop() >= navPositon) {
        navigation.addClass('fixed');
    } else {
        navigation.removeClass('fixed');
    }
}
    $(window).scroll(function() {
        setNavFixed();
    });


	// border-bottom: 2px solid rgb(164,206,46);
$(".nav-menus>.nav_wrapper>ul>li").hover(function() {

}, function() {
	var newColor = '#'+(0x1000000+(Math.random())*0xffffff).toString(16).substr(1,6);
// $(".nav-menus > .nav_wrapper > ul > li > ul").css('border-bottom', '3px solid '+newColor);
// $(".nav-menus>.nav_wrapper>ul>li>ul>li .title").css('border-bottom', '1px solid '+newColor);
// $(".nav-menus>.nav_wrapper>ul>li>ul>li .title").css('color', newColor);
});
		});
	</script>