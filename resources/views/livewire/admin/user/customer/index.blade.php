<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>ایمیل</th>
                <th>شماره موبایل</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>کد ملی</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->mobile }} </td>
                    <td>{{ $item->first_name }}</td>
                    <td>{{$item->last_name}} </td>
                    <td>سوپر ادمین </td>
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
                        <a href="{{route("admin.user.admin-user.edit" , $item->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                        <button class="btn btn-danger btn-sm" onclick="destroy({{ $item->id }})">
                            <i class="fa fa-trash mx-1"></i>حذف
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
