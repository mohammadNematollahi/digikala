<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نویسنده تیکت</th>
                <th>عنوان تیکت</th>
                <th>دسته تیکت</th>
                <th>اولویت تیکت</th>
                <th>ارجاع شده از</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>

            @php
                $id = 1;
            @endphp

            @foreach ($tickets as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->user->first_name . ' ' . $item->user->last_name ?? $item->user->mobile }}</td>
                    <td>{{ $item->subject }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->priority->name }}</td>
                    <td>{{ $item->ticketAdmin->user->first_name . ' ' . $item->ticketAdmin->user->last_name ?? $item->ticketAdmin->user->mobile }}
                    </td>
                    <td class="width-16-rem text-left">

                        @if ($item->status == 1)
                            <button class="btn btn-success" wire:click="ticketCloseAndOpen({{ $item->id }})"><i
                                    class="fa fa-check"></i> باز شده </button>
                        @else
                            <button class="btn btn-danger" wire:click="ticketCloseAndOpen({{ $item->id }})"><i
                                    class="fa fa-cut"></i> بسته </button>
                        @endif

                        <a href="{{ route('admin.ticket.show', $item->id) }}" class="btn btn-info btn-sm"><i
                                class="fa fa-eye"></i>
                            مشاهده</a>

                    </td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach

        </tbody>
    </table>
</section>
