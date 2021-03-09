<link rel="stylesheet" href="/plugin/owl-carouse/owl.carousel.min.css">
<link rel="stylesheet" href="/plugin/owl-carouse/owl.theme.default.min.css">
<link rel="stylesheet" href="/plugin/animsition/css/animate.css">
<section class="slide-ternimal">
	<div class="gb-slideshow-video">
    	<div class="gb-slideshow-video-slide owl-carousel owl-theme wow slideInUp" data-wow-duration="1s"">
            <div class="item">
                <div class="item-testimonial">
                    <div class="row">
                        <div class="col-md-6 clear-padding">
                            <div class="testimonial-video">
                                <iframe width="100%" height="585" src="https://www.youtube.com/embed/k1n11Pnp8pc" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-md-6 clear-padding">
                            <div class="wp-content-customer">
                                <!-- <h3 class="head-general">CẢM NHẬN CỦA KHÁCH HÀNG</h3> -->
                                <h2 class="text-testimonial-quote"><p>“VTV1 Đài truyền hình Việt Nam nói về Minh Phương qua chương trình CEO- Chìa khóa thành công”</p></h2>
                                <h4 class="name-testimonial">Hơn 21 năm kinh doanh trong lĩnh vực nội thất <br> Sản phẩm chất lương, chính hãng 100% <br>Cung cấp các thiết bị nội vệ sinh tiếng TOTO, INAX độc quyền thiết bị vệ sinh CORNAT (CHLB Đức)</h4>
                            </div>
                        </div>
                    </div>  
                </div>                          
            </div>
    		<div class="item">
    			<div class="item-testimonial">
    				<div class="row">
    					<div class="col-md-6 clear-padding">
    						<div class="testimonial-video">
                                <iframe width="100%" height="585" src="https://www.youtube.com/embed/BygLP-gizrg" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    							<div class="overlay-video"></div>
    						</div>
    					</div>
    					<div class="col-md-6 clear-padding">
    						<div class="wp-content-customer">
    							<h3 class="head-general">CẢM NHẬN CỦA KHÁCH HÀNG</h3>
	    						<h2 class="text-testimonial-quote"><p>“Bà xã rất ưng khi sử dụng sản phẩm của Minh Phương khi cần Minh Phương luôn hỗ trợ
Sắp tới khi xây nhà cho các cháu chắc chắn sẽ chọn Minh Phương.”</p></h2>
	    						<h4 class="name-testimonial">Ông: Nguyễn Văn Hải <br> Bí thư quận Nam Từ Liêm <br>Giám đốc sở quy hoạch kiến trúc Hà Nội</h4>
    						</div>
    					</div>
    				</div>	
    			</div>							
    		</div>
            <div class="item">
                <div class="item-testimonial">
                    <div class="row">
                        <div class="col-md-6 clear-padding">
                            <div class="testimonial-video">
                                <iframe width="100%" height="585" src="https://www.youtube.com/embed/dLKPZrDuTfM" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-md-6 clear-padding">
                            <div class="wp-content-customer">
                                <h3 class="head-general">CẢM NHẬN CỦA KHÁCH HÀNG</h3>
                                <h2 class="text-testimonial-quote"><p>“Minh Phương là đại lý đầu tiên tổ chức  sự kiện của TOTO Việt Nam tại Hà Nội cảm ơn Minh Phương đã tổ chức thành công sự kiện quan trọng của TOTO Việt Nam.”</p></h2>
                                <h4 class="name-testimonial">Ngài: YAMASAKI MASAO <br>TỔNG GIÁM ĐỐC TOTO VIỆT NAM</h4>
                            </div>
                        </div>
                    </div>  
                </div>                          
            </div>
            <div class="item">
                <div class="item-testimonial">
                    <div class="row">
                        <div class="col-md-6 clear-padding">
                            <div class="testimonial-video">
                                <iframe width="100%" height="585" src="https://www.youtube.com/embed/cLlxC5ILsr4" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="col-md-6 clear-padding">
                            <div class="wp-content-customer">
                                <h3 class="head-general">CẢM NHẬN CỦA KHÁCH HÀNG</h3>
                                <h2 class="text-testimonial-quote"><p>“Các khách hàng đã đồng hành cùng Minh Phương Showroom”</p></h2>
                            </div>
                        </div>
                    </div>  
                </div>                          
            </div>
            
    	</div>
    </div>
</section>

<script src="/plugin/wow/wow.min.js"></script>
<script>
    $(document).ready(function(){
        new WOW().init();
    })
</script>
<script src="/plugin/owl-carouse/owl.carousel.min.js"></script>
<script>
    $(document).ready(function (){
        $('.gb-slideshow-video-slide').owlCarousel({
            loop:true,
            margin:0,
            navSpeed:500,
            nav:false,
            dots: false,
            autoplay: false,
            rewind: true,
            margin:30,
            navText:[],
            items:1,
            responsive:{
                0:{
                    nav:false
                },
                767:{
                    nav:false
                }
            }
        });
    });
</script>

<style type="text/css" media="screen">
	.testimonial-video video{
		widows: 100% !important;
	}
	.wp-content-customer{
	    text-align: center;
	    padding: 70px 20px;
	    min-height: 585px;
	    display: flex;
	    align-content: center;
	    flex-wrap: wrap;
	    background: url("/images/slide/chili-tesminal-bg.jpg");
	    background-size: cover;
	}
	.wp-content-customer h3{
		width: 100%;padding: 15px 0px;
	    margin: 0;
	    color: #666;
	    font-size: 36px;
	    font-weight: 400;
	    line-height: 24px;
	    flex-direction: column;
	    width: 100%;
	}
	.wp-content-customer h2{
		width: 100%;padding: 15px 0px;
		color: #666;
	    font-size: 18px;
	    font-weight: 600;
	    text-align: center;
	    line-height: 1.3;
	    margin-top: 1rem;
	    flex-direction: column;
	    width: 100%;
	}
	.wp-content-customer h4{
		width: 100%;padding: 15px 0px;
		margin-top: 2rem;
	    color: #666;
	    font-size: 18px;
	    font-weight: 400;
	    flex-direction: column;
	    width: 100%;
	}
	.head-general strong{
		color: #ee3c25;
	}
	.overlay-video{
	    position: absolute;
	    top: 0;
	    bottom: 0;
	    width: 100%;
	    background: rgba(0, 0, 0, 0.45);
	}
	.testimonial-video:hover .overlay-video{
		display: none;
	}
</style>