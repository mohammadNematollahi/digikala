<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>کد تراکنش</th>
                <th>بانک </th>
                <th>به حساب</th>
                <th>پرداخت کننده</th>
                <th>وضعیت پرداخت</th>
                <th>نوع پرداخت</th>
                <th>مبلغ</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp

            @foreach ($payments as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->paymentable->transaction_id ?? '-' }}</td>
                    <td>{{ $item->paymentable->gateway ?? '-' }}</td>
                    <td>{{ $item->paymentable->cash_receiver ?? '-' }}</td>
                    <td>{{ $item->user->first_name . ' ' . $item->user->last_name ?? $item->user->mobile }}</td>
                    <td>
                        @if ($item->status == 0)
                            پرداخت نشده
                        @elseif($item->status == 1)
                            پرداخت شده
                        @elseif($item->status == 2)
                            باطل شده
                        @else
                            بازگشت داده شده
                        @endif
                    </td>
                    <td>
                        @if ($item->type == 0)
                            آنلاین
                        @elseif($item->type == 1)
                            آفلاین
                        @else
                            درب منزل
                        @endif
                    </td>
                    <td>{{ $item->amount }}</td>
                    <td class="width-22-rem text-left">
                        <a href="{{ route("admin.market.payment.show" , $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> مشاهده</a>
                        <button class="btn btn-warning btn-sm" wire:click="canceled({{ $item->id }})"><i
                                class="fa fa-close"></i> باطل
                            کردن</button>

                        <button class="btn btn-danger btn-sm" wire:click="returned({{ $item->id }})"><i
                                class="fa fa-reply"></i>
                            برگشت داده شده</button>
                    </td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach
        </tbody>
    </table>
</section>
