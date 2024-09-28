<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>دسترسی</th>
                <th>نقش</th>
                <th>توضیحات</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>

            @php
                $id = 1;
            @endphp

            @foreach ($permissions as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>

                        @if ($item->roles->isEmpty())
                            <span class="text-danger"><b>نقشی برای این دسترسی موجود نیست</b></span>
                        @endif

                        @foreach ($item->roles as $role)
                            {{ $role->name}} <br>
                        @endforeach

                    </td>
                    <td>{{ $item->description }}</td>
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
                    <td class="width-22-rem text-left">
                        <a href="{{ route('admin.user.permissions.edit', $item->id) }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i>
                            ویرایش</a>
                        <button class="btn btn-danger btn-sm" type="submit" onclick="destroy({{ $item->id }})"><i
                                class="fa fa-trash-alt"></i>
                            حذف</button>
                    </td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach

        </tbody>
    </table>
</section>
