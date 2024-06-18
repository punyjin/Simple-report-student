<?php
require_once('TCPDF/tcpdf_import.php');
require_once('connect.php'); // Include connect.php to establish a database connection

setlocale(LC_TIME, 'th_TH.UTF-8');
$teacher_home_sql = "SELECT class_level, class_teacher, major, date_year FROM teacher_home";
$teacher_home_stmt = $pdo->query($teacher_home_sql);
$scan_time = "SELECT scan_time_in, scan_time_out FROM scan_logs";
if ($teacher_home_stmt === false) {
    die('Query failed: ' . $pdo->errorInfo()[2]); // Handle query error
}

$teacher_home_data = $teacher_home_stmt->fetch(PDO::FETCH_ASSOC);

if (!$teacher_home_data) {
    die('No data found in teacher_home table'); // Handle empty result
}

$class_level = isset($teacher_home_data['class_level']) ? $teacher_home_data['class_level'] : '';
$class_teacher = isset($teacher_home_data['class_teacher']) ? $teacher_home_data['class_teacher'] : '';
$major = isset($teacher_home_data['major']) ? $teacher_home_data['major'] : '';
$date_year = isset($teacher_home_data['date_year']) ? $teacher_home_data['date_year'] : '';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Export Data to PDF');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage();

$pdf->SetFont('freeserif', '', 6);

$date_header = 'วันที่ ' . strftime('%d') . ' เดือน ' . strftime('%B') . ' พ.ศ. ' . (strftime('%Y') + 543); // Thai Buddhist calendar year

$pdf->Cell(0, 10, $date_header, 0, 1, 'C');

$html = '<h1 style="text-align: center;">รายงานติดตามผู้เรียนประจำวัน</h1>
<p style="text-align: center; vertical-align:middle ">ระดับชั้น '.$class_level.' ที่ปรึกษา '.$class_teacher.' สาขา '.$major.' ภาคเรียนที่ '.$date_year.'</p>
    
<table border="1" cellpadding="4" cellspacing="0" style="margin: 0 auto; text-align: center;">
    <thead>
        <tr>
            <th rowspan="3" width="5%">ลำดับ</th>
            <th rowspan="3" width="5%">รหัส</th>
            <th rowspan="3" width="20%">ชื่อ-สกุล</th>
            <th rowspan="3" width="7%">เวลา Scan เข้า</th>
            <th colspan="6">คาบที่</th>
            <th rowspan="3" width="7%">เวลา Scan ออก</th>
            <th rowspan="3" width="8%">หมายเหตุ</th>
        </tr>
        <tr>
            <th width="5%">1</th>
            <th width="5%">2</th>
            <th width="5%">3</th>
            <th width="5%">4</th>
            <th width="5%">5</th>
            <th width="5%">6</th>
            <th width="5%">7</th>
            <th width="5%">8</th>
            <th width="5%">9</th>
            <th width="5%">10</th>
        </tr>
        <tr>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
            <th width="5%"></th>
        </tr>
    </thead>
    <tbody>';

$sql = "SELECT * FROM students_class";
$stmt = $pdo->query($sql);

if ($stmt->rowCount() > 0) {
    $index = 1; // Start index from 1
    while ($row = $stmt->fetch()) {
        $note = !empty($row['note']) ? $row['note'] : '&nbsp;'; // Default value for empty notes
        $html .= '<tr>
            <td width="5%">'.$index.'</td>
            <td width="5%">'.$row['student_code'].'</td>
            <td width="20%">'.$row['name'].'</td>
            <td width="7%">'.$row['scan_in_time'].'</td>
            <td width="5%">'.$row['col1'].'</td>
            <td width="5%">'.$row['col2'].'</td>
            <td width="5%">'.$row['col3'].'</td>
            <td width="5%">'.$row['col4'].'</td>
            <td width="5%">'.$row['col5'].'</td>
            <td width="5%">'.$row['col6'].'</td>
            <td width="5%">'.$row['col7'].'</td>
            <td width="5%">'.$row['col8'].'</td>
            <td width="5%">'.$row['col9'].'</td>
            <td width="5%">'.$row['col10'].'</td>
            <td width="7%">'.$row['scan_out_time'].'</td>
            <td width="8%">'.$note.'</td>
        </tr>';
        $index++; // Increment index
    }
} else {
    $html .= '<tr><td colspan="14" width="102%">ไม่มีข้อมูลให้แสดง ณ เวลานี้</td></tr>';
}

$html .= '</tbody></table>';

// Write HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF
$pdf->Output('students_001.pdf', 'I');
?>