
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
                        <a class="nav-link" href="<?php echo e(url('./requests/received')); ?>">Received Requests (<?php echo e($your_received_request); ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('./account/yourDonations')); ?>">Your Donations (<?php echo e($your_donation_count); ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('./requests/yourSentRequests')); ?>">Sent Requests (<?php echo e($your_sent_request); ?>)</a>
                    </li>
                </ul>
                <button class="btn login" onclick="window.location='<?php echo e(url('/')); ?>'">Logout</button>
            </div>
        </nav>
    </section>
    <!-- Navbar 2 End -->

    <!-- Navigator Start -->
    <section id="navigator">
        <div class="container">
            <div class="path">
                <div class="path-main" style="color: darkred; display:inline-block;">Home</div>
                <div class="path-directio" style="color: grey; display:inline-block;"> / All Donations</div>
            </div>

        </div>
    </section>
    <!-- Navigator End -->

    <section id="requests">
        
        <div class="container">
            <form action="<?php echo e(route('account.search')); ?>" method="GET">
            
            <div class="row">
                <div class="col-lg-5">
                    <select name="Type" id="">
                        <option value="" disabled selected>Select Blood Type</option>
                        <option value="A+">A+</option>
                        <option value="O+">O+</option>
                        <option value="B+">B+</option>
                        <option value="AB+">AB+</option>
                        <option value="A-">A-</option>
                        <option value="O-">O-</option>
                        <option value="B-">B-</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
                <div class="col-lg-5" style="padding-top:50px;padding-left:40px; color:black">
                    <input type="text" name="City" placeholder=" Enter City" required style="height: 35px; color:black; width: 350px;" >
                </div>
                <div class="search">
                    <button type="submit"><i class="col-lg-2 fas fa-search"></i></button>
                </div>
            </div>
            </form>

           

            <?php $__currentLoopData = $donation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="type">
                                <h2><?php echo e($donation->bloodgroup); ?></h2>
                            </div>
                        </div>
                        <div class="data col-lg-6">
                            <h4>Name: <?php echo e($donation->name); ?></h4>
                            <h4>Phone: <?php echo e($donation->phone); ?></h4>
                            <h4>City: <?php echo e($donation->city); ?></h4>
                        </div>
                        <div class="col-lg-3">
                            <div class="type">
                                
                                <form id="send-request-form" action="<?php echo e(route('requests.send')); ?>" method="post">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="donor_id" value="<?php echo e($donation->id); ?>">
                                    
                                        <a href="<?php echo e(route('requests.sendForm', ['donationId' => $donation->id])); ?>" class="btn btn-primary" style="width: 200px; margin-top:44px;padding: 10px; margin-right: 10px; background-color:rgb(189, 189, 189); border-color:rgb(189, 189, 189);font-size:20px ;color: darkred">
                                            Sent Request
                                        </a>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            
    </section>

    <div>

    </div>



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

    
    <script>
        function sendRequest(event) {
            event.preventDefault();
            const button = event.target;
            button.innerHTML = 'Request Sent';
    
            // Submit the form after changing the button text
            window.location.href = '/requests/send';
        }
    </script>

       
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/swiper.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/wow.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/main.js')); ?>"></script>
</body>

</html>

<?php /**PATH E:\academic\code\Sem\Sem_7\INT_221\projects\harshavi\resources\views/account/require.blade.php ENDPATH**/ ?>