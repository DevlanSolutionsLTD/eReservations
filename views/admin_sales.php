<?php
/*
 * Created on Thu Nov 04 2021
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
require_once('../config/codeGen.php');
require_once('../config/checklogin.php');

checklogin();

/* Add Product Sale Record */
if (isset($_POST['add_sale'])) {
    $sale_id = $sale_id;
    $sale_product_id = $_POST['sale_product_id'];
    $sale_quantity = $_POST['sale_quantity'];
    $sale_user_id = $_POST['sale_user_id'];
    $sale_customer_name = $_POST['sale_customer_name'];
    $sale_customer_phoneno  = $_POST['sale_customer_phoneno'];
    $sale_receipt_number  = $_POST['sale_receipt_number'];

    $ret = "SELECT * FROM  products WHERE product_id  ='$sale_product_id'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($product = $res->fetch_object()) {
        //no of product in stock
        $no_of_products = $product->product_quantity;
        //no of puchase
        $no_of_puchase = $sale_quantity;
        /* Product name */
        $product_name = $product->product_name;

        if ($no_of_products >= $no_of_puchase) {
            $new_product_quantity = $no_of_products - $no_of_puchase;
            $query1 = 'UPDATE products SET  product_quantity=? WHERE product_id =?';
            $query2 = 'INSERT INTO sales (
                sale_id,
                sale_product_id,
                sale_quantity,
                sale_user_id,
                sale_customer_name,
                sale_customer_phoneno,
                sale_receipt_number )
                VALUES (?,?,?,?,?,?,?)';
            /* Preparation for 2 sql operation */
            $stmt1 = $mysqli->prepare($query1);
            $stmt2 = $mysqli->prepare($query2);
            /* Binding for 2 sql operation */
            $rc1 = $stmt1->bind_param('ss', $new_product_quantity, $sale_product_id);
            $rc2 = $stmt2->bind_param(
                'sssssss',
                $sale_id,
                $sale_product_id,
                $sale_quantity,
                $sale_user_id,
                $sale_customer_name,
                $sale_customer_phoneno,
                $sale_receipt_number
            );

            /* Execution for 2 sql operation */
            $stmt1->execute();
            $stmt2->execute();
            if ($stmt1 && $stmt2) {
                $success = "$sale_quantity copies of  $product_name sold to $sale_customer_name";
            } else {
                //inject alert that task failed
                $err = 'Please Try Again Or Try Later';
            }
        } elseif ($no_of_products < $no_of_puchase) {
            $err = "There is $no_of_products  $product_name available.";
        } else {
            $err = 'Please Try Again Or Try Later';
        }
    }
}


/* Update Product Sale Record */
if (isset($_POST['update_sale'])) {
    $sale_id = $_POST['sale_id'];;
    $sale_quantity = $_POST['sale_quantity'];
    $sale_customer_name = $_POST['sale_customer_name'];
    $sale_customer_phoneno  = $_POST['sale_customer_phoneno'];
    $sale_receipt_number = $_POST['sale_receipt_number'];

    //check difference on new quantity in sales
    $ret = "SELECT * FROM  sales WHERE sale_id  ='$sale_id'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($sale = $res->fetch_object()) {
        $current_quantity = $sale->sale_quantity;
        $product_id = $sale->sale_product_id;
        if ($sale_quantity >= $current_quantity) {
            $ret = "SELECT * FROM  products WHERE product_id  ='$product_id'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($product = $res->fetch_object()) {
                /* Product name */
                $product_name = $product->product_name;
                /* Current product quantity */
                $product_quantity = $product->product_quantity;
                /* Find the new Product quantity */
                $new_product_quantity = $product_quantity - $sale_quantity;

                /* sqls */
                $query1 = 'UPDATE sales SET  
                sale_quantity=?,
                sale_customer_name=?,
                sale_customer_phoneno=?,
                sale_receipt_number =?
                WHERE sale_id =?';

                $query2 = 'UPDATE products SET  product_quantity=? WHERE product_id =?';
                /* Preparation for 2 sql operation */
                $stmt1 = $mysqli->prepare($query1);
                $stmt2 = $mysqli->prepare($query2);
                /* Binding for 2 sql operation */

                $rc1 = $stmt1->bind_param(
                    'sssss',
                    $sale_quantity,
                    $sale_customer_name,
                    $sale_customer_phoneno,
                    $sale_receipt_number,
                    $sale_id,
                );
                $rc2 = $stmt2->bind_param('ss', $new_product_quantity, $product_id);
                /* Execution for 2 sql operation */
                $stmt1->execute();
                $stmt2->execute();
                if ($stmt1 && $stmt2) {

                    $success = "$product_name's quantity $sale_quantity, Updated";
                } else {
                    //inject alert that task failed
                    $err = 'Please Try Again Or Try Later';
                }
            }
        } elseif ($sale_quantity < $current_quantity) {
            $ret = "SELECT * FROM  products  WHERE product_id  ='$product_id'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($product = $res->fetch_object()) {
                /* Product name */
                $product_name = $product->product_name;
                /* Current product quantity */
                $product_quantity = $product->product_quantity;
                /* Find the new Product quantity */
                $new_product_quantity = $current_quantity + $sale_quantity;
            }
            /* sqls */
            $query1 = 'UPDATE sales SET  
            sale_quantity=?,
            sale_customer_name=?,
            sale_customer_phoneno=?,
            sale_receipt_number =?
            WHERE sale_id =?';
            $query2 = 'UPDATE products SET  product_quantity=? WHERE product_id =?';
            /* Preparation for 2 sql operation */
            $stmt1 = $mysqli->prepare($query1);
            $stmt2 = $mysqli->prepare($query2);
            /* Binding for 2 sql operation */

            $rc1 = $stmt1->bind_param(
                'sssss',
                $sale_quantity,
                $sale_customer_name,
                $sale_customer_phoneno,
                $sale_receipt_number,
                $sale_id
            );
            $rc2 = $stmt2->bind_param('ss', $new_product_quantity, $product_id);
            /* Execution for 2 sql operation */
            $stmt1->execute();
            $stmt2->execute();
            if ($stmt1 && $stmt2) {
                $success = "$product_name's quantity $sale_quantity, Updated";
            } else {
                //inject alert that task failed
                $err = 'Please Try Again Or Try Later';
            }
        } else {
            $err = 'Please Try Again Or Try Later';
        }
    }
}

