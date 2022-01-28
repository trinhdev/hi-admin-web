<table class="product-detail">
    <tr>
        <td style="text-align: center; width: 100%; padding-bottom: 30px" colspan="2">
            <img class="img-thumbnail" src="{{ (!empty($data['iconUrl'])) ? $data['iconUrl'] : '/images/image_logo.png' }}" style="width: 150px" />
        </td>
    </tr>
    <tr>
        <td class="title">Tên vị trí</td>
        <td>{{ @$data['titleVi'] }}</td>
    </tr>
    <tr>
        <td class="title" style="width: 25%;">Tên vị trí code</td>
        <td>{{ @$data['name'] }}</td>
    </tr>
    <tr>
        <td class="title" style="width: 25%;">Mô tả</td>
        <td>{{ @$data['description'] }}</td>
    </tr>
    <tr>
        <td class="title" style="width: 25%;">Số icon trên 1 dòng</td>
        <td>{{ @$data['iconsPerRow'] }}</td>
    </tr>
    <tr>
        <td class="title" style="width: 25%;">Số dòng tối đa</td>
        <td>{{ @$data['rowOnPage'] }}</td>
    </tr>
    <tr>
        <td class="title">Trạng thái hiển thị</td>
        <td>{{ @$data['status'] }}</td>
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