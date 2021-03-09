<?php
    if(isset($_SESSION['user_name_gbvn'])){
        echo '<script type="text/javascript">window.location.href = "/";</script>';
    }
?>
<?php 
    $message = "";

    function dangky () {
        global $conn_vn;
        global $message;
        if (isset($_POST['register'])) {
            $check = 'true';
            $name = ($_POST['name']==NULL) ? '' : trim($_POST['name']);
            $email = ($_POST['email']==NULL) ? '' : $_POST['email'];
            $phone = ($_POST['phone']==NULL) ? '' : $_POST['phone'];
            $birthday = ($_POST['birthday']==NULL) ? '' : $_POST['birthday'];
            $pass1 = ($_POST['pass1']==NULL) ? '' : $_POST['pass1'];
            $pass2 = ($_POST['pass2']==NULL) ? '' : $_POST['pass2'];
            $time = date('Y-m-d');
            $ask = password_hash(trim($_POST['ask']), PASSWORD_DEFAULT);

            // Check email isset
            $sql_email = "SELECT * FROM user Where user_email = '$email'";
            $result_email = mysqli_query($conn_vn, $sql_email);
            $row_email = mysqli_num_rows($result_email);

            if ($row_email > 0) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Email đã tồn tại</div>";
            }

            if ($pass1 != $pass2) {
                $check = "false";
                $message .= "<div class='alert alert-danger'>Mật khẩu không khớp</div>";
            }

            if ($check == "true") {
                $pass = password_hash($pass1, PASSWORD_DEFAULT);
                $sql = "INSERT INTO user (user_name, user_email, user_phone, user_birthday, user_password, time, ask) VALUES ('$name', '$email', '$phone', '$birthday', '$pass', '$time', '$ask')";
                $result = mysqli_query($conn_vn, $sql);
                if ($result) {
                  $sql_user = "SELECT * FROM user Where user_email = '$email'";
                  $result_user = mysqli_query($conn_vn, $sql_user);
                  $row_user = mysqli_fetch_assoc($result_user);
                  $_SESSION['user_id_gbvn'] = $row_user['user_id'];
                  $_SESSION['user_email_gbvn'] = $row_user['user_email'];
                  $_SESSION['user_name_gbvn'] = $row_user['user_name'];
                  echo '<script type="text/javascript">alert(\'Bạn đã đăng ký thành công!\'); window.location.href = "/thong-tin-tai-khoan";</script>';
                } else {
                  echo '<script type="text/javascript">alert(\'Có lỗi xảy ra.\')</script>';
                }
                
            }
        }
    }

    dangky();
?>
<?php 
    $message_login = '';

    function randomString($length = 6) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    function dangnhap () {
        global $conn_vn;
        global $message_login;
        if (isset($_POST['login'])) {
            $email = ($_POST['email']==NULL) ? '' : $_POST['email'];
            $pass = ($_POST['pass']==NULL) ? '' : $_POST['pass'];

            $sql = "SELECT * FROM user Where user_email = '$email'";
            $result = mysqli_query($conn_vn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 0) {
                $message_login = "<div class='alert alert-danger'>Mật khẩu hoặc Tên đăng nhập không đúng</div>";
            } else {
                $row = mysqli_fetch_assoc($result);
                $pass_hash = $row['user_password'];
                if (password_verify($pass, $pass_hash)) {
                    $_SESSION['user_id_gbvn'] = $row['user_id'];
                    $_SESSION['user_name_gbvn'] = $row['user_name'];
                    $_SESSION['session_id'] = session_id();
                    if (isset($_POST['rememberme'])) {
                        $identify = randomString(20);
                        $token = randomString(30);
                        $cooki = $identify . ':' . $token;

                        setcookie('user_id_trichdan', $cooki, time() + 2592000);
                        $sql_me = "UPDATE user SET remember_me_identify = '$identify', remember_me_token = '$token' Where user_id = " . $row['user_id'];
                        $result_me = mysqli_query($conn_vn, $sql_me);
                    }
                    echo '<script type="text/javascript">alert(\'Bạn đã đăng nhập thành công!\'); window.location.href = "/thong-tin-tai-khoan";</script>';
                } else {
                    $message_login = "<div class='alert alert-danger'>Mật khẩu hoặc Tên đăng nhập không đúng</div>";
                }
            }
        }
    }

    dangnhap();
?>
<?php 
  function forgetPass () {
    global $conn_vn;
    if (isset($_POST['forget'])) {
      $email = $_POST['email'];
      $ask = $_POST['ask'];
      $sql = "SELECT * FROM user WHERE user_email = '$email'";
      $result = mysqli_query($conn_vn, $sql);
      $num = mysqli_num_rows($result);
      if ($num == 0) {
         echo '<script type="text/javascript">alert(\'Tài khoản này không tồn tại.\');</script>';
         return false;
      } else {
        $row = mysqli_fetch_assoc($result);
        if ($row['ask'] == '') {
          echo '<script type="text/javascript">alert(\'Tài khoản này không hợp lệ.\');</script>';
        } else {
          $ask_hash = $row['ask'];
          if (password_verify($ask, $ask_hash)) {
            $_SESSION['user_id_gbvn'] = $row['user_id'];
            $_SESSION['user_name_gbvn'] = $row['user_name'];
            echo '<script type="text/javascript">alert(\'Mời bạn đổi mật khẩu.\');window.location.href = "/doi-mat-khau";</script>';
          } else {
            echo '<script type="text/javascript">alert(\'Thông tin nhập vào không hợp lệ.\');</script>';
          }
        }
      }
    }
  }
  forgetPass();
