<section class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نام فرم</th>
                <th>واحد اندازه گیری</th>
                <th>فرم والد</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($attributes as $item)
                <tr>
                    <th>{{$id++}}</th>
                    <td>{{ $item->name }} </td>
                    <td>{{ $item->unit }} </td>
                    <td>{{ $item->category->name }}</td>
                    <td class="width-22-rem text-left">
                        <a href="{{ route("admin.market.showcase.property.value.index" , $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> ویژگی ها</a>
                        <a href="{{ route("admin.market.showcase.property.edit" , $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                        <button class="btn btn-danger btn-sm" onclick="destroy({{ $item->id }})"><i class="fa fa-trash-alt"></i>
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