/* Delete Product Sale Record */
if (isset($_GET['delete'])) {
    $sale_id = $_GET['delete'];
    //check difference on Current product quantity in sales
    $ret = "SELECT * FROM  sales WHERE sale_id  ='$sale_id'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($sale = $res->fetch_object()) {
        // product id
        $product_id = $sale->sale_product_id;
        /* Current sale quantity */
        $current_quantity_sale = $sale->sale_quantity;
        //check difference on Current product quantity in Products
        $ret = "SELECT * FROM  products WHERE product_id  ='$product_id'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($product = $res->fetch_object()) {
            /*Product name */
            $product_name = $product->product_name;
            /* current product quantity in products */
            $current_quantity_product = $product->product_quantity;
            /* Calculate new product quantity */
            $new_product_quantity =  $current_quantity_sale + $current_quantity_product;
            /* Update product quality and Delete the sale Record*/
            /*SQL */
            $query1 = 'UPDATE products SET  product_quantity=? WHERE product_id =?';
            $query2 = "DELETE FROM sales WHERE sale_id=?";
            /* Prepare the sqls */
            $stmt1 = $mysqli->prepare($query1);
            $stmt2 = $mysqli->prepare($query2);
            /* Bind parameters */
            $stmt1->bind_param('ss', $new_product_quantity, $product_id);
            $stmt2->bind_param('s', $sale_id);
            /* Execute sql query */
            $stmt1->execute();
            $stmt2->execute();

            $stmt1->close();
            $stmt2->close();
            if ($stmt1 && $stmt2) {
                $success = "Sale of $current_quantity_sale $product_name is deleted" && header("refresh:1; url=admin_sales");
            } else {
                $info = "Please Try Again Or Try Later";
            }
        }
    }
}

require_once('../partials/head.php');

