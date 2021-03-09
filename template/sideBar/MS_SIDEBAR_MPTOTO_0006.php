<link rel="stylesheet" href="/plugin/jquery-ui/jquery-ui.min.css">
<div class="gb-filterprices-sidebar-ruouvang widget-sidebar">
    <aside class="widget">
        <h3 class="widget-title-sidebar-ruouvang">Lọc theo giá</h3>
        <div class="widget-content">
            <form action="/price/0" method="post" accept-charset="utf-8">
                <div class="uni-filter-price">
                    <div id="slider-range"></div>
                    <div class="label-filter-price"><input type="text" id="amount" name="price" readonly></div>
                    <button type="submit" class="btn-filter-prince">SEARCH</button>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
    </aside>
</div>
<script src="/plugin/jquery-ui/jquery-ui.min.js"></script>

<script>
    $(document).ready(function () {
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 1000000000,
                values: [ 100000, 500000000 ],
                slide: function( event, ui ) {
                    $( "#amount" ).val( "VNĐ" + ui.values[ 0 ] + " - VNĐ" + ui.values[ 1 ] );
                }
            });
            $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + " VNĐ - " +
                $( "#slider-range" ).slider( "values", 1 ) + " VNĐ" );
        } );
    });
</script>