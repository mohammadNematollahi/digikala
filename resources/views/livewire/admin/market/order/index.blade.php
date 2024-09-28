<section class="table-responsive">
    <table class="table table-striped table-hover h-150px">
        <thead>
            <tr>
                <th>#</th>
                <th>کد سفارش</th>
                <th>مبلغ سفارش</th>
                <th>مبلغ تخفیف</th>
                <th>مبلغ نهایی</th>
                <th>وضعیت پرداخت</th>
                <th>شیوه پرداخت</th>
                <th>بانک</th>
                <th>وضعیت ارسال</th>
                <th>شیوه ارسال</th>
                <th>وضعیت سفارش</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($orders as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->order_final_amount }} تومان</td>
                    <td>{{ $item->order_discount_amount }} تومان</td>
                    <td>{{ $item->order_final_amount - $item->order_discount_amount }} تومان</td>
                    <td>
                        {{ $item->paymentStatusValue }}
                    </td>
                    <td>
                        @if ($item->payment_type == 0)
                            آنلاین
                        @elseif($item->payment_type == 1)
                            آفلاین
                        @else
                            درب منزل
                        @endif
                    </td>
                    <td>{{ $item->payment->paymentable->gateway ?? '-' }}</td>
                    <td>
                        @if ($item->delivery_status == 0)
                            ارسال نشده
                        @elseif ($item->delivery_status == 1)
                            درحال ارسال
                        @elseif ($item->delivery_status == 2)
                            ارسال شده
                        @else
                            تحویل داده شده
                        @endif
                    </td>
                    <td>{{ $item->delivery_object['name'] ?? 'پیک موتوری' }}</td>
                    <td>
                        @if ($item->order_status == 0)
                            بررسی نشده
                        @elseif ($item->order_status == 1)
                            در انتظار تایید
                        @elseif ($item->order_status == 2)
                            تایید نشده
                        @elseif ($item->order_status == 3)
                            تایید شده
                        @elseif ($item->order_status == 4)
                            باطل شده
                        @elseif ($item->order_status == 5)
                            مرجوع شده
                        @endif
                    </td>
                    <td class="width-8-rem text-left">
                        <div class="dropdown">
                            <a href="#" class="btn btn-success btn-sm btn-block dorpdown-toggle" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-tools"></i> عملیات
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route('admin.market.order.show', $item->id) }}"
                                    class="dropdown-item text-right"><i class="fa fa-images"></i>
                                    مشاهده فاکتور</button>
                                    <a class="dropdown-item text-right pointer"
                                        wire:click="deliveryStatus({{ $item->id }})"><i class="fa fa-list-ul"></i>
                                        تغییر وضعیت ارسال</a>
                                    <a class="dropdown-item text-right pointer"
                                        wire:click="orderStatus({{ $item->id }})"><i class="fa fa-edit"></i>
                                        تغییر وضعیت سفارش</a>
                                    <a class="dropdown-item text-right pointer"
                                        wire:click="returned({{ $item->id }})"><i class="fa fa-window-close"></i>
                                        باطل
                                        کردن سفارش</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach
        </tbody>
    </table>
</section>
