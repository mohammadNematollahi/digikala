<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>کد کاربر</th>
                <th>ایمیل</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp

            @foreach ($admins as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->email }}</td>
                    <td class="width-16-rem text-left">
                        @if ($item->ticketAdmin != null)
                            <button class="btn btn-success" wire:click="setAndUnset({{ $item->id }})"> <i
                                    class="fa fa-check"></i> تایید شده </button>
                        @else
                            <button class="btn btn-info" wire:click="setAndUnset({{ $item->id }})"> <i
                                    class="fa fa-cut"></i> تایید نشده </button>
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
