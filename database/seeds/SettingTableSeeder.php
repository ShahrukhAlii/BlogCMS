<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $setting = new Setting;
        $setting->site_name='Sample blog ';
        $setting->contact_number='123-445-5656';
        $setting->contact_email='sample@sample.com';
        $setting->address='Address -1 ...';
        $setting->copyright_text= 'copyright sample';
        $setting->save();

    }
}
