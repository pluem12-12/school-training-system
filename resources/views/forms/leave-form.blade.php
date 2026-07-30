<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แบบฟอร์มใบลาสำหรับนักศึกษา</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap');
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 16pt;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            background-color: #f3f4f6;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            position: relative;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 80px;
            height: auto;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18pt;
            margin-bottom: 20px;
        }
        .right-align {
            text-align: right;
            margin-bottom: 10px;
        }
        .dotted-line {
            border-bottom: 1px dotted #000;
            display: inline-block;
            min-width: 50px;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            margin-bottom: 10px;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .signature-box {
            width: 45%;
            text-align: center;
        }
        .signature-box.right {
            margin-left: auto;
            width: 50%;
        }
        .notes {
            margin-top: 50px;
            font-size: 14pt;
        }
        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            background-color: #3b82f6;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16pt;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        @media print {
            body { background: none; margin: 0; padding: 0; }
            .page { margin: 0; border: none; border-radius: 0; box-shadow: none; width: 100%; min-height: auto; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()" class="btn">พิมพ์ / บันทึกเป็น PDF</button>
        <a href="javascript:history.back()" class="btn" style="background-color: #6b7280; margin-left: 10px;">กลับ</a>
    </div>

    <div class="page">
        <div class="logo">
            <!-- ใส่ Logo มหาวิทยาลัยราชภัฏเชียงใหม่ หรือปล่อยว่างไว้ถ้าไม่มีรูป -->
            <svg width="80" height="80" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="45" fill="none" stroke="black" stroke-width="2"/>
                <text x="50" y="55" font-size="20" text-anchor="middle" fill="black">LOGO</text>
            </svg>
        </div>
        <div class="title">แบบฟอร์มใบลาสำหรับนักศึกษา</div>

        <div class="right-align">
            <p>ที่อยู่<span class="dotted-line" style="width: 250px;"></span></p>
            <p><span class="dotted-line" style="width: 280px;"></span></p>
            <p><span class="dotted-line" style="width: 280px;"></span></p>
        </div>

        <div class="right-align" style="margin-top: 20px;">
            <p>วันที่ <span class="dotted-line" style="width: 50px;"></span> เดือน <span class="dotted-line" style="width: 100px;"></span> พ.ศ. <span class="dotted-line" style="width: 80px;"></span></p>
        </div>

        <div class="content">
            <p><strong>เรื่อง</strong> <span style="margin-left: 10px;">ขอลา<span class="dotted-line" style="width: 300px;"></span></span></p>
            <p><strong>เรียน</strong> <span style="margin-left: 10px;">อาจารย์ประจำวิชา<span class="dotted-line" style="width: 250px;"></span></span></p>
            
            <p style="text-indent: 50px;">ด้วยข้าพเจ้า (นาย/นาง/นางสาว) <span class="dotted-line" style="width: 450px;"></span></p>
            <p>นักศึกษาระดับชั้น <span class="dotted-line" style="width: 250px;"></span> สาขาวิชา <span class="dotted-line" style="width: 300px;"></span></p>
            <p>นักศึกษาตามโครงการแลกเปลี่ยนจาก มหาวิทยาลัย <span class="dotted-line" style="width: 350px;"></span></p>
            <p>ที่อยู่ <span class="dotted-line" style="width: 350px;"></span> โทรศัพท์ <span class="dotted-line" style="width: 200px;"></span></p>
            
            <div style="margin-left: 50px; margin-top: 15px;">
                <p>มีความประสงค์จะขอลา <span style="margin-left: 20px;">( &nbsp;&nbsp;&nbsp; ) ป่วย เนื่องจาก <span class="dotted-line" style="width: 300px;"></span></span></p>
                <p><span style="margin-left: 153px;">( &nbsp;&nbsp;&nbsp; ) กิจ เนื่องจาก <span class="dotted-line" style="width: 300px;"></span></span></p>
                <p><span style="margin-left: 153px;">( &nbsp;&nbsp;&nbsp; ) อื่นๆ (โปรดระบุ) <span class="dotted-line" style="width: 280px;"></span></span></p>
            </div>
            
            <p style="margin-top: 15px;">ตั้งแต่วันที่ <span class="dotted-line" style="width: 180px;"></span> ถึงวันที่ <span class="dotted-line" style="width: 180px;"></span> มีกำหนด <span class="dotted-line" style="width: 80px;"></span> วัน</p>
            <p>เมื่อครบกำหนดแล้วข้าพเจ้าจะกลับมาเรียนตามปกติ</p>
            
            <p style="text-align: center; margin-top: 30px;">จึงเรียนมาเพื่อโปรดพิจารณาอนุญาต</p>
        </div>

        <div class="signature-section" style="justify-content: flex-end; margin-top: 30px;">
            <div class="signature-box right">
                <p>ด้วยความเคารพอย่างสูง</p>
                <br><br>
                <p>ลงชื่อ <span class="dotted-line" style="width: 200px;"></span> นักศึกษา</p>
                <p>(<span class="dotted-line" style="width: 200px;"></span>)</p>
            </div>
        </div>

        <div class="signature-section" style="margin-top: 50px;">
            <div class="signature-box" style="text-align: left;">
                <p style="text-align: center; font-weight: bold;">ผู้ปกครองรับรอง</p>
                <p>ข้าพเจ้า <span class="dotted-line" style="width: 220px;"></span></p>
                <p>ผู้ปกครองของ <span class="dotted-line" style="width: 195px;"></span></p>
                <p>โทรศัพท์<span class="dotted-line" style="width: 225px;"></span></p>
                <p><strong>ขอรับรองว่าเป็นความจริง</strong></p>
                <br>
                <p style="text-align: center;">ลงชื่อ <span class="dotted-line" style="width: 150px;"></span></p>
                <p style="text-align: center;">(<span class="dotted-line" style="width: 150px;"></span>)</p>
                <p style="text-align: center;">........./........./.........</p>
            </div>
            
            <div class="signature-box" style="text-align: left; padding-left: 50px;">
                <p style="text-align: center; font-weight: bold;">ความเห็นอาจารย์ที่ปรึกษา</p>
                <p><span class="dotted-line" style="width: 250px;"></span></p>
                <p><span class="dotted-line" style="width: 250px;"></span></p>
                <p><span class="dotted-line" style="width: 250px;"></span></p>
                <br><br>
                <p style="text-align: center;">ลงชื่อ <span class="dotted-line" style="width: 150px;"></span></p>
                <p style="text-align: center;">(<span class="dotted-line" style="width: 150px;"></span>)</p>
                <p style="text-align: center;">........./........./.........</p>
            </div>
        </div>

        <div class="notes">
            <p><strong>**หมายเหตุ</strong></p>
            <p style="margin-left: 20px; margin-top: -10px;">- หากลาป่วยควรมีเอกสารใบรับรองแพทย์ หรือการรับรองจากผู้ดูแล</p>
            <p style="margin-left: 20px; margin-top: -10px;">- หากลากิจในเรื่องราชการ งานประจำ ควรแนบเอกสารคำสั่ง หรือหนังสือขออนุญาตจากหน่วยงาน</p>
        </div>
    </div>
</body>
</html>
