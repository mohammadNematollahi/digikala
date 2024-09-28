<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>عنوان اطلاعیه</th>
                <th>بدنه ی ایمیل</th>
                <th>تاریخ ارسال </th>
                <th>فایل های ضمیمه</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp

            @foreach ($emails as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->subject }}</td>
                    <td>{{ Str::substr($item->body, 0, 30) . ' ...' }}</td>
                    <td>{{convertToShamsi($item->published_at , 'Y-m-d H:i:s')}}</td>

                    <td>
                        <a href="{{route("admin.notify.email.all-files.index" , $item->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-file"></i> ایجاد و
                            مشاهده فایل های ضمیمه</a>
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

                    <td class="width-16-rem text-left">
                        <a href="{{ route('admin.notify.email.edit', $item->id) }}" class="btn btn-info btn-sm"><i
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
