<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book1 = Book::create([
            'category_id'       => Category::where('name', 'رياده اعمال')->first()->id,
            'publisher_id'      => Publisher::where('name', 'بيت الكتب')->first()->id,
            'title'             => 'التوظيف عن بعد',
            'description'       => 'ما هو التوظيف عن بعد؟
                هو اتجاه ظهر حديثًا في سوق العمل، يسمح لأصحاب الشركات بتوظيف أشخاص محترفين يعملون خارج بيئة المكاتب التقليدية، من المنزل، أو المقهى، أو الشاطئ،
                أو مساحات العمل الجماعي… إلخ، ويستند إلى مفهوم أن مهام العمل لا تحتاج إلى القيام بها في مكان محدد ليتم تنفيذها
                بنجاح، يتواصل الموظف عن بعد مع أصحاب العمل والزملاء والعملاء عبر الهاتف، والبريد الإلكتروني، وغيرها من أدوات التواصل الرقمي وبرامج عقد الاجتماعات.' ,
            'publish_year'      => '2004' , 
            'number_of_pages'   => '300' ,
            'number_of_copies'  => '100',
            'isbn'              => '100000000',
            'price'             =>'23',
            'cover_image'       => 'images/covers/1.png' ,
        ]);
        $book1->authors()->attach(Author::where('name' , 'اسامه محمد')->first());

        $book1 = Book::create([
            'category_id'       => Category::where('name','التصميم')->first()->id,
            'publisher_id'      => Publisher::where('name', 'بيت الكتب')->first()->id,
            'title'             => 'مدخل الي تجربه المستخدم' ,
            'description'       => 'مدخل الي تجربه المستخدم' ,
            'publish_year'      => '2009' , 
            'number_of_pages'   => '400' ,
            'number_of_copies'  => '100',
            'isbn'              => '100000000',
            'price'             =>'23',
            'cover_image'       => 'images/covers/2.png' ,
        ]);
    $book1->authors()->attach(Author::where('name' , 'مصطفي محمحد')->first());

        $book1 = Book::create([
            'category_id'       => Category::where('name', 'التسويق والمبيعات')->first()->id,
            'publisher_id'      => Publisher::where('name', 'بيت الكتب')->first()->id,
            'title'             =>  "دليلك المختصر لبيع المنتجات الرقميه",
            'description'       => "دليلك المختصر لبيع المنتجات الرقميه",
            'publish_year'      => '2004' , 
            'number_of_pages'   => '300' ,
            'number_of_copies'  => '100',
            'isbn'              => '100000000',
            'price'             =>'23',
            'cover_image'       => 'images/covers/3.png' ,
        ]);
        $book1->authors()->attach(Author::where('name' , 'محمود خالد')->first());

        $book1 = Book::create([
            'category_id'       => Category::where('name','العمل الحر')->first()->id,
            'publisher_id'      => Publisher::where('name', 'بيت الكتب')->first()->id,
            'title'             => 'دليلك المختصر لبدء العمل عبر الانترنت',
            'description'       => 'دليلك المختصر لبدء العمل عبر الانترنت',
            'publish_year'      => '2010' , 
            'number_of_pages'   => '200' ,
            'number_of_copies'  => '100',
            'isbn'              => '100000000',
            'price'             =>'23',
            'cover_image'       => 'images/covers/4.png' ,
        ]);
        $book1->authors()->attach(Author::where('name' , 'خالد محمد')->first());

        $book1 = Book::create([
            'category_id'       => Category::where('name', 'التسويق والمبيعات')->first()->id,
            'publisher_id'      => Publisher::where('name', 'بيت الكتب')->first()->id,
            'title'             =>'الدليل المخصر لصفحات الهبوط',
            'description'       =>'الدليل المخصر لصفحات الهبوط',
            'publish_year'      => '2004' , 
            'number_of_pages'   => '300' ,
            'number_of_copies'  => '100',
            'isbn'              => '100000000',
            'price'             =>'23',
            'cover_image'       => 'images/covers/1.png' ,
        ]);
        $book1->authors()->attach(Author::where('name' , 'يوسف محمد')->first());
    }
}
