<?php
/*
 * Created on Wed Nov 17 2021
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
require_once('../config/config.php');
require_once('../config/checklogin.php');
checklogin();
require_once('../partials/analytics.php');
require_once('../partials/head.php');
?>

<body class="nk-body npc-invest bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <?php require_once('../partials/finance_header.php');
            $user_id = $_SESSION['user_id'];
            $ret = "SELECT * FROM  users WHERE user_id = '$user_id'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($user = $res->fetch_object()) {
            ?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-between-md g-3">
                                        <div class="nk-block-head-content">
                                            <div class="nk-block-head-sub"><span>Welcome!</span></div>
                                            <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                                <div>
                                                    <h2 class="nk-block-title fw-normal"><?php echo $user->user_name; ?></h2>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="nk-block">
                                                <div class="row g-gs">
                                                    <div class="col-xxl-12">
                                                        <div class="row g-gs">
                                                            <div class="col-lg-12 col-xxl-12">
                                                                <div class="row g-gs">
                                                                    <div class="col-sm-4 col-lg-4 col-xxl-4">
                                                                        <div class="card card-bordered">
                                                                            <div class="card-inner">
                                                                                <div class="card-title-group align-start mb-2">
                                                                                    <div class="card-title">
                                                                                        <h6 class="title">Store 1 Sales Revenue</h6>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                                                    <div class="nk-sale-data">
                                                                                        <span class="amount">
                                                                                            Ksh <?php echo $store_1_sales; ?>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="nk-sales-ck text-right">
                                                                                        <i class="fas fa-hand-holding-usd fa-4x"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!-- .card -->
                                                                    </div><!-- .col -->
                                                                    <div class="col-sm-4 col-lg-4 col-xxl-4">
                                                                        <div class="card card-bordered">
                                                                            <div class="card-inner">
                                                                                <div class="card-title-group align-start mb-2">
                                                                                    <div class="card-title">
                                                                                        <h6 class="title">Store 2 Sales Revenue</h6>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                                                    <div class="nk-sale-data">
                                                                                        <span class="amount">
                                                                                            <?php echo $store_2_sales; ?>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="nk-sales-ck text-right">
                                                                                        <i class="fas fa-hand-holding-usd fa-4x"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!-- .card -->
                                                                    </div><!-- .col -->
                                                                    <div class="col-sm-4 col-lg-4 col-xxl-4">
                                                                        <div class="card card-bordered">
                                                                            <div class="card-inner">
                                                                                <div class="card-title-group align-start mb-2">
                                                                                    <div class="card-title">
                                                                                        <h6 class="title">Overall Bookstore Sales Revenue</h6>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                                                    <div class="nk-sale-data">
                                                                                        <span class="amount">Ksh
                                                                                            <?php echo $total_revenue; ?>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="nk-sales-ck text-right">
                                                                                        <i class="fas fa-money-bill-alt fa-4x"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div><!-- .card -->
                                                                    </div><!-- .col -->

                                                                </div><!-- .row -->
                                                            </div><!-- .col -->
                                                        </div><!-- .row -->
                                                    </div><!-- .col -->

                                                    <div class="col-md-6 col-xxl-6">
                                                        <div class="card card-bordered card-full">
                                                            <div class="card-inner border-bottom">
                                                                <div class="card-title-group">
                                                                    <div class="card-title">
                                                                        <h6 class="title">Recent Product Sales</h6>
                                                                    </div>
                                                                    <div class="card-tools">
                                                                        <a href="acounts_overall_sales" class="link">View All</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul class="nk-activity">
                                                                <?php
                                                                /* Load Sales Logs */
                                                                $ret = "SELECT * FROM sales s
                                                                INNER JOIN products p ON p.product_id = s.sale_product_id
                                                                INNER JOIN product_categories pc ON pc.category_id = p.product_category_id
                                                                INNER JOIN users u ON u.user_id = s.sale_user_id
                                                                ORDER BY s.sale_date DESC";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($sales = $res->fetch_object()) {
                                                                    /* Compute Price */
                                                                    $total_price = $sales->sale_quantity * $sales->product_retail_price;
                                                                ?>
                                                                    <li class="nk-activity-item">
                                                                        <div class="nk-activity-media user-avatar bg-success">
                                                                            <?php echo substr($sales->sale_customer_name, 0, 2); ?>
                                                                        </div>
                                                                        <div class="nk-activity-data">
                                                                            <div class="label">
                                                                                <span class="text-dark"><?php echo $sales->user_name; ?></span> has sold <span class="test-dark"><?php echo $sales->sale_quantity; ?></span> copies
                                                                                of <span class="text-dark"><?php echo $sales->product_name; ?></span> to <span class="text-dark"><?php echo $sales->sale_customer_name; ?></span>. Payment of <span class="text-dark">Ksh <?php echo $total_price; ?></span> has been posted.
                                                                            </div>
                                                                            <span class="time text-success"><?php echo date('M, d Y g:ia', strtotime($sales->sale_date)); ?></span>
                                                                        </div>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div><!-- .card -->
                                                    </div><!-- .col -->
                                                    <div class="col-md-6 col-xxl-6">
                                                        <div class="card card-bordered card-full">
                                                            <div class="card-inner border-bottom">
                                                                <div class="card-title-group">
                                                                    <div class="card-title">
                                                                        <h6 class="title">Out Of Stock Products</h6>
                                                                    </div>
                                                                    <div class="card-tools">
                                                                        <a href="accounts_out_of_stock" class="link">View All</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <ul class="nk-activity">
                                                                <?php
                                                                /* Load All Products That Are Out Of Stock */
                                                                $ret = "SELECT * FROM  products p INNER JOIN product_categories pc
                                                                ON pc.category_id = p.product_category_id 
                                                                WHERE p.product_quantity <=1
                                                                ORDER BY p.product_name ASC ";
                                                                $stmt = $mysqli->prepare($ret);
                                                                $stmt->execute(); //ok
                                                                $res = $stmt->get_result();
                                                                while ($products = $res->fetch_object()) {
                                                                ?>
                                                                    <li class="nk-activity-item">
                                                                        <div class="nk-activity-media user-avatar bg-success">
                                                                            <?php echo substr($products->product_name, 0, 2); ?>
                                                                        </div>
                                                                        <div class="nk-activity-data">
                                                                            <div class="label">
                                                                                <?php echo $products->product_name; ?><br>
                                                                                Is out of stock, kindly plan on restocking this product.<br>
                                                                                <span class="text-danger"> Quantity Available: <?php echo $products->product_quantity; ?></span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div><!-- .card -->
                                                    </div><!-- .col -->
                                                </div><!-- .row -->
                                            </div><!-- .nk-block -->
                                        </div><!-- .nk-block-between -->
                                    </div><!-- .nk-block-head -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- content @e -->
            <!-- footer @s -->
            <?php require_once('../partials/staff_footer.php'); ?>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>