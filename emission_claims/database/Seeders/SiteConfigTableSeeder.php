<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SiteConfig;

class SiteConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site_config_array = array (
            array(1,"TABLET_DEFAULT_TRAFFIC_MDGA","HFDC_V1",""),
            array(2,"MOBILE_DEFAULT_TRAFFIC_MDGA","HFDC_V1",""),
            array(3,"TABLET_DEFAULT_TRAFFIC_MDGA","HFDC_V1",""),
            array(4,"DESKTOP_DEFAULT_URL_MDGA","HFDC_V1",""),
            array(5,"MOBILE_DEFAULT_URL_MDGA","HFDC_V1",""),
            array(6,"TABLET_DEFAULT_URL_MDGA","HFDC_V1",""),
            array(7,"questionnaire 1","50","questionnaire"),
            array(8,"questionnaire 2","50","questionnaire")
        );
        foreach($site_config_array as $key => $value) {
            SiteConfig::create([
                'id'           => $value[0],
                'config_title' => $value[1],
                'config_value' => $value[2],
                'config_info' => $value[3]
            ]);
        }
    }
}
