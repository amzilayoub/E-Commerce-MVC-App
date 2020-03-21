<?php
    $title = isset($title) ? $title : '';
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="/works/mvcApp/public/" />
        <!-- Required meta tags -->
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- GOOGLE FONT -->
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <!-- FONT ICON -->
        <link rel="stylesheet" href="css/line-awesome.min.css">
        <!-- NICE SELECT -->
        <link rel="stylesheet" href="css/nice-select.css">
        <!-- My Style -->
        <link rel="stylesheet" href="css/style.css" >
        <title><?php echo $title; ?></title>
        <!-- HTML 5 SHIV -->
        <script src="js/html5shiv.min.js"></script>
        <!-- RESPOND -->
        <script src="js/respond.min.js"></script>
    </head>
    <body 
        <?php 
            $class = isset($noHomePage) ? ' class=inOtherPage' : '';
            echo $class;
        ?>
     >
        <!-- +------------- START BRAND -------------+ -->
        <section class="brandSection">
            <div class="container brand">
                <a href="">
                    <h6>DES<span>A</span></h6>
                </a>
            </div>
            <div data-nav="sideBar" class="barsMobile">
                <div class="spans">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </section>
        <!-- +------------- END BRAND -------------+ -->
        <!-- +------------- START SIDE NAVBAR -------------+ -->
        <nav class="sideBarStyle sideBar">
            <ul>
                <li data-nav="mainBar">
                    <i class="la la-bars"></i>
                </li>
                <li data-nav="myCart">
                    <i class="la la-shopping-cart">
                        <span><?php
                            $countMyCart = isset($_SESSION['myCart']) ? count($_SESSION['myCart']) : 0;
                            echo $countMyCart;
                        ?></span>
                    </i>
                </li>
                <li data-nav="authenticate">
                    <?php
                    
                        if(isset($_SESSION['user'])){
                            if (empty($_SESSION['user']['avatar'])) {

                                echo '<i class="connect la la-user"></i>';

                            } else {

                                echo '<img src="uploaded\avatars' . DS . $_SESSION['user']["avatar"] . '" >';
                            
                            }
                        } else {
                            echo '<i class="la la-user"></i>';
                        }
                    ?>
                </li>
                <li data-nav="searchAside">
                    <i class="la la-search"></i>
                </li>
                <li data-nav="contactAside">
                    <i class="la la-envelope"></i>
                </li>
            </ul>
        </nav>
        <!-- +------------- END SIDE NAVBAR -------------+ -->
        <!-- +------------- START NAVBAR LINKS -------------+ -->
        <section class="sideBarStyle mainBar">
            <nav>
                <div class="back">
                    <i class="la la-arrow-right"></i>
                </div>
                <ul>
                    <div class="brand">
                        <a href="">
                            <h6>DES<span>A</span></h6>
                        </a>
                    </div>
                    <div class="links"> 
                        <li>
                            <a href="index">
                                <i class="la la-home"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <?php 
                                if (isset($_SESSION['user']['idUser'])) {

                                    echo '<a  href="user">';

                                } else {
                                    echo '<a data-nav="authenticate" class="notSignIn" href="#">';
                                }
                            ?>
                                <i class="la la-user"></i>
                                <span>My Account</span>
                            </a>
                        </li>
                        <li>
                            <a href="product/search/-1">
                                <i class="la la-cart-arrow-down"></i>
                                <span>Top Discount</span>
                            </a>
                        </li>
                        <li>
                            <a href="product/search/">
                                <i class="la la-home"></i>
                                <span>Search</span>
                            </a>
                        </li>
                        <li>
                            <a href="faq/">
                                <i class="la la-info-circle"></i>
                                <span>FAQ</span>
                            </a>
                        </li>
                    </div>
                </ul>
                <div class="socialMedia">
                    <ul>
                        <li>
                            <a href="">
                                <i class="la la-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="la la-google"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="la la-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <i class="la la-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </section>
        <!-- +------------- END NAVBAR LINKS -------------+ -->
        <!-- +------------- START MY ITEMS -------------+ -->
        <section class="sideBarStyle myCart">
            <div class="back">
                <i class="la la-arrow-right"></i>
            </div>
            <div class="allItems">
                <?php
                    if (isset($_SESSION['myCart']) && count($_SESSION['myCart']) > 0) {
                        for ($i = 0; $i < count($_SESSION['myCart']); $i++) {
                            $post = '<div class="item">';
                            $post .= '<div class="img">';
                            $post .= '<div>';
                            $post .= '<img src="uploaded/productImg/' . $_SESSION['myCart'][$i]['img'] . '" />';
                            $post .= '<a href="product/show/' . $_SESSION['myCart'][$i]['idProduct'] . '"></a>';
                            $post .= '</div>';
                            $post .= '<div>';
                            $post .= '<h6>' . $_SESSION['myCart'][$i]['name'] . '</h6>';
                            $post .= '<h4>' . $_SESSION['myCart'][$i]['price'] . ' $</h4>';
                            $post .= '</div>';
                            $post .= '</div>';
                            $post .= '<div class="manipul">';
                            $post .= '<div class="removeMyCart" data-product="' . $_SESSION['myCart'][$i]['idProduct'] . '">';
                            $post .= '<i class="la la-close"></i>';
                            $post .= '<span>Remove</span>';
                            $post .= '</div>';
                            $post .= '<div class="checkOutButton buyMyProduct" data-product="' . $_SESSION['myCart'][$i]['idProduct'] . '">';
                            $post .= '<i class="la la-check-circle"></i>';
                            $post .= '<span>Buy</span>';
                            $post .= '</div>';
                            $post .= '</div>';
                            $post .= '</div>';
                            echo $post;
                        }
                ?>
            </div>
            <div class="seeAll">
                <a href="myCart">See All</a>
            </div>
                <?php
                    } else {
                        echo '<h2 class="zeroItem">There\'s 0 Item In Your Cart !</h2>';
                    }
                ?>
        </section>
        <!-- +------------- END MY ITEMS -------------+ -->

        <!-- +------------- START AUTH -------------+ -->
        <section class="sideBarStyle auth authenticate loadingThisSection">
            <div class="back">
                <i class="la la-arrow-right"></i>
            </div>

            <?php

                if (isset($_SESSION['user'])) {

            ?>

                <div class="user">
                    <h6><span><?php echo $_SESSION['user']['username']; ?></span></h6>
                    <ul>
                        <li><a href="user/"><i class="la la-user"></i> My Account</a></li>
                        <li><a href="myCart/"><i class="la la-shopping-cart"></i> My Cart</a></li>
                        <li><a href="product/"><i class="la la-opencart"></i> My Product</a></li>
                        <li><a href="product/addProduct"><i class="la la-plus-circle"></i> Add Product</a></li>
                        <li><a href="product/addDiscount"><i class="la la-plus-circle"></i> Add Discount</a></li>
                        <li><a href="product/discount"><i class="la la-cart-arrow-down"></i> Product On Solde</a></li>
                        <li><a href="like/"><i class="la la-heart"></i> Product Liked</a></li>
                        <li><a href="user/"><i class="la la-history"></i> Historique Sales</a></li>
                        <li><a class="logout" href="#"><i class="la la-power-off"></i> LogOut</a></li>
                    </ul>
                </div>

            <?php

                } else {

            ?>

            <div class="showForm form">
                <div class="typeForm">
                    <span>Login</span>
                </div>
                <form method="POST" action="auth/login" class="login">
                    <div>
                        <input type="text" name="username" placeholder="Username" />
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <div class="checkbox">
                        <label for="rememberMe">
                            <input id="rememberMe" type="checkbox" name="rememberMe" />
                            <span>Remember Me</span>
                        </label>
                    </div>
                    <div>
                        <input type="submit" value="Login" />
                    </div>
                </form>
                <div class="switch">
                    <span>Sign Up ?</span>
                </div>
            </div>
            <div class="form">
                <div class="typeForm">
                    <span>Sign Up</span>
                </div>
                <form class="signUp" method="GET" action="signup/">
                    <div>
                        <input type="email" name="email" placeholder="Email" />
                    </div>
                    <div>
                        <input type="submit" value="Sign Up" />
                    </div>
                </form>
                <div class="switch">
                    <span>Login ?</span>
                </div>
            </div>
            <div data-nav="forgetPassword" class="forgetPassBtn">
                <span>Forget Password ?</span>
            </div>
            <?php

                }

            ?>
        </section>
        <!-- +------------- END AUTH -------------+ -->
        <!-- +------------- START FORGET PASSWORD -------------+ -->
        <section class="sideBarStyle auth forgetPassword">
            <div class="back">
                <i class="la la-arrow-right"></i>
            </div>
            <?php
                if (!isset($_SESSION['user'])) {
            ?>
            <div class="showForm form">
                <div class="typeForm">
                    <span>Email</span>
                </div>
                <form class="signUp" method="POST" action="auth/forgetPass">
                    <div>
                        <input type="email" name="email" placeholder="Email" />
                    </div>
                    <div>
                        <input type="submit" value="Send !" />
                    </div>
                </form>
            </div>
            <?php
                }
            ?>
        </section>
        <!-- +------------- END FORGET PASSWORD -------------+ -->
        <!-- +------------- START SEARCH -------------+ -->
        <section class="sideBarStyle searchAside">
            <div class="back">
                <i class="la la-arrow-right"></i>
            </div>
            <div class="form">
                <form>
                    <div>
                        <input type="search" name="searchedItem" placeholder="Search..." />
                    </div>
                    <div>
                        <input type="hidden" name="searchAside" />
                    </div>
                    <div>
                        <input type="submit" value="Search" />
                    </div>
                </form>
                <div class="advanced">
                    <a href="product/search">Avanced Search</a>
                </div>
            </div>
            <div class="result">
                <h1><span>Type Something !</span></h1>
            </div>
        </section>
        <!-- +------------- END SEARCH -------------+ -->
        <!-- +------------- START CONTACT US -------------+ -->
        <section class="sideBarStyle contactAside">
            <div class="back">
                <i class="la la-arrow-right"></i>
            </div>
            <div class="contactUs">
                Contact Us
            </div>
            <form>
                <div>
                    <input type="text" name="firstName" placeholder="First Name" />
                </div>
                <div>
                    <input type="text" name="lastName" placeholder="Last Name" />
                </div>
                <div>
                    <input type="email" name="email" placeholder="Email" />
                </div>
                <div>
                    <input type="text" name="subject" placeholder="Subject" />
                </div>
                <div>
                    <textarea maxlength="1000" name="theMessage" placeholder="The Message"></textarea>
                </div>
                <div>
                    <input type="submit" value="Send" />
                </div>
            </form>
        </section>
        <!-- +------------- END CONTACT US -------------+ -->