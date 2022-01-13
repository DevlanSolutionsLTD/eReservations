<?php
require_once('../config/config.php');

$callbackJSONData=file_get_contents('php://input');

$logFile = "stkPush.json";
$log = fopen($logFile, "a");
fwrite($log, $callbackJSONData);
fclose($log);
  
$callbackData=json_decode($callbackJSONData);

$resultCode=$callbackData->Body->stkCallback->ResultCode;
$resultDesc=$callbackData->Body->stkCallback->ResultDesc;
$merchantRequestID=$callbackData->Body->stkCallback->MerchantRequestID;
$checkoutRequestID=$callbackData->Body->stkCallback->CheckoutRequestID;
$mpesa=$callbackData->stkCallback->Body->CallbackMetadata->Item[0]->Name;
$amount=$callbackData->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$mpesaReceiptNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$balance=$callbackData->stkCallback->Body->CallbackMetadata->Item[2]->Value;
$b2CUtilityAccountAvailableFunds=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$transactionDate=$callbackData->Body->stkCallback->CallbackMetadata->Item[3]->Value;
$phoneNumber=$callbackData->Body->stkCallback->CallbackMetadata->Item[4]->Value;

$amount = strval($amount);
if($resultCode == 0){
$insert = $mysqli->query("INSERT INTO `stkpush`(`merchantRequestID`, `checkoutRequestID`,`resultCode`, `resultDesc`, `amount`, `mpesaReceiptNumber`, `transactionDate`, `phoneNumber`)
VALUES ('$merchantRequestID', '$checkoutRequestID','$resultCode', '$resultDesc', '$amount','$mpesaReceiptNumber','$transactionDate','$phoneNumber')");

//update Reservation 
$query1 = "UPDATE reservations set duration=?,transaction_id=? WHERE client_phone=? AND cost=?";
    $stmt1 = $mysqli->prepare($query1);
    $rc1 = $stmt1->bind_param(
        'ssss',
        
        $transactionDate,
        $mpesaReceiptNumber,
        $phoneNumber,
        $amount

    );

//Get Room id
$ret = "SELECT * FROM reservations WHERE client_phone='$phoneNumber' AND cost='$amount'";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($r = $res->fetch_object()) {

//UPDATE ROOM STATUS
$room_id =$r->reservation_room_id;
$room_status ="reserved";
$query2 = "UPDATE rooms set room_status=? WHERE room_id=?";
    $stmt2 = $mysqli->prepare($query2);
    $rc2 = $stmt2->bind_param(
        'ss',
        
        $room_status,
        $room_id
        

    );
    $stmt1->execute();
    $stmt2->execute();


};
}
		

