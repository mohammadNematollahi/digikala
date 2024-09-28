<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نام نقش </th>
                <th>دسترسی ها</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>

            @php
                $id = 1;
            @endphp

            @foreach ($roles as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>
                        @foreach ($item->permissions as $permission)
                            {{ $permission->name }} <br>
                        @endforeach
                    </td>
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
                        <a href="{{ route('admin.user.role.permission-edit', $item->id) }}"
                            class="btn btn-success btn-sm"><i class="fa fa-user-graduate"></i>
                            دسترسی ها</a>
                        <a href="{{ route('admin.user.role.edit', $item->id) }}" class="btn btn-primary btn-sm"><i
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
