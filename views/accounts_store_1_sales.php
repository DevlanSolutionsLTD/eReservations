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
require_once('../config/codeGen.php');
checklogin();
require_once('../partials/head.php');
?>

<body class="nk-body npc-invest bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <?php require_once('../partials/finance_header.php');
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
                                        <nav>
                                            <ul class="breadcrumb breadcrumb-arrow">
                                                <li class="breadcrumb-item"><a href="accounts_home">Home</a></li>
                                                <li class="breadcrumb-item active">Store 1 Sales</li>
                                            </ul>
                                        </nav>
                                        <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                            <div>
                                                <h2 class="nk-block-title fw-normal">Store 1 Sales Reports</h2>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                            </div>
                            <hr>
                            <div class="nk-block">
                                <fieldset class="border border-primary p-2">
                                    <legend class="w-auto text-center text-primary font-weight-bold"> Select Any Date Range To Generate Sales Records </legend>
                                    <form method="post" enctype="multipart/form-data" role="form">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Start Date</label>
                                                    <input type="date" required name="start_date" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">End Date</label>
                                                    <input type="date" required name="end_date" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="enter_range" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </fieldset>
                                <br><br><br>


                                <?php
                                if (isset($_POST['enter_range'])) {
                                    $start_date = $_POST['start_date'];
                                    $end_date = $_POST['end_date'];
                                ?>
                                    <div class="text-center">
                                        <a href="accounts_download_store1_reports?start=<?php echo $start_date; ?>&end=<?php echo $end_date; ?>" class="btn btn-white btn-outline-light">
                                            <em class="icon ni ni-download"></em>
                                            <span>
                                                Download Sales Record
                                            </span>
                                        </a>
                                    </div>
                                    <br>
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card card-bordered card-preview">
                                                <div class="card-inner">
                                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th class="nk-tb-col"><span class="sub-text">Product Details</span></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Qty & Price</span></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Customer Details</span></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Date Purchase Posted</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ret = "SELECT * FROM sales s
                                                            INNER JOIN products p ON p.product_id = s.sale_product_id
                                                            INNER JOIN product_categories pc ON pc.category_id = p.product_category_id
                                                            INNER JOIN users u ON u.user_id = s.sale_user_id
                                                            WHERE p.product_access_level  = 'store_1' AND  (sale_date BETWEEN '$start_date' AND '$end_date') ";
                                                            $stmt = $mysqli->prepare($ret);
                                                            $stmt->execute(); //ok
                                                            $res = $stmt->get_result();
                                                            while ($sales = $res->fetch_object()) {
                                                                /* Compute Price */
                                                                $total_price = $sales->sale_quantity * $sales->product_retail_price;
                                                            ?>
                                                                <tr class="nk-tb-item">
                                                                    <td class="nk-tb-col tb-col-mb">
                                                                        <span class="tb-amount">
                                                                            Name: <?php echo $sales->product_name; ?><br>
                                                                            Category: <?php echo $sales->category_name; ?><br>
                                                                            Price : Ksh <?php echo $sales->product_retail_price; ?><br>
                                                                        </span>
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-mb">
                                                                        <span class="tb-amount">
                                                                            Qty: <?php echo $sales->sale_quantity; ?><br>
                                                                            Price: Ksh <?php echo $total_price; ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-mb">
                                                                        <span class="tb-amount">
                                                                            Name: <?php echo $sales->sale_customer_name; ?><br>
                                                                            Contacts: <?php echo $sales->sale_customer_phoneno; ?><br>
                                                                            Address: <?php echo $sales->sale_customer_address; ?>
                                                                        </span>
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-mb">
                                                                        <span class="tb-amount"><?php echo date('d M Y g:ia', strtotime($sales->sale_date)); ?></span>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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