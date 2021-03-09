<?php
$email = new action_email();
$email->gui_email();
?>
<div class="boxNewsletter"> 
    <h4 class="titleFormMailHome">Kênh Thông Tin</h4>
    <p class="subFormMailHome">Nhập email để nhận thông tin chương trình khuyến mãi</p>
     <form action="" method="post" accept-charset="utf-8">
        <div class="input-group">

            <input type="email" class="form-control" placeholder="Nhập email của bạn" required="" name="email">

            <span class="input-group-btn">

                <button class="btn btn-theme" type="submit"  name="send_email">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
            </button>

            </span>

        </div>
    </form> 

</div>

</div>