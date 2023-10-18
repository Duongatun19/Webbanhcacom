@php
$totalPrice = 0;
@endphp
@foreach ($listCart as $item)
@php
$discountPrice = $item['price'] - $item['price']*($item['discount']/100);
$totalPrice += $discountPrice * $item['quantity'];
@endphp
<tr>
    <td class="cart-product-name">
        <img src="{{$item['image']}}" alt="" loading="lazy">
        <h5>{{languageName($item['name'])}}</h5>
    </td>
    <td>{{$item['color']}}</td>
    <td>{{$item['size']}}</td>
    <td class="cart-product-quantity">
        <input
            type="number"
            id="qtyItem{{$item['id']}}"
            class="input-text qty text"
            step="1"
            min="0"
            max=""
            name="cart[aa677d660eefd1fe0d323c1dc9bfa869][qty]"
            value="{{$item['quantity']}}"
            title="Qty"
            size="4"
            placeholder=""
            inputmode="numeric" data-url="{{route('updateCart')}}" data-id="{{$item['id']}}"/>
    </td>
    <td>{{number_format($discountPrice)}}₫</td>
    <td><a href="javascript:void(0);" class="remove" aria-label="Remove this item" onclick="removeItem({{$item['id']}})">Xóa</a></td>
</tr>
@endforeach
<thead>
<tr>
    <th>Tổng tiền</th>
    <th class="total-price">{{number_format($totalPrice)}}₫</th>
</tr>
</thead>