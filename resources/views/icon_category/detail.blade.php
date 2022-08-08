<table class="product-detail">
    <tr>
        <td style="text-align: center; width: 100%; padding-bottom: 30px" colspan="2">
            <img class="img-thumbnail" src="{{ (!empty($data['iconUrl'])) ? $data['iconUrl'] : '/images/image_logo.png' }}" style="width: 150px" />
        </td>
    </tr>
    <tr>
        <td class="title">Tên</td>
        <td>{{ @$data['productTitleNameVi'] }}</td>
    </tr>
    <tr>
        <td class="title" style="width: 25%;">Mô tả</td>
        <td>{{ @$data['description'] }}</td>
    </tr>
    <tr>
        <td class="title">Trạng thái hiển thị</td>
        @if(isset($data['isDeleted']))
            <td>{{ ($data['isDeleted'] == 1) ? 'Ẩn' : 'Hiện' }}</td>
        @else
            <td>Ẩn</td>
        @endif
        
    </tr>
    <tr>
        <td class="title">Ngày bắt đầu</td>
        <td>31/12/2021</td>
    </tr>
    <tr>
        <td class="title">Ngày kết thúc</td>
        <td>15/01/2022</td>
    </tr>
    <tr>
        <td class="title">Danh sách sản phẩm</td>
        <td class="row">
            <ul id="list-prod-in-title">
                @if (!empty($data['productListInTitle']))
                    @foreach ($data['productListInTitle'] as $item)
                        <li><img src="{{ $item['iconUrl'] }}" style="width: 70px" /></li>
                    @endforeach
                @endif
            </ul>
        </td>
    </tr>
</table>

<style>
    #list-prod-in-title {
        list-style: none;
    }

    #list-prod-in-title li {
        display: inline;
    }
</style>