<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th class="text-left">#</th>
                <th class="text-left">نام دسته بندی</th>
                <th class="text-left">دسته والد</th>
                <th class="text-left">اسلاگ</th>
                <th class="text-left">توضیحات</th>
                <th class="text-left">عکس</th>
                <th class="text-center">نمایش در منو</th>
                <th class="text-center">وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp

            @foreach ($categories as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->parentMenu->name ?? "منوی والد" }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ Str::substr($item->description, 0, 30) }}</td>
                    <td>
                        <div>
                            <img src="{{ asset($item->image) }}" alt="" width="100px" height="100px">
                        </div>
                    </td>
                    <td class="width-16-rem text-center">
                        @if ($item->show_in_menu == 1)
                            <button class="btn btn-success" wire:click="showInMenu({{ $item->id }})"><i
                                    class="fa fa-list"></i> فعال </button>
                        @else
                            <button class="btn btn-warning" wire:click="showInMenu({{ $item->id }})"><i
                                    class="fa fa-cut"></i> غیر فعال </button>
                        @endif
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
                        <a href="{{ route('admin.market.showcase.category.edit', $item->slug) }}"
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
