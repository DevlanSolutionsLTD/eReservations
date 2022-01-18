<?php
/*
 * Created on Wed Aug 25 2021
 *
 * 
 * The MIT License (MIT)
 * Copyright (c) 2021 Devlan Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


/* Rooms */
$query = "SELECT COUNT(*)  FROM `rooms`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($rooms);
$stmt->fetch();
$stmt->close();

/* Vacant  Rooms */
$query = "SELECT COUNT(*)  FROM `rooms` WHERE room_status = 'vacant'";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($vacant_rooms);
$stmt->fetch();
$stmt->close();


/* Reservations */
$query = "SELECT COUNT(*)  FROM `reservations`";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($reservation);
$stmt->fetch();
$stmt->close();

/* Income */
$query = "SELECT SUM(cost)  FROM `reservations` WHERE transaction_id !='' ";
$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->bind_result($incomes);
$stmt->fetch();
$stmt->close();
