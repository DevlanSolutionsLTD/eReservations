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
require_once('../vendor/autoload.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

/* Date Range */
//$from = date('d M Y', strtotime($_GET['start']));
//$to = date('d M Y', strtotime($_GET['end']));

/* Get Date Range */
$start_date = $_GET['start'];
$end_date = $_GET['end'];

/* Date Time */
$from = date('d M Y', strtotime($start_date));
$to  = date('d M Y', strtotime($end_date));

/* Convert Logo To Base64 Image */
$path = '../public/images/login_bg.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$sys_logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

$html = '
    <!DOCTYPE html>
    <html>

        <head>
            <meta name="" content="XYZ,0,0,1" />
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
        </head>

        <body style="margin:1px;">
            <div class="footer">
                <hr>
                <i> <b> Sales Record  From ' . $from . ' To ' . $to . ' | Generated On ' . date('d M Y') . '</b></i>
            </div>

            <h3 class="list_header" align="center">
                <img height="100" width="100" src="' . $sys_logo . '" align="center">
                <br>
                <h3>
                    CHRISTIAN EDUCATION DEPARTMENT BOOKSHOP <br>
                    P.O BOX 1470 - 90100 MACHAKOS                    
                </h3>
                <hr style="width:100%" , color=black>
                <hr class="red">
                <h4>Store 1 Sales Reports From ' . $from . ' To ' . $to . ' </h4>
            </h3>

            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Sold By</th>
                    <th>Customer</th>
                    <th>Date Purchased</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            ';
            $ret = "SELECT * FROM sales s
            INNER JOIN products p ON p.product_id = s.sale_product_id
            INNER JOIN product_categories pc ON pc.category_id = p.product_category_id
            INNER JOIN users u ON u.user_id = s.sale_user_id
            WHERE p.product_access_level = 'store_1' AND ( s.sale_date BETWEEN '$start_date' AND '$end_date') ";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $cnt = 1;
            $res = $stmt->get_result();
            $total_revenue = 0;
            while ($sales = $res->fetch_object()) {
                /* Compute Price */
                $total_price = $sales->sale_quantity * $sales->product_retail_price;
                
                $html .=
                '
                    <tr>
                        <td width="2%">' . $cnt . '</td>
                        <td width="100%">
                            ' . $sales->product_name . '
                        </td>
                        <td width="100%">
                            ' . $sales->user_name . '
                        </td>
                        <td width="100%">
                            Name: ' . $sales->sale_customer_name . '<br>
                            Contats: ' . $sales->sale_customer_phoneno . '<br>
                            Address: ' . $sales->sale_customer_address . '<br>
                        </td>
                        <td width="95%">
                        ' . date('d M Y', strtotime($sales->sale_date)) . '
                        </td>
                        <td width="60%">
                          ' . $sales->sale_quantity . ' Copies
                        </td>
                        <td width="85%">
                            Ksh ' . $total_price . '
                        </td>
                    </tr>
                    ';
                        $cnt = $cnt + 1;
                        $total_revenue += $total_price;
                    }
                    
                $html .= '
                <tr>
                    <td colspan="6"><b>Total Sales Revenue From '.$from.' To '.$to.'</b></td>
                    <td><b> Ksh ' . $total_revenue . '</b></td>
                </tr>
            </table>
        </body>
    </html>';

$dompdf = new Dompdf();
$dompdf->load_html($html);
$dompdf->set_paper('A4', 'potrait');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->render();
$dompdf->stream($from . ' To ' . $to . ' Sales Records', array("Attachment" => 1));
$options = $dompdf->getOptions();
$options->setDefaultFont('');
$dompdf->setOptions($options);
