<body class="login" style="height: 100vh;background: url('<?php echo base_url()?>/assets/client/images/img/bg3.jpg'); background-size: cover;">
	<div class="container" >
        <div class="login-div">
            <form method="POST" action="<?= site_url()?>/login-client"> 
                <div class="logo">
                    <img class="img-responsive" src="<?php echo base_url()?>/assets/client/images/img/Logo.png" width="200" alt="logo"/>
                </div>
                <div class="title">
                    <p class="landing-sobat" style="font-size: 34px;color:#F4A460">Welcome To </p>
                    <p style="font-size: 30px;color:white;font-family:macklins;">Sobat Daging Admin</p>
                </div>
                <div class="fields">
                    <div class="username"><input type="text" class="user-input" placeholder="Username" name="nama" /></div>
                    <div class="password"><input type="password" class="pass-input" placeholder="Enter Your Password" name="password" /></div>
                </div>
                <div class="link"><a href="<?php echo base_url()?>/forgetpassword">Forgot your password?</a></div>
                <button class="signin-button" type="submit">Login</button>
            </form>
        </div>
	</div>
</body>

