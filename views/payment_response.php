<?php
/*
 * Created on Tue Jan 18 2022
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
include('../config/config.php');

if (isset($_GET['status'])) {
    //* check payment status
    if ($_GET['status'] == 'cancelled') {
        header('Location: rooms');
    } elseif ($_GET['status'] == 'successful') {
        $txid = $_GET['transaction_id'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer FLWSECK_TEST-a90855faf858298f0b14bfb4621e53fe-X"/* Do Not Hard Code This Bearer */
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response);
        if ($res->status) {
            $amountPaid = $res->data->charged_amount;
            $amountToPay = $res->data->meta->price;
            if ($amountPaid >= $amountToPay) {

                /* Insert This Payment Details To Payment*/
                $payment_txn_code = $res->data->tx_ref;
                $payment_amount = $amountPaid;
                $payment_date_posted = $res->data->created_at;
                $payment_reservation_id = $_GET['Reservation'];
                $payment_room_id = $_GET['Room'];

                /* Update Room To Booked */
                $room_status = "reserved";

                /* Insert */
                $sql = "INSERT INTO reservation_payments (payment_reservation_id, payment_room_id, payment_amount, payment_txn_code, payment_date_posted)
                VALUES(?,?,?,?,?)";
                $room_sql = "UPDATE rooms SET room_status =? WHERE room_id = ?";
                $reservation_sql = "UPDATE reservations SET transaction_id = ? WHERE reservation_id =?";

                $prepare = $mysqli->prepare($sql);
                $room_prepare = $mysqli->prepare($room_sql);
                $reservation_prepare = $mysqli->prepare($reservation_sql);

                $bind = $prepare->bind_param(
                    'sssss',
                    $payment_reservation_id,
                    $payment_room_id,
                    $payment_amount,
                    $payment_txn_code,
                    $payment_date_posted
                );
                $room_bind = $room_prepare->bind_param(
                    'ss',
                    $room_status,
                    $payment_room_id
                );
                $reservation_bind = $reservation_prepare->bind_param(
                    'ss',
                    $payment_txn_code,
                    $payment_reservation_id
                );

                $prepare->execute();
                $room_prepare->execute();
                $reservation_prepare->execute();

                if ($prepare && $room_prepare) {
                    /* Redirect To Rooms And Show Alert */
                    $_SESSION['success'] = 'Room Reserved';
                    header('Location: rooms');
                } else {
                    $_SESSION['err'] = 'Failed To Persist Transaction Details';
                    header('Location: rooms');
                }
            } else {
                $_SESSION['err'] = 'We Are Having Problem Processing Your Payment';
                header('Location: rooms');
            }
        } else {
            $_SESSION['err'] = 'Can Not Process Payment, Please Use MPESA Payment Method';
            header('Location: rooms');
        }
    }
}
