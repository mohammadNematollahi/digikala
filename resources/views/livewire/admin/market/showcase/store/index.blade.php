<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نام کالا</th>
                <th>تصویر کالا</th>
                <th>موجودی</th>
                <th>فروخته شده</th>
                <th>در سبد خرید نگه داری شده</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>

            @php
                $id = 1;
            @endphp

            @foreach ($products as $item)
                <tr>
                    <th>{{$id}}</th>
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ asset($item->image) }}" alt="" class="max-height-2rem">
                    </td>
                    <td>{{ $item->marketable_number }}</td>
                    <td>{{ $item->sold_number }}</td>
                    <td>{{ $item->frozen_number }}</td>
                    <td class="width-22-rem text-left">
                        <a href="{{ route('admin.market.showcase.store.add-to-store' , $item->slug) }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> افزایش موجودی</a>
                        <a href="{{ route("admin.market.showcase.store.edit-store.editStore" , $item->slug) }}" class="btn btn-warning btn-sm"><i class="fa fa-check"></i>
                            اصلاح موجودی</a>
                    </td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach

        </tbody>
    </table>
</section>
