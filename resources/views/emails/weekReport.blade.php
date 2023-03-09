<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Week Report VSML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body style="margin: 0; padding: 0;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="1200" style="border-collapse: collapse;text-align: center">
        <tr>
            <td align="center" style="padding: 40px 0 0 0; font-size: 20px">
                <p><b>BÁO CÁO BÁN HÀNG CÙNG HIFPT - DỊCH VỤ VỆ SINH MÁY LẠNH</b></p>
                <p><span style="font-size: 16px">Từ ngày {{ $date[0] }} đến ngày {{ $date[1] }}</span></p>
            </td>
        </tr>
        <tr>
            <td  bgcolor="#ffffff" style="padding: 40px 0 40px 0;">
                <table align="center" border="1" cellpadding="0" cellspacing="0" width="80%" style="border-collapse: collapse;text-align: center">
                    <tr>
                        <td colspan="6" align="center" style="padding: 5px; font-weight: bold;">SỐ LIỆU THỐNG KÊ</td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 5px; background-color: #378998; font-weight: bold; width: 10%">STT</td>
                        <td align="center" style="padding: 5px; background-color: #378998; font-weight: bold; width: 25%">Mã chi nhánh</td>
                        <td align="center" style="padding: 5px; background-color: #378998; font-weight: bold; width: 25%">Nhân viên tham gia bán hàng</td>
                        <td align="center" style="padding: 5px; background-color: #378998; font-weight: bold; width: 25%">Số đơn thành công</td>
                        <td align="center" style="padding: 5px; background-color: #378998; font-weight: bold; width: 25%">Doanh thu</td>
                        <td align="center" style="padding: 5px; background-color: #378998; font-weight: bold; width: 15%">Tỷ lệ</td>
                    </tr>
                    @forelse ($data['data'] as $key => $value)

                        <tr>
                            <td align="center" style="padding: 5px">{{ $key }}</td>
                            <td align="center" style="padding: 5px">{{ $value['key'] }}</td>
                            <td align="center" style="padding: 5px">{{ $value['SoNhanVienThamGia'] }}</td>
                            <td align="center" style="padding: 5px">{{ $value['SoDonSuccess'] }}</td>
                            <td align="center" style="padding: 5px">{{ number_format($value['DoanhThu']) }}</td>
                            <td align="center" style="padding: 5px">{{number_format( $value['SoDonSuccess'] / $data['total']['order']*100,0 ) }}%</td>
                        </tr>
                    @empty
                        Error Data
                    @endforelse
                    <tr>
                        <td colspan="2" align="center" style="padding: 5px; font-weight: bold;">TỔNG</td>
                        <td align="center" style="padding: 5px; font-weight: bold;">{{ $data['total']['employees'] }}</td>
                        <td align="center" style="padding: 5px; font-weight: bold;">{{ $data['total']['order'] }}</td>
                        <td align="center" style="padding: 5px; font-weight: bold;">{{ number_format($data['total']['turnover']) }}</td>
                        <td align="center" style="padding: 5px; font-weight: bold;">100%</td>
                    </tr>
                </table>
                <h3>Link thống kê chi tiết: {{ $data['detailUrl'] ?? 'Error link url!' }}</h3>
            </td>
        </tr>
    </table>
</body>
</html>
