<?php
/*
 * Created on Mon Nov 08 2021
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
/* Update Profile */
if (isset($_POST['update_profile'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_POST['user_name'];
    $old_password = sha1(md5($_POST['old_password']));
    $new_password = sha1(md5($_POST['new_password']));
    $confirm_password = sha1(md5($_POST['confirm_password']));

    /* Check if the old matches with record */
    $ret = "SELECT * FROM  users WHERE user_id  ='$user_id'";
    $stmt = $mysqli->prepare($ret);
    $stmt->execute(); //ok
    $res = $stmt->get_result();
    while ($user = $res->fetch_object()) {
        /* Old password */
        $password_from_db = $user->user_password;
        if ($old_password == $password_from_db) {
            /* Check If They Match */
            if ($new_password == $confirm_password) {
                $query = 'UPDATE users SET  user_name =?,user_password=? WHERE user_id =?';
                $stmt = $mysqli->prepare($query);
                $rc = $stmt->bind_param('sss', $user_name, $new_password, $user_id);
                $stmt->execute();
                if ($stmt) {
                    $success = "Personal Details Updated";
                } else {
                    //inject alert that task failed
                    $err = 'Please Try Again Or Try Later';
                }
            } else {
                $err = 'Failed!, Confirmation Passwords Does Not Match';
            }
        } else {
            $err = 'Incorrect Old Password.Try Again';
        }
    }
}
require_once('../partials/head.php');
?>

<body class="nk-body npc-invest bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <?php require_once('../partials/store_header.php');
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
                                            <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                                <div>
                                                    <h2 class="nk-block-title fw-normal">Profile Settings</h2>
                                                </div>
                                            </div><!-- .nk-block-head-content -->
                                            <div class="card card-bordered">
                                                <div class="card-aside-wrap">
                                                    <div class="card-inner card-inner-lg">
                                                        <form method="post" enctype="multipart/form-data" role="form">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="">Username</label>
                                                                        <input type="text" value="<?php echo $user->user_name; ?>" required name="user_name" class="form-control">
                                                                    </div>

                                                                    <div class="form-group col-md-12">
                                                                        <label for="">Old Password</label>
                                                                        <input type="text" required name="old_password" class="form-control">
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="">New Password</label>
                                                                        <input type="text" required name="new_password" class="form-control">
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="">Confirm New Password</label>
                                                                        <input type="password" required name="confirm_password" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-right">
                                                                <button type="submit" name="update_profile" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div><!-- .card-aside-wrap -->
                                            </div><!-- .card -->
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