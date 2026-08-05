<x-app-layout>
    <x-slot:title>Giới thiệu — Công Ty TNHH Hồ Nam</x-slot:title>
    <x-slot:description>Câu chuyện hình thành, năng lực thi công và những dự án tiêu biểu của Công Ty TNHH Hồ Nam trong lĩnh vực cảnh quan xanh.</x-slot:description>

    <section class="relative overflow-hidden bg-charcoal py-24 text-white">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2000')] bg-cover bg-center opacity-15"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal via-charcoal/85 to-charcoal/40"></div>
        <div class="relative mx-auto max-w-7xl px-6 text-center lg:px-8">
            <p class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-gold">Hồ Nam Landscape</p>
            <h1 class="text-4xl font-extrabold tracking-tight sm:text-6xl text-white">
                Kiến tạo không gian xanh bền vững từ nền tảng kinh nghiệm lâu năm
            </h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-gray-300">
                Từ tiền thân hình thành năm 1996 đến doanh nghiệp chính thức năm 2006, Hồ Nam theo đuổi các dự án cảnh quan có giá trị sử dụng lâu dài, giàu tính thẩm mỹ và phù hợp thực tế vận hành.
            </p>
        </div>
    </section>

    <section class="bg-white py-24">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-16 px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">{{ $settings['about_eyebrow'] ?? 'Câu chuyện thương hiệu' }}</p>
                <h2 class="section-heading">{{ $settings['about_title'] ?? 'Từ một cơ sở tiền thân đến doanh nghiệp cảnh quan chuyên sâu' }}</h2>
                <p class="mt-6 text-gray-600 leading-relaxed">
                    {{ $settings['about_description_1'] ?? 'Hồ Nam phát triển trên nền tảng kinh nghiệm thực địa tích lũy qua nhiều thế hệ thi công cây xanh, đặc biệt ở những khu vực có yêu cầu cao như resort ven biển, công viên công cộng và khu đô thị mới.' }}
                </p>
                @if(filled($settings['about_description_2'] ?? ''))
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        {{ $settings['about_description_2'] }}
                    </p>
                @endif

                <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-5">
                        <h3 class="text-lg font-bold text-charcoal">1996</h3>
                        <p class="mt-2 text-sm text-gray-500">{{ $settings['about_point_1'] ?? 'Tiền thân của Hồ Nam bắt đầu hình thành từ các công trình cây xanh và chăm sóc cảnh quan quy mô nhỏ.' }}</p>
                    </div>
                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-5">
                        <h3 class="text-lg font-bold text-charcoal">2006</h3>
                        <p class="mt-2 text-sm text-gray-500">{{ $settings['about_point_2'] ?? 'Doanh nghiệp chính thức hoạt động với định hướng thi công cảnh quan chuyên nghiệp.' }}</p>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl shadow-premium min-h-[350px] bg-gray-100 flex items-center justify-center">
                @if(filled($settings['about_image'] ?? null))
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($settings['about_image']) }}" alt="{{ $settings['about_title'] ?? 'Đội ngũ Hồ Nam thi công cảnh quan' }}" class="h-full w-full object-cover">
                @else
                    <img src="https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?q=80&w=1200" alt="Đội ngũ Hồ Nam thi công cảnh quan" class="h-full w-full object-cover">
                @endif
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Ban điều hành</p>
                <h2 class="section-heading">Giám đốc Nguyễn Chí Chúc</h2>
                <p class="mt-4 text-gray-500 max-w-2xl mx-auto">
                    Người định hướng các tiêu chuẩn thi công, quản lý chất lượng và phát triển dịch vụ của Hồ Nam theo triết lý “bền vững, chỉn chu và đúng cam kết”.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-10 lg:grid-cols-[1.2fr_0.8fr] items-center">
                <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
                    <h3 class="text-2xl font-heading text-charcoal">Hồ sơ năng lực</h3>
                    <p class="mt-4 text-sm leading-relaxed text-gray-600">
                        Ông Nguyễn Chí Chúc là người trực tiếp theo dõi nhiều dự án cảnh quan quy mô lớn tại Bà Rịa - Vũng Tàu và khu vực lân cận, với kinh nghiệm kết nối giữa yêu cầu thẩm mỹ, thi công hiện trường và khả năng bảo trì sau bàn giao.
                    </p>
                    <ul class="mt-6 space-y-3 text-sm text-gray-700">
                        @foreach([
                            'Điều phối khảo sát, thiết kế và thi công đồng bộ',
                            'Kiểm soát tiến độ, chất lượng vật liệu và tỷ lệ sống của cây',
                            'Tập trung vào giải pháp dễ vận hành và tối ưu chi phí bảo dưỡng',
                        ] as $item)
                            <li class="flex items-start gap-3">
                                <span class="mt-1 flex h-5 w-5 items-center justify-center rounded-full bg-gold/20 text-[10px] font-bold text-gold">✓</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="rounded-2xl bg-charcoal p-8 text-white shadow-premium">
                    <p class="text-sm font-semibold uppercase tracking-widest text-gold">Năng lực triển khai</p>
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        @foreach([
                            ['value' => 'Resort', 'label' => 'Cảnh quan ven biển'],
                            ['value' => 'Đô thị', 'label' => 'Công viên & quảng trường'],
                            ['value' => 'KCN', 'label' => 'Dải cây xanh nội khu'],
                            ['value' => 'Duy tu', 'label' => 'Chăm sóc dài hạn'],
                        ] as $box)
                            <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                <p class="text-lg font-bold text-white">{{ $box['value'] }}</p>
                                <p class="mt-1 text-xs text-gray-300">{{ $box['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Dự án tiêu biểu</p>
                <h2 class="section-heading">Những công trình đã tạo dấu ấn</h2>
                <p class="mt-4 text-gray-500 max-w-2xl mx-auto">
                    Từ resort cao cấp đến công viên và công trình công cộng, mỗi dự án là một bài toán khác nhau về khí hậu, thẩm mỹ và vận hành.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($featuredProducts as $product)
                    <div class="card overflow-hidden bg-white flex flex-col justify-between">
                        <div>
                            <div class="relative h-52 w-full overflow-hidden bg-gray-100">
                                <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                                <span class="absolute left-4 top-4 rounded-full bg-gold px-3 py-1 text-xs font-bold uppercase text-charcoal">{{ $product->category->name ?? 'Dự án' }}</span>
                            </div>
                            <div class="p-6">
                                <h3 class="mt-1 text-lg font-bold text-charcoal leading-snug hover:text-gold transition">
                                    <a href="{{ route('products.show', $product) }}">{{ $product->title }}</a>
                                </h3>
                                <p class="mt-3 text-sm text-gray-500 line-clamp-3">
                                    {{ $product->description ?? 'Dự án tiêu biểu trong danh mục cảnh quan của Hồ Nam, tập trung vào hiệu quả sử dụng, tỷ lệ cây sống và trải nghiệm không gian lâu dài.' }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ route('products.show', $product) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-charcoal hover:text-gold">
                                Xem chi tiết &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 py-8">Chưa có dự án tiêu biểu nào trong hệ thống.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                @foreach([
                    [
                        'title' => 'Khảo sát kỹ lưỡng',
                        'desc' => 'Bắt đầu từ điều kiện đất, gió, nắng, nguồn nước và mục tiêu vận hành của chủ đầu tư.',
                    ],
                    [
                        'title' => 'Thi công đồng bộ',
                        'desc' => 'Kết hợp cây xanh, thảm cỏ, hệ tưới và hạ tầng phụ trợ trong một quy trình thống nhất.',
                    ],
                    [
                        'title' => 'Bảo dưỡng dài hạn',
                        'desc' => 'Đội ngũ duy tu theo dõi sau bàn giao để giữ chất lượng cảnh quan ổn định theo thời gian.',
                    ],
                ] as $item)
                    <div class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-100">
                        <h3 class="text-xl font-heading text-charcoal">{{ $item['title'] }}</h3>
                        <p class="mt-4 text-sm leading-relaxed text-gray-600">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
