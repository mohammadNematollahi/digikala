<section class="table-responsive">
    <table class="table table-striped table-hover h-150px">
        <thead>
            <tr>
                <th>#</th>
                <th>نام کالا</th>
                <th> تصویر کالا</th>
                <th> قیمت</th>
                <th>وزن </th>
                <th>دسته </th>
                <th>طول</th>
                <th>عرض</th>
                <th>ارتفاع</th>
                <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
            </tr>
        </thead>
        <tbody>
            @php
                $id = 1;
            @endphp

            @foreach ($products as $item)
                <tr>
                    <th>{{ $id }}</th>
                    <td>{{ $item->name }}</td>
                    <td><img src="{{ asset($item->image) }}" alt="" class="max-height-2rem">
                    </td>
                    <td>{{ $item->price }} تومان</td>
                    <td>{{ $item->weight }} کیلو</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->width }}</td>
                    <td>{{ $item->height }}</td>
                    <td>{{ $item->length }}</td>
                    <td class="width-8-rem text-left">
                        <div class="dropdown">
                            <a href="#" class="btn btn-success btn-sm btn-block dorpdown-toggle" role="button"
                                id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-tools"></i> عملیات
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route('admin.market.showcase.product-gallery.index', $item->slug) }}"
                                    class="dropdown-item text-right"><i class="fa fa-images"></i>
                                    گالری</a>
                                <a href="" class="dropdown-item text-right"><i class="fa fa-list-ul"></i>
                                    فرم کالا</a>
                                <a href="{{ route('admin.market.showcase.product-color.index', $item->slug) }}"
                                    class="dropdown-item text-right"><i class="fa fa-paint-brush"></i>
                                    رنگ کالا</a>
                                <a href="{{ route('admin.market.showcase.warranty.index', $item->slug) }}"
                                    class="dropdown-item text-right"><i class="fa fa-check"></i>
                                    گارانتی کالا</a>
                                <a href="{{ route('admin.market.showcase.product.edit', $item->slug) }}"
                                    class="dropdown-item text-right"><i class="fa fa-edit"></i>
                                    ویرایش</a>
                                <a href="{{ route('admin.market.showcase.product-meta.index', $item->slug) }}"
                                    class="dropdown-item text-right"><i class="fa fa-angle-double-up"></i>
                                    قابلیت ها</a>
                                <button type="submit" class="dropdown-item text-right"
                                    onclick="destroy({{ $item->id }})"><i class="fa fa-window-close"></i>
                                    حذف</button>
                            </div>
                        </div>
                    </td>
                </tr>
                @php
                    $id++;
                @endphp
            @endforeach
        </tbody>
    </table>
</section>
