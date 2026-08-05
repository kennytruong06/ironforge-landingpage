<x-app-layout>
    <section class="relative overflow-hidden" style="background-color: {{ $settings['hero_background_color'] ?? '#0E3439' }}">
        @if(filled($settings['hero_background_image'] ?? null))
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ Storage::disk('public')->url($settings['hero_background_image']) }}')"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/50 to-black/25"></div>
        @endif

        <div class="relative mx-auto max-w-7xl px-6 py-28 lg:px-8 lg:py-40">
            <p class="mb-4 text-sm font-semibold uppercase tracking-[0.35em] text-gold">{{ $settings['hero_eyebrow'] ?? 'Công ty TNHH Hồ Nam' }}</p>
            <h1 class="max-w-3xl text-4xl font-extrabold leading-tight tracking-tight text-white sm:text-6xl">
                {{ $settings['hero_title'] ?? 'Thi công cảnh quan xanh cho resort, khu đô thị và công trình công cộng' }}
            </h1>
            <p class="mt-6 max-w-2xl text-lg text-gray-300">
                {{ $settings['hero_description'] ?? 'Từ khảo sát, thiết kế đến thi công và bảo dưỡng, Hồ Nam đồng hành cùng chủ đầu tư để tạo nên những không gian xanh bền vững, giàu tính thẩm mỹ và dễ vận hành.' }}
            </p>
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="{{ route('products.index') }}" class="btn-primary">Xem dự án tiêu biểu</a>
                <a href="#contact" class="btn-outline">Liên hệ tư vấn</a>
            </div>
        </div>
    </section>

    <section aria-hidden="true" style="background-color: {{ $settings['hero_background_color'] ?? '#0E3439' }}">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <svg viewBox="0 0 1440 180" class="h-24 w-full text-gold/40">
                <path d="M0 120 C 120 80, 240 160, 360 120 S 600 80, 720 120 S 960 160, 1080 120 S 1320 80, 1440 120" fill="none" stroke="currentColor" stroke-width="1.5" opacity="0.55" />
                <path d="M0 132 C 120 92, 240 172, 360 132 S 600 92, 720 132 S 960 172, 1080 132 S 1320 92, 1440 132" fill="none" stroke="currentColor" stroke-width="1.5" opacity="0.35" />
                <path d="M0 144 C 120 104, 240 184, 360 144 S 600 104, 720 144 S 960 184, 1080 144 S 1320 104, 1440 144" fill="none" stroke="currentColor" stroke-width="1.5" opacity="0.22" />
                <path d="M0 156 C 120 116, 240 196, 360 156 S 600 116, 720 156 S 960 196, 1080 156 S 1320 116, 1440 156" fill="none" stroke="currentColor" stroke-width="1.5" opacity="0.15" />
            </svg>
        </div>
    </section>

    <section class="border-b border-gray-100 bg-white">
        <div class="mx-auto grid max-w-7xl grid-cols-2 gap-8 px-6 py-16 sm:grid-cols-4 lg:px-8">
            @foreach([
                ['value' => $settings['stat_1_value'] ?? '19+', 'label' => $settings['stat_1_label'] ?? 'Năm phát triển'],
                ['value' => $settings['stat_2_value'] ?? '300+', 'label' => $settings['stat_2_label'] ?? 'Hạng mục bàn giao'],
                ['value' => $settings['stat_3_value'] ?? '3', 'label' => $settings['stat_3_label'] ?? 'Miền phục vụ'],
                ['value' => $settings['stat_4_value'] ?? '50+', 'label' => $settings['stat_4_label'] ?? 'Đối tác & chủ đầu tư'],
            ] as $stat)
                <div class="text-center">
                    <p class="font-stats text-4xl text-charcoal sm:text-5xl">{{ $stat['value'] }}</p>
                    <p class="mt-2 text-sm font-medium uppercase tracking-wide text-gray-500">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="bg-gray-50 py-24" x-data="{ activeCategory: 'all' }">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-14 flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
                <div>
                    <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Dự án tiêu biểu</p>
                    <h2 class="section-heading">Không gian xanh theo chuẩn vận hành thực tế</h2>
                </div>
                <a href="{{ route('products.index') }}" class="text-sm font-semibold text-charcoal hover:text-gold">Xem tất cả dự án &rarr;</a>
            </div>

            <div class="mb-10 flex flex-wrap gap-3">
                <button @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? 'bg-charcoal text-white' : 'bg-white text-charcoal ring-1 ring-gray-200'"
                        class="rounded-full px-5 py-2 text-sm font-medium transition">Tất cả</button>
                @foreach($categories as $category)
                    <button @click="activeCategory = '{{ $category->slug }}'"
                            :class="activeCategory === '{{ $category->slug }}' ? 'bg-charcoal text-white' : 'bg-white text-charcoal ring-1 ring-gray-200'"
                            class="rounded-full px-5 py-2 text-sm font-medium transition">{{ $category->name }}</button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($featuredProducts as $product)
                    <div x-show="activeCategory === 'all' || activeCategory === '{{ $product->category->slug }}'" class="card overflow-hidden">
                        <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                            <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                            <span class="absolute left-4 top-4 rounded-full bg-gold px-3 py-1 text-xs font-bold uppercase text-charcoal">Tiêu biểu</span>
                        </div>
                        <div class="p-6">
                            <p class="text-xs font-semibold uppercase tracking-wide text-gold">{{ $product->category->name }}</p>
                            <h3 class="mt-1 text-lg font-bold text-charcoal">{{ $product->title }}</h3>
                            <div class="mt-4 grid grid-cols-2 gap-2 text-xs text-gray-500">
                                @foreach(array_slice($product->specifications ?? [], 0, 2) as $spec)
                                    <div>
                                        <p class="font-semibold text-charcoal">{{ $spec['value'] }}</p>
                                        <p>{{ $spec['key'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <a href="{{ route('products.show', $product) }}" class="mt-6 inline-flex items-center gap-1 text-sm font-semibold text-charcoal hover:text-gold">
                                Xem chi tiết &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Chưa có dự án nổi bật để hiển thị.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-white py-24">
        <div class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-16 px-6 lg:grid-cols-2 lg:px-8">
            <div>
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">{{ $settings['about_eyebrow'] ?? 'Về Hồ Nam' }}</p>
                <h2 class="section-heading">{{ $settings['about_title'] ?? 'Từ nền tảng 1996 đến doanh nghiệp chính thức năm 2006' }}</h2>
                <p class="mt-6 text-gray-600">
                    {{ $settings['about_description_1'] ?? 'Hồ Nam phát triển từ một tiền thân hình thành năm 1996, đến năm 2006 chính thức trở thành doanh nghiệp hoạt động chuyên sâu trong lĩnh vực cảnh quan, thi công cây xanh và duy tu bảo dưỡng.' }}
                </p>
                @if(filled($settings['about_description_2'] ?? null))
                    <p class="mt-4 text-gray-600">{{ $settings['about_description_2'] }}</p>
                @endif
                <ul class="mt-8 space-y-4">
                    @foreach(array_filter([
                        $settings['about_point_1'] ?? 'Khảo sát hiện trạng và lập giải pháp cảnh quan theo từng dự án',
                        $settings['about_point_2'] ?? 'Thi công cây xanh, hệ tưới và cảnh quan mềm đồng bộ',
                        $settings['about_point_3'] ?? 'Chăm sóc, bảo dưỡng dài hạn sau bàn giao',
                    ]) as $point)
                        <li class="flex items-center gap-3 text-gray-700">
                            <span class="flex h-6 w-6 flex-none items-center justify-center rounded-full bg-gold/20 text-gold">✓</span>
                            {{ $point }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="overflow-hidden rounded-2xl shadow-premium">
                <img src="{{ filled($settings['about_image'] ?? null) ? Storage::disk('public')->url($settings['about_image']) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=1200' }}" alt="{{ $settings['about_title'] ?? 'Cảnh quan xanh Hồ Nam' }}" class="h-full w-full object-cover">
            </div>
        </div>
    </section>

    <section class="bg-charcoal py-24 text-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center">
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Năng lực cốt lõi</p>
                <h2 class="section-heading !text-white">Thiết kế, thi công và duy tu trọn gói</h2>
            </div>

            <div class="mt-14 grid grid-cols-1 gap-8 md:grid-cols-3">
                @foreach([
                    [
                        'title' => 'Resort & ven biển',
                        'desc' => 'Tạo lớp cảnh quan mềm, chịu gió mặn, phù hợp tiêu chuẩn nghỉ dưỡng cao cấp.',
                    ],
                    [
                        'title' => 'Công viên & công trình công cộng',
                        'desc' => 'Cân bằng giữa thẩm mỹ, an toàn giao thông và độ bền trong vận hành dài hạn.',
                    ],
                    [
                        'title' => 'Khu công nghiệp & đô thị',
                        'desc' => 'Giải pháp cây xanh giảm bụi, tăng bóng mát và tối ưu chi phí bảo dưỡng.',
                    ],
                ] as $service)
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-8">
                        <h3 class="text-xl font-heading text-white">{{ $service['title'] }}</h3>
                        <p class="mt-4 text-sm leading-relaxed text-gray-300">{{ $service['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-24 border-y border-gray-100">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="text-center mb-16">
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Khách hàng nói gì</p>
                <h2 class="section-heading">Những phản hồi thực tế từ dự án</h2>
                <p class="mt-4 text-gray-500 max-w-lg mx-auto">Các đánh giá dưới đây phản ánh trải nghiệm làm việc và chất lượng bàn giao mà Hồ Nam đang theo đuổi.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($testimonials as $testimonial)
                    <div class="card flex flex-col justify-between bg-white p-8">
                        <div>
                            <div class="mb-4 flex gap-1 text-gold text-lg">
                                @for($i = 0; $i < 5; $i++)
                                    @if($i < $testimonial->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            <p class="text-sm leading-relaxed text-gray-600 italic">“{{ $testimonial->content }}”</p>
                        </div>
                        <div class="mt-6 flex items-center gap-4 border-t border-gray-100 pt-4">
                            <img src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->customer_name }}" class="h-10 w-10 rounded-full object-cover">
                            <div>
                                <h4 class="text-sm font-bold text-charcoal">{{ $testimonial->customer_name }}</h4>
                                <p class="text-xs text-gray-400">{{ $testimonial->company }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Chưa có đánh giá nào.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="bg-white py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mb-14 flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-end">
                <div>
                    <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Tin tức & chia sẻ</p>
                    <h2 class="section-heading">Cập nhật từ đội ngũ Hồ Nam</h2>
                </div>
                <a href="{{ route('news.index') }}" class="text-sm font-semibold text-charcoal hover:text-gold">Xem toàn bộ bài viết &rarr;</a>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($latestPosts as $post)
                    <div class="card overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="h-48 w-full overflow-hidden bg-gray-100">
                                <img src="{{ $post->image ? Storage::disk('public')->url($post->image) : 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=600' }}"
                                     alt="{{ $post->title }}" class="h-full w-full object-cover transition duration-500 hover:scale-105">
                            </div>
                            <div class="p-6">
                                <p class="text-xs text-gray-400">{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</p>
                                <h3 class="mt-2 text-lg font-bold text-charcoal leading-snug hover:text-gold transition">
                                    <a href="{{ route('news.show', $post) }}">{{ $post->title }}</a>
                                </h3>
                                <p class="mt-3 text-xs text-gray-500 line-clamp-2">{{ $post->excerpt ?? Str::limit(strip_tags($post->body), 100) }}</p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ route('news.show', $post) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-charcoal hover:text-gold">
                                Đọc bài viết &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Chưa có bài viết nào.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section id="contact" class="bg-charcoal py-24">
        <div class="mx-auto max-w-5xl px-6 lg:px-8">
            <div class="text-center">
                <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-gold">Liên hệ báo giá</p>
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">Gửi yêu cầu dự án cho Hồ Nam</h2>
                <p class="mt-4 text-gray-400">Đội ngũ của chúng tôi sẽ phản hồi trong vòng 24 giờ làm việc.</p>
            </div>

            @if(session('success'))
                <div class="mt-8 rounded-md bg-green-500/10 px-4 py-3 text-sm text-green-400 ring-1 ring-green-500/30">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('inquiries.store') }}" x-data="{ submitting: false }" @submit="submitting = true" class="mt-10 grid grid-cols-1 gap-5 sm:grid-cols-2">
                @csrf
                <div>
                    <label class="label !text-gray-300">Họ và tên</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="input">
                    @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="label !text-gray-300">Số điện thoại</label>
                    <input type="text" name="phone" required value="{{ old('phone') }}" class="input">
                    @error('phone') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="label !text-gray-300">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="input">
                    @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <label class="label !text-gray-300">Dự án quan tâm</label>
                    <select name="product_id" class="input">
                        <option value="">Chọn dự án (không bắt buộc)</option>
                        @foreach(\App\Models\Product::orderBy('title')->get() as $product)
                            <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>{{ $product->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="label !text-gray-300">Nội dung yêu cầu</label>
                    <textarea name="message" rows="4" class="input">{{ old('message') }}</textarea>
                    @error('message') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <button type="submit" :disabled="submitting" class="btn-primary w-full disabled:opacity-60">
                        <span x-show="!submitting">Gửi yêu cầu</span>
                        <span x-show="submitting">Đang gửi...</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
