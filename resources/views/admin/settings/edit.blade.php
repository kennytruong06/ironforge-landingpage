<x-admin-layout title="Cài đặt website">
    <div class="mx-auto max-w-4xl space-y-8">
        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
            <h2 class="text-lg font-bold text-charcoal">Cấu hình website</h2>
            <p class="mt-2 text-sm text-gray-500">
                Cập nhật tên thương hiệu, logo và các liên kết hiển thị trên website. Thay đổi được áp dụng ngay sau khi lưu.
            </p>
        </div>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-100">
            @csrf
            @method('PUT')

            <section class="space-y-5">
                <div>
                    <h3 class="text-base font-bold text-charcoal">Thương hiệu</h3>
                    <p class="mt-1 text-sm text-gray-500">Tên và logo được dùng ở header, footer và API settings.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="label">Tên website</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'Hồ Nam Landscape') }}" class="input" required>
                        @error('site_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Logo</label>
                        <input type="file" name="site_logo" accept="image/png,image/jpeg,image/webp,image/svg+xml" class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-md file:border-0 file:bg-gold file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gold/90">
                        @error('site_logo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror

                        @if(filled($settings['site_logo'] ?? ''))
                            <div class="mt-3 flex items-center gap-3 rounded-md border border-gray-200 p-3">
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Logo' }}" class="h-12 w-12 rounded-md object-contain">
                                <span class="text-xs text-gray-500">Logo hiện tại</span>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="space-y-5 border-t border-gray-100 pt-8">
                <div>
                    <h3 class="text-base font-bold text-charcoal">Banner trang chủ</h3>
                    <p class="mt-1 text-sm text-gray-500">Cập nhật tiêu đề lớn, đoạn mô tả, phông màu và ảnh nền hiển thị đầu trang chủ.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="label">Nhãn phía trên tiêu đề</label>
                        <input type="text" name="hero_eyebrow" value="{{ old('hero_eyebrow', $settings['hero_eyebrow'] ?? 'Công ty TNHH Hồ Nam') }}" class="input" required>
                        @error('hero_eyebrow') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Tiêu đề chính lớn</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? 'Thi công cảnh quan xanh cho resort, khu đô thị và công trình công cộng') }}" class="input" required>
                        @error('hero_title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="label">Đoạn mô tả banner</label>
                        <textarea name="hero_description" rows="3" class="input" required>{{ old('hero_description', $settings['hero_description'] ?? 'Từ khảo sát, thiết kế đến thi công và bảo dưỡng, Hồ Nam đồng hành cùng chủ đầu tư để tạo nên những không gian xanh bền vững, giàu tính thẩm mỹ và dễ vận hành.') }}</textarea>
                        @error('hero_description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Màu nền</label>
                        <div class="flex items-center gap-3">
                            <input
                                type="color"
                                name="hero_background_color"
                                value="{{ old('hero_background_color', $settings['hero_background_color'] ?? '#0E3439') }}"
                                class="h-11 w-20 cursor-pointer rounded-md border border-gray-300 bg-white p-1"
                                required
                            >
                            <span class="text-sm text-gray-500">{{ old('hero_background_color', $settings['hero_background_color'] ?? '#0E3439') }}</span>
                        </div>
                        @error('hero_background_color') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Ảnh nền</label>
                        <input type="file" name="hero_background_image" accept="image/png,image/jpeg,image/webp" class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-md file:border-0 file:bg-gold file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gold/90">
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG hoặc WebP; tối đa 6 MB; tối thiểu 1200 × 600 px.</p>
                        @error('hero_background_image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                @if(filled($settings['hero_background_image'] ?? ''))
                    <div class="rounded-xl border border-gray-200 p-4">
                        <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($settings['hero_background_image']) }}" alt="Ảnh nền banner hiện tại" class="h-48 w-full rounded-lg object-cover">
                        <label class="mt-3 flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="remove_hero_background_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                            Xóa ảnh nền hiện tại và sử dụng màu đã chọn
                        </label>
                    </div>
                @endif
            </section>

            <section class="space-y-5 border-t border-gray-100 pt-8">
                <div>
                    <h3 class="text-base font-bold text-charcoal">Thông số nổi bật</h3>
                    <p class="mt-1 text-sm text-gray-500">Chỉnh sửa bốn thông số hiển thị ngay dưới banner trang chủ.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    @foreach([
                        1 => ['19+', 'Năm phát triển'],
                        2 => ['300+', 'Hạng mục bàn giao'],
                        3 => ['3', 'Miền phục vụ'],
                        4 => ['50+', 'Đối tác & chủ đầu tư'],
                    ] as $number => [$defaultValue, $defaultLabel])
                        <div class="rounded-xl border border-gray-200 p-4">
                            <p class="mb-3 text-sm font-semibold text-charcoal">Thông số {{ $number }}</p>
                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                                <div>
                                    <label class="label">Giá trị</label>
                                    <input type="text" name="stat_{{ $number }}_value" value="{{ old('stat_'.$number.'_value', $settings['stat_'.$number.'_value'] ?? $defaultValue) }}" class="input" required>
                                    @error('stat_'.$number.'_value') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                                <div class="sm:col-span-2">
                                    <label class="label">Nhãn</label>
                                    <input type="text" name="stat_{{ $number }}_label" value="{{ old('stat_'.$number.'_label', $settings['stat_'.$number.'_label'] ?? $defaultLabel) }}" class="input" required>
                                    @error('stat_'.$number.'_label') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="space-y-5 border-t border-gray-100 pt-8">
                <div>
                    <h3 class="text-base font-bold text-charcoal">Phần giới thiệu trên trang chủ</h3>
                    <p class="mt-1 text-sm text-gray-500">Cập nhật nhãn, tiêu đề, nội dung, các ý nổi bật và hình ảnh giới thiệu.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="label">Nhãn phía trên</label>
                        <input type="text" name="about_eyebrow" value="{{ old('about_eyebrow', $settings['about_eyebrow'] ?? 'Về Hồ Nam') }}" class="input" required>
                        @error('about_eyebrow') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="label">Tiêu đề</label>
                        <input type="text" name="about_title" value="{{ old('about_title', $settings['about_title'] ?? 'Từ nền tảng 1996 đến doanh nghiệp chính thức năm 2006') }}" class="input" required>
                        @error('about_title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="label">Đoạn mô tả thứ nhất</label>
                        <textarea name="about_description_1" rows="3" class="input" required>{{ old('about_description_1', $settings['about_description_1'] ?? 'Hồ Nam phát triển từ một tiền thân hình thành năm 1996, đến năm 2006 chính thức trở thành doanh nghiệp hoạt động chuyên sâu trong lĩnh vực cảnh quan, thi công cây xanh và duy tu bảo dưỡng.') }}</textarea>
                        @error('about_description_1') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="label">Đoạn mô tả thứ hai</label>
                        <textarea name="about_description_2" rows="3" class="input">{{ old('about_description_2', $settings['about_description_2'] ?? 'Chúng tôi tập trung vào các dự án resort, công viên ven biển, khu đô thị, khu công nghiệp và công trình công cộng, với tinh thần bền vững, linh hoạt và đúng tiến độ.') }}</textarea>
                        @error('about_description_2') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    @foreach([
                        1 => 'Khảo sát hiện trạng và lập giải pháp cảnh quan theo từng dự án',
                        2 => 'Thi công cây xanh, hệ tưới và cảnh quan mềm đồng bộ',
                        3 => 'Chăm sóc, bảo dưỡng dài hạn sau bàn giao',
                    ] as $number => $defaultPoint)
                        <div class="md:col-span-2">
                            <label class="label">Ý nổi bật {{ $number }}</label>
                            <input type="text" name="about_point_{{ $number }}" value="{{ old('about_point_'.$number, $settings['about_point_'.$number] ?? $defaultPoint) }}" class="input">
                            @error('about_point_'.$number) <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                    <div class="md:col-span-2">
                        <label class="label">Hình ảnh giới thiệu</label>
                        <input type="file" name="about_image" accept="image/png,image/jpeg,image/webp" class="block w-full text-sm text-gray-600 file:mr-4 file:rounded-md file:border-0 file:bg-gold file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-gold/90">
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG hoặc WebP; tối đa 4 MB; kích thước tối thiểu 600 × 300 px.</p>
                        @error('about_image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        @if(filled($settings['about_image'] ?? ''))
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($settings['about_image']) }}" alt="Hình giới thiệu hiện tại" class="mt-3 h-40 w-full rounded-xl object-cover">
                        @endif
                    </div>
                </div>
            </section>

            <section class="space-y-5 border-t border-gray-100 pt-8">
                <div>
                    <h3 class="text-base font-bold text-charcoal">Thanh liên hệ nổi</h3>
                    <p class="mt-1 text-sm text-gray-500">Cập nhật các liên kết và công tắc hiển thị cho thanh nổi ở cạnh phải website.</p>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label class="label">Hotline</label>
                        <input type="text" name="floating_phone" value="{{ old('floating_phone', $settings['floating_phone'] ?? '') }}" class="input">
                        @error('floating_phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Link Zalo</label>
                        <input type="text" name="floating_zalo" value="{{ old('floating_zalo', $settings['floating_zalo'] ?? '') }}" class="input">
                        @error('floating_zalo') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Link Facebook</label>
                        <input type="text" name="floating_facebook" value="{{ old('floating_facebook', $settings['floating_facebook'] ?? '') }}" class="input">
                        @error('floating_facebook') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Link tư vấn / hỏi đáp</label>
                        <input type="text" name="floating_chat" value="{{ old('floating_chat', $settings['floating_chat'] ?? '') }}" class="input">
                        @error('floating_chat') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="label">Badge giỏ hàng</label>
                        <input type="text" name="floating_cart_badge" value="{{ old('floating_cart_badge', $settings['floating_cart_badge'] ?? '') }}" class="input" placeholder="Ví dụ: 1">
                        @error('floating_cart_badge') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_bar" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_bar'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị toàn bộ thanh nổi</span>
                        <span class="block text-sm text-gray-500">Tắt mục này để ẩn hoàn toàn thanh liên hệ bên phải.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_cart" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_cart'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút giỏ hàng</span>
                        <span class="block text-sm text-gray-500">Hiển thị icon giỏ hàng kèm badge số lượng.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_zalo" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_zalo'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút Zalo</span>
                        <span class="block text-sm text-gray-500">Mở link chat Zalo đã cấu hình.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_phone" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_phone'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút hotline</span>
                        <span class="block text-sm text-gray-500">Nhấn để gọi trực tiếp số điện thoại.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_chat" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_chat'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút tư vấn</span>
                        <span class="block text-sm text-gray-500">Mở email hoặc link tư vấn nhanh.</span>
                    </span>
                </label>

                <label class="flex items-start gap-3 rounded-xl border border-gray-200 p-4">
                    <input type="checkbox" name="show_floating_facebook" value="1" class="mt-1 rounded border-gray-300 text-gold focus:ring-gold" @checked(($settings['show_floating_facebook'] ?? '0') === '1')>
                    <span>
                        <span class="block font-semibold text-charcoal">Hiển thị nút Facebook</span>
                        <span class="block text-sm text-gray-500">Mở trang Facebook doanh nghiệp.</span>
                    </span>
                </label>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" class="rounded-md border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Quay lại
                </a>
                <button type="submit" class="btn-primary">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
