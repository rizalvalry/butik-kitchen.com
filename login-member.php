<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>

            <li>Login</li>

        </ul>
    </div>
</section>
	<main class="login-page paira-sticky-root">
    <section class="login-content paira-gap-3 paira-gap-2">
        <div class="container">
            <div class="row">
                <div id="login">
                    <div class="col-md-12 text-center">
                        <div class="heading pull-left full-width">
                            <h1 class="page-header margin-bottom-30 text-left pull-left"><span>Login</span></h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-back">
									<form method="POST" action="aksi_loginmember.php" accept-charset="UTF-8">

                                    <label>Telepon</label>
                                    <input type="number" min="10" class="form-control margin-bottom-10" name="telpon" placeholder="Telepon" required="">

                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control margin-bottom-10" id="password" size="16" />
                                    <div class="row">
                                    <div class="col-md-12">
									<i class="fa fa-eye" id="togglePassword"> <label> Show Password</label></i>
                                    </label>
                                    </div>
                                    </div>
                                    <button type="submit" name="masuk"  class="btn btn-default pull-left margin-top-10">Login</button>
                                    <a href="lupa-password.html" class="pull-right margin-top-20 undreline"><h5 class="margin-clear">Lupa Password?</h5></a>
                                    <div class="row">
                                    <div class="col-md-12">
                                    <a href="memberdaftar.html" class="pull-right margin-top-20 btn btn-danger">Belum punya akun ?</a>
                                    </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="recover-password" style="display:none">
                    <div class="col-md-12 text-center">
                        <div class="heading pull-left full-width">
                            <h1 class="page-header margin-bottom-30 text-left pull-left"><span>Reset Password</span></h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-back">
                                    <h5 class="margin-top-20">We will send you an email to reset your password.</h5>

                                    <form method="post" action="/account/recover" accept-charset="UTF-8"><input type="hidden" name="form_type" value="recover_customer_password" /><input type="hidden" name="utf8" value="✓" />
                                    <input type="email" placeholder="Email Address" value="" size="30" name="email" id="recover-email" class="form-control margin-bottom-10" />
                                    <button type="submit" class="btn btn-default pull-left margin-top-10">Reset</button>
                                    <button onclick="hideRecoverPasswordForm();return false;" class="pull-right cancel-btn margin-top-20"><i class="fa fa-times" aria-hidden="true"></i> <span>Cancel</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="login-mobile" class="col-md-6 text-center login-register mobile">
                    <div class="login-back">
                    <form method="POST" action="aksi_loginmember.php" accept-charset="UTF-8">
                    <img src="images/login.jpg" style="width:100%; height:25%">
                    </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
    <!--//login-->

    <script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>
