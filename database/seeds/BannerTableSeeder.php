<?php

use App\Banner;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $banner = new Banner();
        $banner->slider1 = "alvinsmakeup6431.jpg";
        $banner->slider2 = "alvinsmakeup631.jpg";
        $banner->slider3 = "alvinsmakeup9746.jpg";

        $banner->banner1 = "alvinsmakeup3053.jpg";
        $banner->banner2 = "alvinsmakeup3960.jpg";
        $banner->banner3 = "alvinsmakeup2774.jpg";

        $banner->topic1 = "Professional Skin Whitening Cream of 2019";
        $banner->topic2 = "Argan Oil A Beauty Secret Dating Back Over";
        $banner->topic3 = "Give a Hand To Make The better world";

        $banner->body1 = "You can always trust us for the very best";
        $banner->body2 = "You can trust for the very best";
        $banner->body3 = "You can trust for the very best";

       $banner->save(); 

    }
}
