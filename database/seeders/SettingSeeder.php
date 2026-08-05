<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Hồ Nam Landscape',
            'site_logo' => null,
            'hero_background_color' => '#0E3439',
            'hero_background_image' => null,
            'hero_eyebrow' => 'Công ty TNHH Hồ Nam',
            'hero_title' => 'Thi công cảnh quan xanh cho resort, khu đô thị và công trình công cộng',
            'hero_description' => 'Từ khảo sát, thiết kế đến thi công và bảo dưỡng, Hồ Nam đồng hành cùng chủ đầu tư để tạo nên những không gian xanh bền vững, giàu tính thẩm mỹ và dễ vận hành.',

            'stat_1_value' => '19+',
            'stat_1_label' => 'Năm phát triển',
            'stat_2_value' => '300+',
            'stat_2_label' => 'Hạng mục bàn giao',
            'stat_3_value' => '3',
            'stat_3_label' => 'Miền phục vụ',
            'stat_4_value' => '50+',
            'stat_4_label' => 'Đối tác & chủ đầu tư',
            'about_eyebrow' => 'Về Hồ Nam',
            'about_title' => 'Từ nền tảng 1996 đến doanh nghiệp chính thức năm 2006',
            'about_description_1' => 'Hồ Nam phát triển từ một tiền thân hình thành năm 1996, đến năm 2006 chính thức trở thành doanh nghiệp hoạt động chuyên sâu trong lĩnh vực cảnh quan, thi công cây xanh và duy tu bảo dưỡng.',
            'about_description_2' => 'Chúng tôi tập trung vào các dự án resort, công viên ven biển, khu đô thị, khu công nghiệp và công trình công cộng, với tinh thần bền vững, linh hoạt và đúng tiến độ.',
            'about_point_1' => 'Khảo sát hiện trạng và lập giải pháp cảnh quan theo từng dự án',
            'about_point_2' => 'Thi công cây xanh, hệ tưới và cảnh quan mềm đồng bộ',
            'about_point_3' => 'Chăm sóc, bảo dưỡng dài hạn sau bàn giao',
            'about_image' => null,
            'floating_phone' => '064.358.6494',
            'floating_zalo' => 'https://zalo.me/0643586494',
            'floating_facebook' => 'https://facebook.com/cayxanhhonam',
            'floating_chat' => 'mailto:cayxanhhonam.vt@gmail.com',
            'show_floating_cart' => '0',
            'show_floating_zalo' => '1',
            'show_floating_phone' => '1',
            'show_floating_chat' => '1',
            'show_floating_facebook' => '1',
            'floating_cart' => '1',
            'floating_cart_badge' => '1',
            'show_floating_bar' => '1',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
