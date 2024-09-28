<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نام و نام خانوادگی</th>
                <th>شماره موبایل</th>
                <th>ایمیل</th>
                <th>نقش</th>
                <th>دسترسی</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $item->fullName ?? "-" }}</td>
                    <td>{{ $item->mobile ?? "-"}} </td>
                    <td>{{ $item->email ?? "-"}}</td>
                    <td>
                        @if ($item->roles->isEmpty())
                            <span class="text-danger">
                                <b>
                                    نقشی برای این کاربر نیست
                                </b>
                            </span>
                        @endif
                        @foreach ($item->roles as $role)
                            {{ $role->name }} <br>
                        @endforeach
                    </td>
                    <td>
                        @if ($item->permissions->isEmpty())
                            <span class="text-danger">
                                <b>
                                    دسترسی برای این کاربر نیست
                                </b>
                            </span>
                        @endif
                        @foreach ($item->permissions as $permission)
                            {{ $permission->name }} <br>
                        @endforeach
                    </td>
                    <td>
                        @if ($item->status == 1)
                            <button class="btn btn-success btn-sm" wire:click="status({{ $item->id }})"><i
                                    class="fa fa-cogs"></i>
                                فعال </button>
                        @else
                            <button class="btn btn-warning btn-sm" wire:click="status('{{ $item->id }}')"><i
                                    class="fa fa-cog"></i> غیر فعال </button>
                        @endif
                    </td>
                    <td class="width-22-rem text-left">
                        <a href="{{ route("admin.user.admin-user.permission-user" , $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-user-graduate"></i> دسترسی</a>
                        <a href="{{ route("admin.user.admin-user.role-user" , $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> نقش</a>
                        <a href="{{ route('admin.user.admin-user.edit', $item->id) }}" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i> ویرایش</a>
                        <button class="btn btn-danger btn-sm" onclick="destroy({{ $item->id }})">
                            <i class="fa fa-trash mx-1"></i>حذف
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
