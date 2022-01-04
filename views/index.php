<?php
/*
 * Created on Tue Nov 02 2021
 *
 *  Devlan - devlan.co.ke 
 *
 * hello@devlan.info
 *
 *
 * The Devlan End User License Agreement
 *
 * Copyright (c) 2021 Devlan
 *
 * 1. GRANT OF LICENSE
 * Devlan hereby grants to you (an individual) the revocable, personal, non-exclusive, and nontransferable right to
 * install and activate this system on two separated computers solely for your personal and non-commercial use,
 * unless you have purchased a commercial license from Devlan. Sharing this Software with other individuals, 
 * or allowing other individuals to view the contents of this Software, is in violation of this license.
 * You may not make the Software available on a network, or in any way provide the Software to multiple users
 * unless you have first purchased at least a multi-user license from Devlan.
 *
 * 2. COPYRIGHT 
 * The Software is owned by Devlan and protected by copyright law and international copyright treaties. 
 * You may not remove or conceal any proprietary notices, labels or marks from the Software.
 *
 * 3. RESTRICTIONS ON USE
 * You may not, and you may not permit others to
 * (a) reverse engineer, decompile, decode, decrypt, disassemble, or in any way derive source code from, the Software;
 * (b) modify, distribute, or create derivative works of the Software;
 * (c) copy (other than one back-up copy), distribute, publicly display, transmit, sell, rent, lease or 
 * otherwise exploit the Software.  
 *
 * 4. TERM
 * This License is effective until terminated. 
 * You may terminate it at any time by destroying the Software, together with all copies thereof.
 * This License will also terminate if you fail to comply with any term or condition of this Agreement.
 * Upon such termination, you agree to destroy the Software, together with all copies thereof.
 *
 * 5. NO OTHER WARRANTIES. 
 * Devlan  DOES NOT WARRANT THAT THE SOFTWARE IS ERROR FREE. 
 * Devlan SOFTWARE DISCLAIMS ALL OTHER WARRANTIES WITH RESPECT TO THE SOFTWARE, 
 * EITHER EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT OF THIRD PARTY RIGHTS. 
 * SOME JURISDICTIONS DO NOT ALLOW THE EXCLUSION OF IMPLIED WARRANTIES OR LIMITATIONS
 * ON HOW LONG AN IMPLIED WARRANTY MAY LAST, OR THE EXCLUSION OR LIMITATION OF 
 * INCIDENTAL OR CONSEQUENTIAL DAMAGES,
 * SO THE ABOVE LIMITATIONS OR EXCLUSIONS MAY NOT APPLY TO YOU. 
 * THIS WARRANTY GIVES YOU SPECIFIC LEGAL RIGHTS AND YOU MAY ALSO 
 * HAVE OTHER RIGHTS WHICH VARY FROM JURISDICTION TO JURISDICTION.
 *
 * 6. SEVERABILITY
 * In the event of invalidity of any provision of this license, the parties agree that such invalidity shall not
 * affect the validity of the remaining portions of this license.
 *
 * 7. NO LIABILITY FOR CONSEQUENTIAL DAMAGES IN NO EVENT SHALL DEVLAN  OR ITS SUPPLIERS BE LIABLE TO YOU FOR ANY
 * CONSEQUENTIAL, SPECIAL, INCIDENTAL OR INDIRECT DAMAGES OF ANY KIND ARISING OUT OF THE DELIVERY, PERFORMANCE OR 
 * USE OF THE SOFTWARE, EVEN IF DEVLAN HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES
 * IN NO EVENT WILL DEVLAN  LIABILITY FOR ANY CLAIM, WHETHER IN CONTRACT 
 * TORT OR ANY OTHER THEORY OF LIABILITY, EXCEED THE LICENSE FEE PAID BY YOU, IF ANY.
 */
session_start();
require_once '../config/config.php';
require_once '../config/checklogin.php';
require_once '../config/codeGen.php';


