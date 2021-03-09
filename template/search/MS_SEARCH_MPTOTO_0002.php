<div class="product-filter">
    <div class="row">
        <div class="col-sm-6">
            <label>Hiển thị</label>
            <form method="get">
                <select name="orderby" class="orderby" id="orderby" data-number="9" onchange="sort_num(this)">
                    <option value="12" <?= ($_SESSION['sort_num'] == 12) ? 'selected' : '' ?> >12</option>
                    <option value="25" <?= ($_SESSION['sort_num'] == 25) ? 'selected' : '' ?> >25 </option>
                    <option value="50" <?= ($_SESSION['sort_num'] == 50) ? 'selected' : '' ?> >50 </option>
                    <option value="75" <?= ($_SESSION['sort_num'] == 75) ? 'selected' : '' ?> >75</option>
                    <option value="100" <?= ($_SESSION['sort_num'] == 100) ? 'selected' : '' ?> >100 </option>
                </select>
            </form>
        </div>
        <div class="col-sm-6">
            <label>Sắp xếp</label>
            <form class="woocommerce-ordering" method="get">
                <select name="orderby" class="orderby" id="orderby_2" onchange="sort_price(this)">
                    <option value="default" <?= ($_SESSION['sort_price']=='default') ? 'selected' : '' ?> >Mặc định</option>
                    <option value="az" <?= ($_SESSION['sort_price']=='az') ? 'selected' : '' ?> >Tên A-Z</option>
                    <option value="price_asc" <?= ($_SESSION['sort_price']=='price_asc') ? 'selected' : '' ?> >Giá (Thấp - Cao)</option>
                    <option value="price_desc" <?= ($_SESSION['sort_price']=='price_desc') ? 'selected' : '' ?> >Giá (Cao - Thấp)</option>
                </select>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- .woocommerce-ordering -->
</div>