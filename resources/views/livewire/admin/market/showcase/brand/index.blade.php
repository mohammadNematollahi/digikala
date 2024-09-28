<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نام ایرانی برند</th>
                <th>نام خارجی برند</th>
                <th>لوگو</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp

            @foreach ($brands as $item)
                <tr>
                    <th>{{$id}}</th>
                    <td>{{$item->persian_name}} </td>
                    <td>{{$item->original_name}} </td>
                    <td><img src="{{ asset($item->logo) }}" alt="" class="max-height-2rem">
                    </td>
                    <td class="width-16-rem text-center">
                        @if ($item->status == 1)
                            <button class="btn btn-success" wire:click="status({{ $item->id }})"><i
                                    class="fa fa-cogs"></i> فعال </button>
                        @else
                            <button class="btn btn-warning" wire:click="status({{ $item->id }})"><i
                                    class="fa fa-cog"></i> غیر فعال </button>
                        @endif
                    </td>
                    <td class="width-16-rem text-left">
                        <a href="{{ route('admin.market.showcase.brand.edit', $item->slug) }}"
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