/* Login In */
if (isset($_POST['Login'])) {
    $user_name = $_POST['user_name'];
    $user_password = sha1(md5($_POST['user_password']));
    $stmt = $mysqli->prepare("SELECT user_password,user_access_level,user_id FROM users WHERE user_name=? and user_password=? ");
    $stmt->bind_param('ss', $user_name, $user_password);
    $stmt->execute();
    $stmt->bind_result($user_password, $user_access_level, $user_id);
    $rs = $stmt->fetch();

    if ($rs && $user_access_level == "admin") {
        $_SESSION['user_id'] = $user_id;
        header("location:admin_dashboard");
    } elseif ($rs && $user_access_level == "staff") {
        $_SESSION['user_id'] = $user_id;
        header("location:staff_home");
    } elseif ($rs && $user_access_level == "Staff") {
        $_SESSION['user_id'] = $user_id;
        header("location:staff_home");
    } elseif ($rs && $user_access_level == "store_1") {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_access_level'] = $user_access_level;
        header("location:store_home");
    } elseif ($rs && $user_access_level == "store_2") {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_access_level'] = $user_access_level;
        header("location:store_home");
    } elseif ($rs && $user_access_level == "finance") {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_access_level'] = $user_access_level;
        header("location:accounts_home");
    } else {
        $err = "Access Denied Please Check Your Name Or Password";
    }
}
require_once('../partials/head.php');
?>

<body class="nk-body npc-crypto ui-clean pg-auth">
    <!-- app body @s -->
    <div class="nk-app-root">
        <div class="nk-split nk-split-page nk-split-md">
            <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container">
                <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                    <a href="index" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                </div>
                <div class="nk-block nk-block-middle nk-auth-body">
                    <!-- <div class="brand-logo pb-5">
                        <a href="index" class="logo-link">
                            <img class="logo-light logo-img logo-img-lg" src="../public/images/logo.png" alt="logo">
                            <img class="logo-dark logo-img logo-img-lg" src="../public/images/logo.png" alt="logo-dark">
                        </a>
                    </div> -->
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Sign-In</h5>
                            <div class="nk-block-des">
                                <p>Enter Your Username And Password To Access Dashboard.</p>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <form method="post">
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Username</label>
                            </div>
                            <input type="text" name="user_name" required class="form-control form-control-lg" id="default-01">
                        </div><!-- .foem-group -->
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Password</label>
                                <a class="link link-primary link-sm" tabindex="-1" href="reset_password">Forgot Password?</a>
                            </div>
                            <div class="form-control-wrap">
                                <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" required name="user_password" class="form-control form-control-lg" id="password">
                            </div>
                        </div><!-- .foem-group -->
                        <div class="form-group">
                            <button type="submit" name="Login" class="btn btn-lg btn-primary btn-block">Sign in</button>
                        </div>
                    </form><!-- form -->
                </div><!-- .nk-block -->
                <div class="nk-block nk-auth-footer">
                    <div class="nk-block-between">
                    </div>
                    <div class="mt-3 text-center">
                        <p>&copy; 2021 - <?php echo date('Y'); ?> Bookstore Invetory System. Crafted With <i class="text-danger fas fa-heart"></i> & <i class="text-danger fas fa-coffee"></i> By <a href="https://devlan.co.ke">Devlan</a>. All Rights Reserved.</p>
                    </div>
                </div><!-- .nk-block -->
            </div><!-- .nk-split-content -->
            <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
                <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
                    <div class="slider-init">
                        <div class="slider-item">
                            <div class="nk-feature nk-feature-center">
                                <div class="nk-feature-img">
                                    <img class="round" src="../public/images/login_bg.png" alt="">
                                </div>
                            </div>
                        </div><!-- .slider-item -->
                    </div><!-- .slider-init -->
                </div><!-- .slider-wrap -->
            </div><!-- .nk-split-content -->
        </div><!-- .nk-split -->
    </div><!-- app body @e -->
    <!-- JavaScript -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>