<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Report by day FPlay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body style="margin: 0; padding: 0;">
    <table align="left" border="0" cellpadding="0" cellspacing="0" width="800" style="border-collapse: collapse;">
        <tr>
            <td width="20%" style="font-weight: bold">
                Email:
            </td>
            <td>
                {{ $data['email'] }}
            </td>
            <td width="10%" style="font-weight: bold">
                Tên user:
            </td>
            <td width="20%">
                {{ $data['name'] }}
            </td>
        </tr>
        <tr>
            <td width="20%" style="font-weight: bold">
                (Phân quyền):
            </td>
            <td width="20%">
                {{ $data['role'] }}
            </td>
        </tr>
        <tr>
            <td width="20%" style="font-weight: bold">
                Ngày:
            </td>
            <td width="20%">
                {{ $data['date'] }}
            </td>
            <td width="10%" style="font-weight: bold">
                Vào lúc (giờ):
            </td>
            <td>
                {{ $data['time'] }}
            </td>
        </tr>
        <tr>
            <td>
                Đã <span style="font-weight: bold">{{ $data['approved_status'] }}</span> đối tượng <span style="font-weight: bold">{{ $data['product_type'] }}</span> tại 
            </td>
        </tr>
        <tr>
            <td width="20%" style="font-weight: bold">Link chi tiết thay đổi</td>
            <td>{{ $data['url'] }}</td>
        </tr>
    </table>
</body>
</html>