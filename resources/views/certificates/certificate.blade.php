<!DOCTYPE html>
<html>
<head>
    <title>Certificate</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .certificate {
            width: 800px;
            height: 600px;
            padding: 20px;
            text-align: center;
            border: 5px solid #000;
            margin: auto;
            position: relative;
        }
        .certificate h1 {
            margin-top: 50px;
            font-size: 48px;
        }
        .certificate p {
            font-size: 24px;
            margin-top: 20px;
        }
        .signature {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            display: flex;
            justify-content: space-around;
        }
        .signature div {
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Certificate of Completion</h1>
        <p>This is to certify that</p>
        <p style="font-size: 36px; font-weight: bold; margin-top: 10px;">{{ $student->name }}</p>
        <p>has successfully completed the course on</p>
        <p style="font-size: 30px; font-weight: bold; margin-top: 10px;">Laravel Development</p>
        <p style="margin-top: 50px;">Date: {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
        <div class="signature">
            <div>
                Instructor
            </div>
            <div>
                Director
            </div>
        </div>
    </div>
</body>
</html>