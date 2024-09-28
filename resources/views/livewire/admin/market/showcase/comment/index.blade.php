<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>کد کاربر</th>
                <th>نویسنده نظر</th>
                <th>کد کالا</th>
                <th>کالا</th>
                <th>وضعیت</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp

            @foreach ($comments as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->author_id }}</td>
                    <td>{{ $item->user->first_name . " " . $item->user->last_name }}</td>
                    <td>{{ $item->commentable_id }}</td>
                    <td>{{ $item->body }}</td>
                    <td>
                        @if ($item->approved == 0)
                            در انتظار تایید ...
                        @else
                            تایید شده
                        @endif
                    </td>
                    <td class="width-16-rem text-left">
                        <a href="{{ route('admin.market.showcase.comment.show', $item->id) }}" class="btn btn-info btn-sm"><i
                                class="fa fa-eye"></i> نمایش</a>
                        @if ($item->approved == 0)
                            <button class="btn btn-warning btn-sm" wire:click="approved('{{$item->id}}')"><i class="fa fa-check" ></i>تایید نشده</button>
                        @else
                            <button class="btn btn-success btn-sm" wire:click="approved('{{$item->id}}')"><i class="fa fa-check"></i>تایید</button>
                        @endif
                    </td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach
        </tbody>
    </table>
</section>
