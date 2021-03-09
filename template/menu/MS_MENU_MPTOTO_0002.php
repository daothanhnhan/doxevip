

<div class="col-md-9 coverMenuMobile mobile-menu-container mobile-nav">
    <div class="menu-mobile-nav">
        <span class="icon-bar"><i class="fa fa-bars" aria-hidden="true"></i> Danh mục sản phẩm</span>
    </div>
    <div id="cssmenu" class="animated">
        <div class="uni-icons-close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <ul>
                                <?php 
                                foreach ($list_procat1 as $item_cat1) { 
                                    
                                    $list_procat2 = $action_product->getProductCat_byProductCatIdParent($item_cat1['productcat_id'], 'desc');
                                ?>
                                    <li class="has-sub">
                                        <a href="/<?= $item_cat1['friendly_url'] ?>">
                                            <img src="/images/<?= $item_cat1['productcat_img'] ?>" class="icon_cate_websmienphi">
                                            <?= $item_cat1['productcat_name'] ?>
                                        </a>
                                        <ul class="row">
                                            <?php 
                                            foreach ($list_procat2 as $item_cat2) {
                                                 
                                                 $list_procat3 = $action_product->getProductCat_byProductCatIdParent($item_cat2['productcat_id'], 'desc');
                                            ?>
                                                <li class="col-md-5">
                                                    <div class="item">
                                                        <h3><a href="/<?= $item_cat2['friendly_url'] ?>"><?= $item_cat2['productcat_name'] ?></a></h3>
                                                        <ul>
                                                            <?php 
                                                            foreach ($list_procat3 as $item_cat3) { 
                                                                
                                                            ?>
                                                                <li><a href="/<?= $item_cat3['friendly_url'] ?>"> <?= $item_cat3['productcat_name'] ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                            <li class="image_cate">
                                                <img src="/images/<?= $item_cat1['productcat_sub'] ?>" alt="" class="lazy_menu img-responsive">
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
        <?php
                        $list_menu = $menu->getListMainMenu_byOrderASC();
                        $menu->showMenu_byMultiLevel_mainMenuMPToTo($list_menu,0,$lang,0);
                    ?>
        <div class="clearfix"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
        //-----------------menu mobile---------------------
        $('.mobile-menu-container .menu-mobile-nav').on('click', function (e) {
            if($(e.target).is('.icon-bar')){
                $('#cssmenu').slideToggle();
                $('#cssmenu ul').slideToggle();
                $('#cssmenu ul ul').hide();
            }
        });
        $('.uni-icons-close'). on('click', function (e) {
            if($(e.target).is('i')){
                $('#cssmenu').hide( 500);
                $('#cssmenu ul').hide(500);
            }
        });

        (function($) {

            $.fn.menumaker = function(options) {

                var cssmenu = $(this), settings = $.extend({
                    title: "Menu",
                    format: "dropdown",
                    sticky: false
                }, options);

                return this.each(function() {

                    cssmenu.find('li ul').parent().addClass('has-sub');

                    var multiTg = function() {
                        cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                        cssmenu.find('.submenu-button').on('click', function() {
                            $(this).toggleClass('submenu-opened');
                            $(this).toggleClass('active');
                            if ($(this).siblings('ul').hasClass('open')) {
                                $(this).siblings('ul').removeClass('open').slideToggle();
                            }
                            else {
                                $(this).siblings('ul').addClass('open').slideToggle();
                            }
                        });
                    };

                    if (settings.format === 'multitoggle') multiTg();
                    else cssmenu.addClass('dropdown');

                    if (settings.sticky === true) cssmenu.css('position', 'fixed');

                    var resizeFix = function() {
                        if ($( window ).width() > 768) {
                            cssmenu.find('ul').show();
                        }

                        if ($(window).width() <= 768) {
                            cssmenu.find('ul').hide().removeClass('open');
                        }
                    };
                    // resizeFix();
                    // return $(window).on('resize', resizeFix);

                });
            };
        })(jQuery);

        (function($){
            $(document).ready(function() {
                $("#cssmenu").menumaker({
                    title: "",
                    format: "multitoggle"
                });

                $("#cssmenu").prepend("<div id='menu-line'></div>");

                var foundActive = false, activeElement, linePosition = 0, menuLine = $("#cssmenu #menu-line"), lineWidth, defaultPosition, defaultWidth;

                $("#cssmenu > ul > li").each(function() {
                    if ($(this).hasClass('active')) {
                        activeElement = $(this);
                        foundActive = true;
                    }
                });

                if (foundActive === false) {
                    activeElement = $("#cssmenu > ul > li").first();
                }

                defaultWidth = lineWidth = activeElement.width();

                // defaultPosition = linePosition = activeElement.position().left;

                menuLine.css("width", lineWidth);
                menuLine.css("left", linePosition);

                $("#cssmenu > ul > li").on('mouseenter', function () {
                        activeElement = $(this);
                        lineWidth = activeElement.width();
                        linePosition = activeElement.position().left;
                        menuLine.css("width", lineWidth);
                        menuLine.css("left", linePosition);
                    },
                    function() {
                        menuLine.css("left", defaultPosition);
                        menuLine.css("width", defaultWidth);
                    });
            });
        })(jQuery);
    });
</script>