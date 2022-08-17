@if (!empty($data))
    @foreach ($data as $service)
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ Str::upper($service[0]['service']) }}<h3>
            </div>
            {{-- <h4 class="card-title">HDI</h4> --}}
            <div class="card-body row">
                {{-- {{ $ict->table([], true) }} --}}
                <div class="col-sm-8">
                    <table style="width: 100%">
                        <tr>
                            <th rowspan="2">Vùng</th>
                            <th rowspan="2">+/-</th>
                            <th colspan="3">{{ $last_time }}</th>
                            <th colspan="3">{{ $this_time }}</th>
                        </tr>
                        <tr>
                            <th>Doanh thu</th>
                            <th>Đơn hàng</th>
                            <th>%</th>
                            <th>Doanh thu</th>
                            <th>Đơn hàng</th>
                            <th>%</th>
                        </tr>
                        @php
                            $list_find_max = array_filter($service, function($k) {
                                return $k['zone'] != 'Total' && (str_starts_with($k['zone'], 'Vung') && $k['branch_name'] == null);
                            });
                            $max = collect($list_find_max)->max('amount_this_time');
                        @endphp
                        
                        @foreach ($service as $key => $value)
                            @if (in_array($value['zone'], ['FTELHO', 'PNCHO', 'TINHO', 'App Users']) || (str_starts_with($value['zone'], 'Vung') && $value['branch_name'] == null))
                                @if ($value['amount_this_time'] != $max)
                                    <tr style="background-color: #AFE1DC; font-weight: bold">
                                @else
                                    <tr style="background-color: #2cd134; font-weight: bold">
                                @endif
                            @elseif($value['zone'] == 'Total')
                                <tr style="background-color: #FDCD99; font-weight: bold">
                            @else
                                <tr>
                            @endif
                                    <td>{{ !empty($value['branch_name']) ? $value['branch_name'] : $value['zone'] }}</td>
                                    <td>{{ (!empty($value['amount_last_time'])) ? (round(($value['amount_this_time'] - $value['amount_last_time']) / $value['amount_last_time'], 4) * 100 . '%') : '100%' }}</td>
                                    <td>{{ number_format($value['amount_last_time']) }}</td>
                                    <td>{{ $value['count_last_time'] }}</td>
                                    <td>{{ (!empty($service[count($service) - 1]['amount_last_time'])) ? round(($value['amount_last_time'] / $service[count($service) - 1]['amount_last_time']), 4) * 100 : 0}}%</td>
                                    <td>{{ number_format($value['amount_this_time']) }}</td>
                                    <td>{{ $value['count_this_time'] }}</td>
                                    <td>{{ (!empty($service[count($service) - 1]['amount_this_time'])) ? round(($value['amount_this_time'] / $service[count($service) - 1]['amount_this_time']), 4) * 100 : 0}}%</td>
                                </tr>
                        @endforeach
                        
                    </table>
                </div>
                <div class="col-sm-4">
                    @if (!empty($data_product[$service[0]['service']]))
                        <table style="width: 100%">
                            <tr>
                                <th colspan="3">{{ $this_time }}</th>
                            </tr>
                            <tr>
                                <th>Loại sản phẩm</th>
                                <th>Doanh thu</th>
                                <th>Đơn hàng</th>
                            </tr>
                            @if (!empty($productByService[$service[0]['service']]))
                                @foreach (@$productByService[$service[0]['service']] as $product)
                                    <tr>
                                        <td>{{ @$product['product_type'] }}</td>
                                        <td>{{ number_format($product['amount']) }}</td>
                                        <td>{{ $product['count'] }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            
                        </table>
                    @endif
                    
                    <table style="width: 100%; margin-top: 50px">
                        <tr>
                            <th></th>
                            <th>Doanh thu</th>
                            <th>Đơn hàng</th>
                        </tr>
                        <tr>
                            <td>{{ $last_time }}</td>
                            <td>{{ number_format($service[count($service) - 1]['amount_last_time']) }}</td>
                            <td>{{ $service[count($service) - 1]['count_last_time'] }}</td>
                        </tr>
                        <tr>
                            <td>{{ $this_time }}</td>
                            <td>{{ number_format($service[count($service) - 1]['amount_this_time']) }}</td>
                            <td>{{ $service[count($service) - 1]['count_this_time'] }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif


@if (!empty($data_vietlott))
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h3>VIETLOTT<h3>
        </div>
        {{-- <h4 class="card-title">HDI</h4> --}}
        <div class="card-body row">
            {{-- {{ $ict->table([], true) }} --}}
            <div class="col-sm-8">
                <table style="width: 100%">
                    <tr>
                        <th>Nhóm sản phẩm</th>
                        <th>Doanh thu</th>
                        <th>Đơn hàng</th>
                        <th>% Theo doanh thu</th>
                    </tr>
                    @foreach ($data_vietlott as $key => $value)
                        @if ($value['product_name'] == 'Total')
                            <tr style="background-color: #FDCD99; font-weight: bold">
                        @else
                            <tr>
                        @endif
                        
                            <td>{{ @$value['product_name'] }}</td>
                            <td>{{ number_format(@$value['amount_this_time']) }}</td>
                            <td>{{ @$value['count_this_time'] }}</td>
                            <td>{{ (!empty($data_vietlott[count($data_vietlott) - 1]['amount_this_time'])) ? round(($value['amount_this_time'] / $data_vietlott[count($data_vietlott) - 1]['amount_this_time']), 4) * 100 : 0 }}%</td>
                        </tr>
                    @endforeach
                    
                </table>
            </div>
            <div class="col-sm-4">
                <table style="width: 100%; margin-top: 50px">
                    <tr>
                        <th></th>
                        <th>Doanh thu</th>
                        <th>Đơn hàng</th>
                    </tr>
                    <tr>
                        <td>{{ $last_time }}</td>
                        <td>{{ number_format($data_vietlott[count($data_vietlott) - 1]['amount_last_time']) }}</td>
                        <td>{{ $data_vietlott[count($data_vietlott) - 1]['count_last_time'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ $this_time }}</td>
                        <td>{{ number_format($data_vietlott[count($data_vietlott) - 1]['amount_this_time']) }}</td>
                        <td>{{ $data_vietlott[count($data_vietlott) - 1]['count_this_time'] }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endif