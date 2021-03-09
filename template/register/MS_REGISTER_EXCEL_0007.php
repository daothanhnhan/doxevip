<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">THÔNG TIN ĐƠN HÀNG</a></li>
    </ul>
    <div class="tab-content">
        <div class="active tab-pane" id="settings">
            <table class="table table-striped">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên đơn hàng</th>
						<th>Tên người nhận</th>
						<th>Số điện thoại</th>
						<th>Email</th>
						<th>Ghi chú</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						foreach ($list_cart['data'] as $item) {
					?>
						<tr>
							<td><?= $i++ ?></td>
							<td>
								<a href="/chi-tiet-don-hang/<?= $item['id_cart'] ?>" title="">Đơn hàng số #<?= $item['id_cart'] ?></a>
							</td>
							<td><?= $item['name_buyer'] ?></td>
							<td><?= $item['phone_buyer'] ?></td>
							<td><?= $item['mail_buyer'] ?></td>
							<td><?= $item['note_buyer'] ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
        </div>
    </div>
</div>
<style type="text/css" media="screen">
	.nav-tabs-custom>.nav-tabs>li.active {
	    border-top-color: #167f34;
	}
	.nav-tabs-custom>.nav-tabs>li {
	    border-top: 3px solid transparent;
	    margin-bottom: -2px;
	    margin-right: 5px;
	}
</style>