<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />


    <!-- website font  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/swiper.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/animate.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>" />

    <title>Blood bank</title>
</head>

<body>

    <!-- Navbar 1 Start -->
    <section id="Nav1">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <i class="fas fa-phone-volume" style="border-right: 1px solid gray;"> +91 9312633729
                                &nbsp; &nbsp; </i>
                        </li>
                        <li class="nav-item">
                            <i class="far fa-envelope" style="padding-left: 15px;"> InfoBloodBank@gmail.com</i>
                        </li>
                    </ul>
                </div>
                <div class="mx-auto order-0 navbar-brand mx-auto">
                    <a href=""><i
                            class="fab fa-instagram github">&nbsp;&nbsp;</i></a>
                    <a href=""><i
                            class="fab fa-facebook-f facebook">&nbsp;&nbsp;</i></a>
                    <a href=""><i class="fab fa-twitter twitter">&nbsp;&nbsp;</i></a>
                    <a href=""><i
                            class="fab fa-whatsapp whats">&nbsp;&nbsp;</i></a>
                </div>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item" style="padding-left: 35px;">
                            <a class="nav-link selected" >EN &nbsp;</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <!-- Navbar 1 End -->

    <!-- Navbar 2 Start -->
    <section id="Nav2">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <img src="<?php echo e(asset('imgs/logo.png')); ?>" width="18%"></img>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link selected" href="<?php echo e(url('./account/index')); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('./requests/received')); ?>">Received Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('./account/yourDonations')); ?>">Your Donations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('./requests/yourSentRequests')); ?>">Sent Requests</a>
                    </li>
                </ul>
                <button class="btn signup" onclick="window.location='<?php echo e(url('/account/register')); ?>'">New Account</button>
                <button class="btn login" onclick="window.location='<?php echo e(url('/account/login')); ?>'">Login</button>
            </div>
        </nav>
    </section>
    <!-- Navbar 2 End -->

    <!-- Navigator Start -->
    <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / Login</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <!-- Login Start -->
    <section id="login">
        <div class="container">
            <?php if(Session::has('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(Session::get('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(Session::has('error')): ?>
                <div class="alert alert-danger">
                    <?php echo e(Session::get('error')); ?>

                </div>
            <?php endif; ?>
                <img src="<?php echo e(asset('imgs/logo.png')); ?>" alt="">
                <form action="<?php echo e(route('account.authenticate')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row gy-3 overflow-hidden">
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="email" class="username form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" id="email" placeholder="Email">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p style="padding-left:170px; font-size:20px;" class="invalid-feedback"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="password form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" id="password" value="" placeholder="Password" >
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p style="padding-left:170px; font-size:20px;" class="invalid-feedback"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <input class="check" type="checkbox">Remember me
                    <a href="#">Forget Password ?</a><br>
                
                    <div class="reg-group">
                        <button style="background-color: darkred;">Login</button>
                    </div>
                </form>
                <br>
                <div style="align-items: center; display:flex; justify-content:center" onclick="window.location='<?php echo e(url('/account/register')); ?>'">If you don't have account. <span style="color:darkred ">Make new account</span></div>

                
        </div>
    </section>
    <!-- Login End -->

    <!-- Footer Start -->
    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="foot-info">
                        <img src="<?php echo e(asset('imgs/logo.png')); ?>" alt="">
                        <p>Donate blood today—save lives, spread hope, and be a 
                            hero in someone's story. Your single act of kindness can 
                            make an extraordinary difference. Give the gift of life.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="menu">
                        <a href="<?php echo e(url('./account/index')); ?>">
                            <li>Home</li>
                        </a>
                        <a href="">
                            <li>About Us</li>
                        </a>
                        <a href="<?php echo e(url('./requests/received')); ?>">
                            <li>Recived Requests</li>
                        </a>
                        <a href="<?php echo e(url('./account/yourDonations')); ?>">
                            <li>Your Donations</li>
                        </a>
                        <a href="<?php echo e(url('./requests/yourSentRequests')); ?>">
                            <li>Sent Requests</li>
                        </a>
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="options">
                        <li>
                            <h5>Available On</h5>
                        </li>
                        <li><img src="<?php echo e(asset('imgs/ios1.png')); ?>" alt=""></li>
                        <li><img src="<?php echo e(asset('imgs/google1.png')); ?>" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer End -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/swiper.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/wow.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html><?php /**PATH E:\academic\code\Sem\Sem_7\INT_221\projects\harshavi\resources\views/account/login.blade.php ENDPATH**/ ?>