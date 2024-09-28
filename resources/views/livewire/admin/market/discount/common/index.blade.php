<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>درصد تخفیف</th>
                <th>سقف تخفیف</th>
                <th>عنوان مناسبت</th>
                <th>تاریخ شروع</th>
                <th>تاریخ پایان</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp

            @foreach ($commons as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <th>{{ $item->percentage }}%</th>
                    <th>{{ $item->discount_ceiling }} تومان</th>
                    <th>{{ $item->title }}</th>
                    <td>{{ convertToShamsi($item->start_date) }}</td>
                    <td>{{ convertToShamsi($item->end_date, 'Y-m-d H:i:s') }}</td>
                    <td>
                        @if ($item->status == 1)
                            <button class="btn btn-success" wire:click="status({{ $item->id }})"><i
                                    class="fa fa-cogs"></i>
                                فعال </button>
                        @else
                            <button class="btn btn-warning" wire:click="status('{{ $item->id }}')"><i
                                    class="fa fa-cog"></i> غیر فعال </button>
                        @endif
                    </td>
                    <td class="width-16-rem text-left">
                        <a href="{{ route('admin.market.discount.common.edit', $item->id) }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                            <button class="btn btn-danger btn-sm" onclick="destroy({{ $item->id }})">
                                <i class="fa fa-trash mx-1"></i>حذف
                            </button>
                    </td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach
        </tbody>
    </table>
</section>
