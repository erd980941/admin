<?php include_once 'views/header.php' ?>


<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin Paneline Hoşgeldiniz..</h1>
                                    </div>
                                    <form action="../_business/authenticate.php" method="post" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Kullanıcı Adı..">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Şifre..">
                                        </div>
                                        
                                        <button class="btn btn-primary btn-user btn-block" name="admin_login">Giriş Yap</button>

                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>
<?php include_once 'views/footer.php' ?>