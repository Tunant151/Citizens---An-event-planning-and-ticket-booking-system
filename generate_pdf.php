<?php
session_start();
include("admin/common/conn.php");

// Include TCPDF library
require_once('assets/TCPDF/tcpdf.php');
require_once('assets/phpqrcode/qrlib.php');

// Check if an event ID is passed through the URL
if (isset($_GET['id'])) {
    $ticket_code = $_GET['id'];
    // Fetch event details based on the ID from the URL
    $query = "SELECT * FROM tickets WHERE ticket_code = '$ticket_code'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $tickets = mysqli_fetch_assoc($result);

        // Instantiate TCPDF object
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Citizens Ticket');
        $pdf->SetTitle($tickets['event']);
        $pdf->SetSubject($tickets['date']);
        $pdf->SetKeywords('TCPDF, PDF, ticket, details');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Define the header
        $header = '<table width="100%">
                <tr>
                    <td width="30%"><img src="assets/img/logo.png" style="width: 100px;" /></td>
                    <td width="70%" style="text-align: right;">Citizens Issued Ticket<br/>Event Name: ' . $tickets['event'] . '<br/>Event Date: ' . $tickets['date'] . '</td>
                </tr>
              </table>';

        // Set header content
        $pdf->writeHTML($header, true, false, true, false, '');

        // Output HTML content to PDF
        $html = '<table cellpadding="4" cellspacing="0" border="1">
                <thead>
                    <tr style="background-color:#cb1212; color:white;">
                        <th colspan="2" style="text-align: center;">Ticket Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Event Name</td>
                        <td>' . $tickets['event'] . '</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>' . $tickets['date'] . '</td>
                    </tr>
                    <tr>
                        <td>Ticket Number</td>
                        <td>' . $tickets['ticket_number'] . '</td>
                    </tr>
                    <tr>
                        <td>Ticket Code</td>
                        <td>' . $tickets['ticket_code'] . '</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td>' . $tickets['payment_method'] . '</td>
                    </tr>
                    <tr>
                        <td>Reference Code</td>
                        <td>' . $tickets['reference_code'] . '</td>
                    </tr>
                </tbody>
            </table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        // Generate QR code
        $qrCodeContent = $tickets['ticket_code'];
        $qrCodeFile = 'assets/qrcodes/' . $qrCodeContent . '.png';
        QRcode::png($qrCodeContent, $qrCodeFile);

        // Add QR code
        $qrCodeHtml = '<div style="text-align: center;"><img src="' . $qrCodeFile . '" style="width: 200px;"></div>';
        $pdf->writeHTML($qrCodeHtml, true, false, true, false, '');

        // Close and output PDF
        $pdf->Output('ticket_details.pdf', 'I');

        // Stop execution
        exit;
    } else {
        echo "No ticket found with the provided code.";
    }
}
