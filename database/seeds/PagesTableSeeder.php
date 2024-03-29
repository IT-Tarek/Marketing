<?php
use App\Models\Page;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

       
        Page::create([
            'title'         => 'About-us',

            'description'   => "  موقع شام لبيع وشراء المنتجات سنعمل علي زيادة ظهور مؤسستك عبر الانترنت وجذب الزوار إلى  موقع الويب الخاص بك   ", 
            'status'        => 1,

            'comment_able'  => 0,

            'product_type'  => 'page',

            'user_id'       => 1,

            'category_id'   => 1,
        ]);



   
     

    }
}

