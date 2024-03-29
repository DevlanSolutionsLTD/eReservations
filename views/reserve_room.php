<?php
/*
 * Created on Fri Jan 07 2022
 *
 *  Devlan - devlan.co.ke 
 *
 * hello@devlan.info
 *
 *
 * The Devlan End User License Agreement
 *
 * Copyright (c) 2022 Devlan
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
require_once('../partials/head.php');
require_once('../config/codeGen.php');
require_once('../config/config.php');

/* Persist System Update */
if (isset($_POST['reserve_room'])) {
    $reservation_id = $reservation_id;
    $reservation_room_id = $_GET['room_id'];
    $client_name  = $_POST['client_name'];
    $client_id_no = $_POST['client_id_no'];
    $client_phone = $_POST['client_phone'];
    $client_email = $_POST['client_email'];
    $mode_of_payment = $_POST['mode_of_payment'];
    $duration = $_POST['duration'];
    $total_cost = $_POST['total_cost'];

    if ($mode_of_payment == 'Mpesa') {

        $query = 'INSERT INTO reservations(reservation_id, reservation_room_id,client_name,client_id_no, client_email, client_phone, mode_of_payment,cost )
         VALUES (?,?,?,?,?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'ssssssss',
            $reservation_id,
            $reservation_room_id,
            $client_name,
            $client_id_no,
            $client_email,
            $client_phone,
            $mode_of_payment,
            $total_cost

        );
        $stmt->execute();
        if ($stmt) {
            /* Load Mpesa Logic Here */
            include_once('../Mpesa/stkpay.php');
            $success = "Room Reserved";
        } else {
            //inject alert that task failed
            $err = 'Please Try Again Or Try Later';
        }
    } else if ($mode_of_payment == 'card') {
        /* Process Card Payment Here */
        $query = 'INSERT INTO reservations(reservation_id, reservation_room_id,client_name,client_id_no, client_email, client_phone, mode_of_payment,cost,duration)
         VALUES (?,?,?,?,?,?,?,?,?)';
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param(
            'sssssssss',
            $reservation_id,
            $reservation_room_id,
            $client_name,
            $client_id_no,
            $client_email,
            $client_phone,
            $mode_of_payment,
            $total_cost,
            $duration
        );
        $stmt->execute();
        if ($stmt) {
            /* Load Mpesa Logic Here */
            include('../helpers/flutterwave/process_payment.php');
            $success = "Room Reserved";
        } else {
            //inject alert that task failed
            $err = 'Please Try Again Or Try Later';
        }
    } else {
        $err = "Your Shit Just Hit The Fan";
    }
}
?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php require_once('../partials/nav.php'); ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> Reserve Room <?php echo $_GET['room_number']; ?> </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="rooms">Rooms</a></li>
                                <li class="breadcrumb-item active"><?php echo $_GET['room_number']; ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form method="post" enctype="multipart/form-data">
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-light">Room Details</legend>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Room Number</label>
                                                <input type="text" readonly value="<?php echo $_GET['room_number']; ?>" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Room Price (Ksh)</label>
                                                <input type="text" readonly name="" id="RoomPrice" value="<?php echo $_GET['room_price']; ?>" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Days Reserved</label>
                                                <select type="text" name="duration" id="DaysReserved" required class="form-control">
                                                    <option>Select Days Reserved</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                    <option>6</option>
                                                    <option>7</option>
                                                    <option>8</option>
                                                    <option>9</option>
                                                    <option>10</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Payable Reservation Amount (Ksh)</label>
                                                <input required type="text" readonly name="total_cost" id="TotalReservationPrice" required class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-light">Client Details</legend>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Client Name</label>
                                                <input type="text" name="client_name" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Client Phone Number</label>
                                                <input type="text" name="client_phone" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Client ID Number</label>
                                                <input type="text" name="client_id_no" required class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Client Email</label>
                                                <input type="text" name="client_email" required class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="border border-primary p-2">
                                        <legend class="w-auto text-primary font-weight-light">Mode Of Payment</legend>
                                        <div class="form-row">
                                            <select type="text" name="mode_of_payment" required class="form-control">
                                                <option>Mpesa</option>
                                                <option value="card">Card Payment</option>
                                            </select>
                                        </div>
                                    </fieldset>
                                    <br><br>
                                    <div class="text-right">
                                        <button name="reserve_room" class="btn btn-primary" type="submit">
                                            Checkout Reservation For Room Number <?php echo $_GET['room_number']; ?>
                                        </button>
                                    </div>
                                    <br><br><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php require_once('../partials/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <?php require_once('../partials/scripts.php'); ?>
    <script>
        $('#DaysReserved').on('change', function() {
            var num = $('#DaysReserved').val();
            if (num) {
                $('#TotalReservationPrice').val(num * <?php echo $_GET['room_price']; ?>);
            } else {
                $('#TotalReservationPrice').val('');
            }
        })
    </script>

</body>

</html>