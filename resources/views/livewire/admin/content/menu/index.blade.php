<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نام منو</th>
                <th>منوی والد</th>
                <th> لینک منو</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>

            @php
                $id = 1;
            @endphp

            @foreach ($menus as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->parent_menu == null ? 'منوی مادر' : $item->parent_menu->name }}</td>
                    <td>{{ $item->url }}</td>
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
                        <a href="{{ route('admin.content.menu.edit', $item->id) }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i> ویرایش</a>
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
