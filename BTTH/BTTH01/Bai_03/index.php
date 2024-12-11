<!DOCTYPE html>
<html>
<head>
    <title>Danh sách tài khoản</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Danh sách tài khoản</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>City</th>
                <th>Email</th>
                <th>Course</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filename = 'KTPM3_Danh_sach_diem_danh.csv';

            if (($handle = fopen($filename, 'r')) !== false) {
                $headers = fgetcsv($handle);

                while (($row = fgetcsv($handle)) !== false) {
                    echo "<tr>";
                    foreach ($row as $cell) {
                        echo "<td>" . htmlspecialchars($cell) . "</td>";
                    }
                    echo "</tr>";
                }
                fclose($handle);
            } else {
                echo "<tr><td colspan='7'>Không thể mở tệp CSV.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