?>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '237778183823450',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v3.0' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      // statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {

    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', {fields: 'email,name,last_name,birthday'}, function(response) {
      var json = JSON.stringify(response);
      console.log('Successful login for: ' + response.name);
      // document.getElementById('status').innerHTML =
      //   'Thanks for logging in, ' + json + '!';

      var id = response.id;
      var name = response.name;
      var email = response.email;
      // alert(name);
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
         var bien = this.responseText;
         // alert(bien);
         if (bien == 'ok') {
          alert('Login thành công.');
          window.location.href = "/";
         } else if (bien == 'has') {
          alert('Xin lỗi, Email đã tồn tại.');
         } else {
          alert('Login lỗi');
         }
        }
      };
      xhttp.open("GET", "/functions/ajax/login-fb.php?id="+id+"&name="+name+"&email="+email, true);
      xhttp.send();
      
        });
  }
</script>
<div class="gb-register_excel">
    <div class="gb-register_excel-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="gb-register_excel-top-right">
                        <form action="" method="post">
                            <div class="row">
                                <?= $message_login ?>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="Nhập email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox"> Ghi nhớ tài khoản
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="pass" class="form-control" placeholder="Nhập password" required>
                                    </div>
                                    <div class="form-group">
                                        <a href="#0" data-toggle="modal" data-target="#khoiphucmatkhau">Quên mật khẩu?</a>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-dangnhap_excel" name="login">Đăng nhập</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="gb-dangky_tour">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="gb-dangky_tour-left">
                        <img src="/images/<?= $rowConfig['icon_web'] ?>" alt="" class="img-responsive" style="width: 100%;">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="gb-dangky_tour-right">
                        <div class="gb-dangky_tour-right-top">
                            <!-- <p>Hoặc đăng nhập bằng tài khoản sau:</p> -->
                            <!-- <ul>
                                <li><a href="" class="btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                                <li><a href="" class="btn-google"><i class="fa fa-google-plus" aria-hidden="true"></i> Google +</a></li>
                            </ul> -->
                            <!-- <ul>
                                <li> -->
                                    <!-- <a href="" class="btn-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a> -->
                                    <!-- <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                                    </fb:login-button>
                                </li>
                                <li><a href="/login-go.html" class="btn-google"><i class="fa fa-google-plus" aria-hidden="true"></i> Google +</a></li>
                            </ul> -->
                        </div>
                        <div class="gb-form-dangky">
                            <h3>Đăng ký</h3>
                            <form action="" method="post">
                                <?= $message ?>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Họ và tên" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ?>" required>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại" value="<?= (isset($_POST['phone'])) ? $_POST['phone'] : '' ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="date" name="birthday" class="form-control" placeholder="Ngày sinh" value="<?= (isset($_POST['birthday'])) ? $_POST['birthday'] : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="pass1" class="form-control" placeholder="Nhập mật khẩu" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="pass2" class="form-control" placeholder="Nhập lại mật khẩu" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Câu hỏi bảo mật: Bạn thích con gì?" name="ask" required="" value='<?php if(isset($_POST['ask']) && $_POST['ask'] != NULL){ echo $_POST['ask']; } ?>' >
                                </div>
                                <div class="form-group">
                                    <p>Bằng cách nhấp vào Tạo tài khoản, bạn đồng ý với <a href="#0"  data-toggle="modal" data-target="#product_view">Điều khoản & dịch vụ</a> của chúng tôi</p>
                                </div>
                                <div class="form-group">
                                    <button name="register" class="btn btn-taotaikhoan">Tạo tài khoản</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--MODAL DDIEEFU KHAIORN-->
<div class="gb-quickview_noithat">
    <div class="modal fade product_view" id="product_view">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <div class="modal-body">
                    <div class="uni-single-car-gallery-images">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--KHÔI PHỤC MẬT KHẨU-->
<div class="gb-quickview_noithat">
    <div class="modal fade product_view" id="khoiphucmatkhau">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Khôi phục mật khẩu</h3>
                    <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <p>Nhập email vào ô bên dưới để tiếp tục</p>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Nhập email" required>
                        </div>
                        <p>Nhập câu hỏi bảo mật vào ô bên dưới</p>
                        <div class="form-group">
                            <input type="text" class="form-control" name="ask" placeholder="Bạn thích con gì nhất" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-xacnhan" name="forget">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>