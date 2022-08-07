<table class="product-detail">
    <tr>
        <td style="text-align: center; width: 100%; padding-bottom: 30px" colspan="2">
            <img class="img-thumbnail" src="{{ (!empty($data['iconUrl'])) ? $data['iconUrl'] : '/images/image_logo.png' }}" style="width: 150px" lat="{{ @$data['productNameVi'] }}" />
        </td>
    </tr>
    <tr>
        <td class="title">Tên</td>
        <td>{{ @$data['productNameVi'] }}</td>
    </tr>
    <tr>
        <td class="title" style="width: 25%;">Mô tả</td>
        <td>{{ @$data['decriptionVi'] }}</td>
    </tr>
    <tr>
        <td class="title" style="padding-bottom: 30px">Thông tin bổ sung</td>
        <td style="padding-bottom: 30px">{{ @$data['content'] }}</td>
    </tr>

    <tr>
        <td class="title">Trạng thái hiển thị</td>
        @if (isset($data['isDisplay']))
            @switch($data['isDisplay'])
                @case("0")
                    <td>Ẩn</td>
                    @break

                @case("1")
                    <td>Hiện</td>
                    @break
                @case("2")
                    <td>Hẹn giờ hiện</td>
                    @break
                @default
            @endswitch
        @endif
    </tr>
    <tr>
        <td class="title">Ngày bắt đầu</td>
        <td>{{ (!empty($data['isDisplay']) && $data['isDisplay'] == "2") ? $data['displayBeginDay'] : '' }}</td>
    </tr>
    <tr>
        <td class="title" style="padding-bottom: 30px">Ngày kết thúc</td>
        <td style="padding-bottom: 30px">{{ (!empty($data['displayEndDay']) && $data['isDisplay'] == "2") ? $data['displayEndDay'] : '' }}</td>
    </tr>
    
    <tr>
        <td class="title">Hiển thị icon mới</td>
        @if (isset($data['isNew']))
            @switch($data['isNew'])
                @case("0")
                    <td>Ẩn</td>
                    @break

                @case("1")
                    <td>Hiện</td>
                    @break
                @case("2")
                    <td>Hẹn giờ hiện</td>
                    @break
                @default
            @endswitch
        @endif
    </tr>
    <tr>
        <td class="title">Ngày bắt đầu</td>
        <td>{{ (!empty($data['newBeginDay']) && $data['newBeginDay'] == "2") ? $data['newBeginDay'] : '' }}</td>
    </tr>
    <tr>
        <td class="title" style="padding-bottom: 30px">Ngày kết thúc</td>
        <td style="padding-bottom: 30px">{{ (!empty($data['newEndDay']) && $data['newEndDay'] == "2") ? $data['newEndDay'] : '' }}</td>
    </tr>
    
    <tr>
        <td class="title">Loại điều hướng</td>
        <td>{{ @$data['actionType'] }}</td>
    </tr>
    <tr>
        <td class="title">Link Production</td>
        <td>{{ @$data['dataActionProduction'] }}</td>
    </tr>
    <tr>
        <td class="title">Link Staging</td>
        <td>{{ @$data['dataActionStaging'] }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
</table>