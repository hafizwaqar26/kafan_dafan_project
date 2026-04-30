<!DOCTYPE html>
<html lang="ur">
<head>
    <meta charset="UTF-8">
    <title>غسال ریکارڈز</title>
    <style>
        body {
            font-family: 'notosansarabic';
            font-size: 11px;
            direction: rtl;
            text-align: right;
            margin: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 0.5pt solid #ccc;
            padding: 6px 4px;
            text-align: right;
            font-size: 9px;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .header-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #1a202c;
        }

        .header-subtitle {
            text-align: center;
            font-size: 10px;
            color: #718096;
            margin-bottom: 15px;
        }

        .col-index {
            text-align: center;
            width: 20px;
            background-color: #f7fafc;
        }
    </style>
</head>
<body>
<div class="header-title">غسال ریکارڈز (Ghassal Records)</div>
<div class="header-subtitle">Generated on: {{ now()->format('d M, Y h:i A') }}</div>

<table>
    <thead>
    <tr>
        <th class="col-index">#</th>
        <th>ملک</th>
        <th>صوبہ</th>
        <th>ڈویژن</th>
        <th>ڈسٹرکٹ</th>
        <th>تحصیل</th>
        <th>سب تحصیل</th>
        <th>یوسی</th>
        <th>مقام</th>
        <th>نام غسال</th>
        <th>رابطہ نمبر</th>
        <th>غسل کا وقت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($records as $index => $record)
        <tr>
            <td class="col-index">{{ $index + 1 }}</td>
            <td>{{ $record->country }}</td>
            <td>{{ $record->province }}</td>
            <td>{{ $record->division }}</td>
            <td>{{ $record->district }}</td>
            <td>{{ $record->tehsil }}</td>
            <td>{{ $record->sub_tehsil }}</td>
            <td>{{ $record->uc }}</td>
            <td>{{ $record->address }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->contact }}</td>
            <td>{{ $record->time_of_ghusal }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>