?>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <?php require_once('../partials/sidebar.php'); ?>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php require_once('../partials/header.php'); ?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Sales</h3>
                                            <div class="nk-block-des text-soft">
                                                <nav>
                                                    <ul class="breadcrumb breadcrumb-arrow">
                                                        <li class="breadcrumb-item"><a href="admin_dashboard">Home</a></li>
                                                        <li class="breadcrumb-item active">Sales</li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div><!-- .nk-block-head-content -->

                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li><a href="#add_modal" data-toggle="modal" class="btn btn-white btn-outline-light"><em class="icon ni ni-plus"></em><span>Add Sale Record</span></a></li>
                                                    </ul>
                                                </div>
                                            </div><!-- .toggle-wrap -->
                                        </div><!-- .nk-block-head-content -->
                                        <!-- Add Modal -->
                                        <div class="modal fade" id="add_modal">
                                            <div class="modal-dialog  modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Register New Product Sale Record</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data" role="form">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="">Product Name</label>
                                                                        <select name="sale_product_id" class="form-select form-control form-control-lg" data-search="on">
                                                                            <?php
                                                                            $ret = "SELECT * FROM  products p INNER JOIN product_categories c ON c.category_id = p.product_category_id";
                                                                            $stmt = $mysqli->prepare($ret);
                                                                            $stmt->execute(); //ok
                                                                            $res = $stmt->get_result();
                                                                            while ($product = $res->fetch_object()) {
                                                                            ?>
                                                                                <option value="<?php echo $product->product_id; ?>"><?php echo $product->product_name; ?> - <?php echo $product->category_name; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="">Product Sale Quantity</label>
                                                                        <input type="number" required name="sale_quantity" class="form-control">
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label for="">Receipt Number</label>
                                                                        <input type="number" required name="sale_receipt_number" class="form-control">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="">R.C.C</label>
                                                                        <input type="text" required name="sale_customer_name" class="form-control">
                                                                        <input type="hidden" required name="sale_user_id" value="<?php echo $user_id ?>" class="form-control">
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="">D.C.C</label>
                                                                        <input type="text" required name="sale_customer_phoneno" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-right">
                                                                <button type="submit" name="add_sale" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card card-bordered card-preview">
                                                <div class="card-inner">
                                                    <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                        <thead>
                                                            <tr class="nk-tb-item nk-tb-head">
                                                                <th class="nk-tb-col"><span class="sub-text">Receipt No.</span></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Product Details</span></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Qty & Price</span></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Sold By</span></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Customer Details</span></th>
                                                                <th class="nk-tb-col"><span class="sub-text">Date Purchase Posted</span></th>
                                                                <th class="nk-tb-col nk-tb-col-tools text-right">
                                                                    <span class="sub-text">Action</span>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ret = "SELECT * FROM sales s
                                                            INNER JOIN products p ON p.product_id = s.sale_product_id
                                                            INNER JOIN product_categories pc ON pc.category_id = p.product_category_id
                                                            INNER JOIN users u ON u.user_id = s.sale_user_id";
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
                                                                            <?php echo $sales->sale_receipt_number; ?>
                                                                        </span>
                                                                    </td>
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
                                                                        <span class="tb-amount"><?php echo $sales->user_name; ?></span>
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-mb">
                                                                        <span class="tb-amount">
                                                                            R.C.C: <?php echo $sales->sale_customer_name; ?><br>
                                                                            D.C.C: <?php echo $sales->sale_customer_phoneno; ?><br>
                                                                        </span>
                                                                    </td>
                                                                    <td class="nk-tb-col tb-col-mb">
                                                                        <span class="tb-amount"><?php echo date('d M Y g:ia', strtotime($sales->sale_date)); ?></span>
                                                                    </td>
                                                                    <td class="nk-tb-col nk-tb-col-tools">
                                                                        <ul class="nk-tb-actions gx-1">
                                                                            <li>
                                                                                <div class="drodown">
                                                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                                        <ul class="link-list-opt no-bdr">
                                                                                            <li><a data-toggle="modal" href="#update-<?php echo $sales->sale_id; ?>"><em class="icon ni ni-edit"></em><span>Update </span></a></li>
                                                                                            <li><a data-toggle="modal" href="#delete-<?php echo $sales->sale_id; ?>"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <!-- Edit Profile Modal -->
                                                                    <div class="modal fade" id="update-<?php echo $sales->sale_id; ?>">
                                                                        <div class="modal-dialog  modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Update Sale Record</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form method="post" enctype="multipart/form-data" role="form">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label for="">Product Sale Quantity</label>
                                                                                                    <input type="number" required name="sale_quantity" value="<?php echo $sales->sale_quantity; ?>" class="form-control">
                                                                                                    <!-- Hide This -->
                                                                                                    <input type="hidden" required name="sale_id" value="<?php echo $sales->sale_id; ?>" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label for="">Receipt Number</label>
                                                                                                    <input type="text" required name="sale_receipt_number" value="<?php echo $sales->sale_receipt_number; ?>" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label for="">R.C.C</label>
                                                                                                    <input type="text" required name="sale_customer_name" value="<?php echo $sales->sale_customer_name; ?>" class="form-control">
                                                                                                </div>
                                                                                                <div class="form-group col-md-6">
                                                                                                    <label for="">D.C.C</label>
                                                                                                    <input type="text" required name="sale_customer_phoneno" value="<?php echo $sales->sale_customer_phoneno; ?>" class="form-control">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-right">
                                                                                            <button type="submit" name="update_sale" class="btn btn-primary">Submit</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Modal -->

                                                                    <!-- Delete Modal -->
                                                                    <div class="modal fade" id="delete-<?php echo $sales->sale_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">CONFIRM DELETION</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-center text-danger">
                                                                                    <h4>Delete This Purchase Record?</h4>
                                                                                    <br>
                                                                                    <p>Heads Up, You are about to delete this record. This action is irrevisble.</p>
                                                                                    <button type="button" class="text-center btn btn-success" data-dismiss="modal">No</button>
                                                                                    <a href="admin_sales?delete=<?php echo $sales->sale_id; ?>" class="text-center btn btn-danger"> Delete </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- End Modal -->
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <?php require_once('../partials/footer.php'); ?>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- Js -->
    <?php require_once('../partials/scripts.php'); ?>
</body>

</html>