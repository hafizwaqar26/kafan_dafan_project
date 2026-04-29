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
        }

        th, td {
            border: 1px solid #888;
            padding: 4px 6px;
            text-align: right;
            vertical-align: middle;
        }

        th {
            background: #f3f4f6;
            font-weight: bold;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        .col-index {
            text-align: center;
            width: 25px;
        }
    </style>
</head>
<body>
<h3>غسال ریکارڈز</h3>

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