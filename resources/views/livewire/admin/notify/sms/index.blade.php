<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>عنوان اطلاعیه</th>
                <th>توضیحات اطلاعیه</th>
                <th>وضعیت</th>
                <th>تاریخ ارسال </th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($sms as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->title }}</td>
                    <td>{{ Str::substr($item->body, 0, 30) . ' ...' }}</td>
                    <td>{{ convertToShamsi($item->published_at , 'Y-m-d H:i:s') }}</td>
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
                        <a href="{{ route('admin.notify.sms.edit', $item->id) }}" class="btn btn-info btn-sm"><i
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
