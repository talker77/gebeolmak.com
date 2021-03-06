<?php

namespace Database\Seeders;


use App\Models\Ayar;
use Illuminate\Database\Seeder;

class AyarlarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $config = [
            'title'       => 'Gebe Olmak',
            'desc'        => 'Gebe olmak sitesi hakkında açıklama buraya gelecek.',
            'domain'      => 'http://gebeolmak.com',
            'logo'        => 'logo.png',
            'footer_logo' => 'footer_logo.png',
            'icon'        => 'icon.png',
            'keywords'    => 'gebe,gebe olmak,hamilelik',
            'footer_text' => 'Lorem ipsum dolor sit amet, consectetur adipis cing elit, sed do eiusmod tempor incididunt ut labore et dolore magna ali qua. Ut enim ad veniam, quis no strud exercitation, eiusmod tempor',
            'mail'        => 'info@gebeolmak.com',
            'adres'       => 'Adres bilgileri',
            'active'      => 1,
            'lang'        => config('admin.default_language'),
            'phone'       => '0531 123 45 67' ,
            'twitter' => 'http://twitter.com',
            'facebook' => 'http://facebook.com',
            'youtube' => 'http://youtube.com',
            'instagram' => 'http://instagram.com',
            'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tincidunt lacinia luctus. Cras ultrices dui sed nisi rutrum laoreet. Aliquam vulputate sollicitudin urna at ultricies. Phasellus at fermentum justo. Pellentesque massa justo, aliquet a eleifend sit amet, lobortis sit amet quam. Duis placerat enim non tortor eleifend consectetur. Cras massa ipsum, tristique a scelerisque at, volutpat ut nisi. Nunc in libero eu eros mattis convallis. Nam ut mauris in mi fringilla efficitur.

Nulla tempus dui eget euismod pellentesque. Praesent eget lectus non ante consectetur dignissim. Vivamus eget hendrerit nulla, eget tempor urna. Sed varius faucibus justo. Pellentesque ultricies elementum nisl, sed convallis quam. Suspendisse potenti. Etiam accumsan nunc ac augue luctus, in dictum elit tincidunt. Integer dapibus ullamcorper tellus, vitae gravida nulla mattis nec. Maecenas vitae velit sit amet ipsum lobortis ornare. Maecenas egestas tellus eu arcu faucibus pharetra. Ut rhoncus mollis dui, sit amet euismod nulla facilisis quis. Ut lorem sem, pellentesque sed mi nec, consequat pellentesque nisi. Donec maximus augue nec purus volutpat, at euismod erat convallis. Suspendisse ornare ipsum ligula, ac egestas arcu maximus ac.

Nunc aliquet dolor id velit accumsan sollicitudin. Phasellus in tellus lacus. Etiam facilisis nunc in ligula eleifend suscipit. Integer ut porta leo, eget consequat justo. Morbi at quam rutrum, maximus elit a, tincidunt augue. Sed ullamcorper aliquet ornare. Donec vitae quam sed risus elementum pulvinar. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam varius blandit massa, venenatis scelerisque quam volutpat ultrices. Vestibulum faucibus sem rutrum aliquam vehicula. Cras vel malesuada lorem. Pellentesque vel molestie enim.

Pellentesque efficitur ligula felis, a auctor mauris ornare nec. Nulla dignissim eleifend leo, vitae dapibus velit aliquam mattis. Nulla et orci tincidunt, facilisis ligula gravida, tincidunt quam. Pellentesque dolor orci, imperdiet ut euismod a, ornare et velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ut tincidunt nisi. Quisque hendrerit semper lacus quis dignissim. Mauris facilisis fringilla quam ac vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus consequat sem et massa posuere vehicula. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus a magna velit. Integer nec leo quis eros varius placerat ut eget magna.

Sed risus nunc, ullamcorper id aliquam cursus, tempor nec odio. Nam posuere nunc tortor, at malesuada erat feugiat a. Sed nunc sapien, gravida eget pharetra sit amet, pulvinar quis erat. Curabitur pellentesque a lorem vitae viverra. Aliquam malesuada ante leo, ut hendrerit nisi fermentum eu. Curabitur cursus orci eu lorem eleifend consequat. Nullam consequat vestibulum euismod.'
        ];

        foreach (Ayar::activeLanguages() as $language) {
            $newConfig = $config;
            $newConfig['lang'] = $language[0];
            $newConfig['cargo_price'] = random_int(1, 5) * 10;
            $newConfig['title'] =$config['title'];
            $data = Ayar::updateOrCreate([
                'lang' => $language[0],
            ], $newConfig);
            Ayar::setCache($data, $language[0]);
        }
    }
}
