<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แบบฟอร์มใบลา (การฝึกประสบการณ์วิชาชีพครู)</title>
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
        .top-right {
            text-align: right;
            font-weight: bold;
            margin-bottom: -40px;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
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
            justify-content: flex-end;
            margin-top: 30px;
        }
        .signature-box {
            width: 50%;
            text-align: center;
        }
        .bottom-section {
            margin-top: 30px;
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
        .circle {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 1px solid #000;
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 5px;
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
        <div class="top-right">สำหรับนักศึกษาฝึกประสบการณ์วิชาชีพครู</div>
        
        <div class="logo">
            <!-- ใส่ Logo มหาวิทยาลัยราชภัฏเชียงใหม่ -->
            <svg width="80" height="80" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="45" fill="none" stroke="black" stroke-width="2"/>
                <text x="50" y="55" font-size="20" text-anchor="middle" fill="black">LOGO</text>
            </svg>
        </div>
        
        <div class="title" style="line-height: 1.2;">
            แบบฟอร์มใบลา<br>
            <span style="font-size: 16pt; font-weight: normal;">(การฝึกประสบการณ์วิชาชีพครู)</span><br>
            <span style="font-size: 16pt; font-weight: normal;">คณะครุศาสตร์ มหาวิทยาลัยราชภัฏเชียงใหม่</span>
        </div>

        <div class="right-align" style="margin-top: 20px;">
            <p>วันที่ <span class="dotted-line" style="width: 50px;"></span> เดือน <span class="dotted-line" style="width: 100px;"></span> พ.ศ. <span class="dotted-line" style="width: 80px;"></span></p>
        </div>

        <div class="content">
            <p><strong>เรื่อง</strong> <span style="margin-left: 10px;"><span class="dotted-line" style="width: 400px;"></span></span></p>
            <p><strong>เรียน</strong> <span style="margin-left: 10px;">คณบดีคณะครุศาสตร์</span></p>
            
            <p style="text-indent: 50px;">ข้าพเจ้า (นาย/นาง/นางสาว) <span class="dotted-line" style="width: 450px;"></span></p>
            <p>รหัสประจำตัว <span class="dotted-line" style="width: 150px;"></span> นักศึกษาระดับ <span class="circle"></span> ปริญญาตรี <span class="circle"></span> ประกาศนียบัตร ชั้นปีที่ <span class="dotted-line" style="width: 80px;"></span></p>
            <p>หลักสูตร <span class="dotted-line" style="width: 250px;"></span> สาขาวิชา <span class="dotted-line" style="width: 270px;"></span></p>
            
            <p>มีความประสงค์ขออนุญาต <span class="circle"></span> ลาป่วย , <span class="circle"></span> ลากิจ เนื่องจาก <span class="dotted-line" style="width: 250px;"></span></p>
            <p><span class="dotted-line" style="width: 650px;"></span></p>
            
            <p>มีกำหนด <span class="dotted-line" style="width: 50px;"></span> วัน ทั้งนี้ตั้งแต่วันที่ <span class="dotted-line" style="width: 50px;"></span> เดือน <span class="dotted-line" style="width: 120px;"></span> พ.ศ. <span class="dotted-line" style="width: 50px;"></span> 
            ถึงวันที่ <span class="dotted-line" style="width: 50px;"></span> เดือน <span class="dotted-line" style="width: 120px;"></span> พ.ศ. <span class="dotted-line" style="width: 50px;"></span></p>
            
            <p>ซึ่งในวันดังกล่าวมี <span class="circle" style="border:none;">(&nbsp;&nbsp;&nbsp;)</span> การฝึกปฏิบัติการวิชาชีพระหว่างเรียน (EDP 2801/EDP3801)</p>
            <p><span style="margin-left: 115px;"><span class="circle" style="border:none;">(&nbsp;&nbsp;&nbsp;)</span> การฝึกประสบการณ์วิชาชีพครู</span> <span style="margin-left: 20px;"><span class="circle" style="border:none;">(&nbsp;&nbsp;&nbsp;)</span> การฝึกปฏิบัติการวิชาชีพระหว่างเรียน CMRU Model</span></p>
            
            <p>ณ โรงเรียน <span class="dotted-line" style="width: 300px;"></span> ตำบล <span class="dotted-line" style="width: 250px;"></span></p>
            <p>อำเภอ <span class="dotted-line" style="width: 200px;"></span> จังหวัด <span class="dotted-line" style="width: 150px;"></span> และในระหว่างการลาจะติดต่อข้าพเจ้าได้ที่</p>
            <p><span class="dotted-line" style="width: 350px;"></span> โทรศัพท์ <span class="dotted-line" style="width: 220px;"></span></p>
            
            <p style="text-indent: 50px; margin-top: 15px;">ข้าพเจ้าของรับรองว่า ข้อความดังกล่าวข้างต้นเป็นความจริงทุกประการ และได้แนบหลักฐานเพื่อ</p>
            <p>ประกอบการพิจารณา ดังนี้ <span class="dotted-line" style="width: 480px;"></span></p>
            
            <p style="text-align: center; margin-top: 20px;">จึงเรียนมาเพื่อโปรดพิจารณาอนุญาต</p>
        </div>

        <div class="signature-section">
            <div class="signature-box">
                <p>ด้วยความเคารพอย่างสูง</p>
                <br><br>
                <p>(ลงชื่อ) <span class="dotted-line" style="width: 200px;"></span> นักศึกษาผู้ยื่นคำร้อง</p>
                <p>เบอร์โทร <span class="dotted-line" style="width: 220px;"></span></p>
            </div>
        </div>

        <div class="bottom-section">
            <p><strong>1. ความเห็นของอาจารย์ที่ปรึกษา</strong></p>
            <p><span class="dotted-line" style="width: 100%;"></span></p>
            <p><span class="dotted-line" style="width: 100%;"></span></p>
            
            <div style="text-align: right; margin-top: 20px;">
                <p>(ลงชื่อ) <span class="dotted-line" style="width: 200px;"></span></p>
                <p>(<span class="dotted-line" style="width: 220px;"></span>)</p>
            </div>
        </div>
    </div>
</body>
</html>
