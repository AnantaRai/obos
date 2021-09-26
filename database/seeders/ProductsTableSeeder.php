<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "category_id" => 1,
            "name" => "Birthday Cake",
            "slug" => "birthday-cake",
            "description" => "Our bestselling Birthday Cake is inspired by the supermarket stuff we grew up with, and it took us over two years to get it just right: three tiers of rainbow-flecked vanilla Birthday cake layered with creamy Birthday frosting, crunchy Birthday crumbs, and rainbow sprinkles. Tastes like childhood.",
            "price" => 3000,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 1,
            "name" => "Chocolate Birthday Cake",
            "slug" => "chocolate-birthday-cake",
            "description" => "The classic Birthday Cake, but make it chocolate. Decadent chocolate cake plus chocolate chips, layered with creamy Birthday frosting, crunchy Birthday crumbs, and rainbow sprinkles.",
            "price" => 4000,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 1,
            "name" => "Pumpkin Cake",
            "slug" => "pumpkin-cake",
            "description" => "When it gets chilly outside and cozy inside, it's pumpkin time. This seasonal stunner is back by popular demand in all its glory: layers of cinnamon spice cake with rich pumpkin frosting, gooey dulche de leche drizzle, crunchy milk crumbs, and salty toasted pepitas.",
            "price" => 2000,
        ]);

        Product::create([
            "category_id" => 4,
            "name" => "B'day Truffle Dozen Box",
            "slug" => "bday-truffle-dozen-box",
            "description" => "We rolled all the childhood flavor of our signature cake into a single bite — no utensils needed. Made from Birthday Cake, these rainbow-flecked, vanilla-happy goodies are coated in a barely-there white chocolate shell and rolled in B'Day sand.

            Includes one gift box of 12 B'Day Truffles.",
            "price" => 800,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 4,
            "name" => "Chocolate B'day Truffle Dozen Box",
            "slug" => "chocolate-bday-truffle-dozen-box",
            "description" => "Like eating the batter and the cake all at once. Made from Chocolate Birthday Cake, these one-bite wonders are loaded with rainbow sprinkles, then coated in a barely-there chocolate shell and a dusting of chocolate B'Day sand.

            Includes one gift box of 12 Chocolate B'Day Truffles.",
            "price" => 800,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 3,
            "name" => "Dozen Assorted Cookie Tin",
            "slug" => "dozen-assorted-cookie-tin",
            "description" => "Sometimes the correct answer is “one of each,” but we think “two of each” is right the rest of the time. Available by popular request, the Dozen Assorted doubles down on flavor from fruity, corny, chewy, and crispy to fudgy and salty-sweet — all in a slick windowed tin for an extra-special cookie delivery.",
            "price" => 800,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 3,
            "name" => "Assorted Cookie Tin",
            "slug" => "assorted-cookie-tin",
            "description" => "Sometimes the correct answer is one of each but we think two of each is right the rest of the time. You’ve got the right to refuse to choose, so we put together these cookie cornucopias covering all the bases: fruity, corny, chewy, crispy, fudgy, and salty-sweet.",
            "price" => 600,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 3,
            "name" => "Cornflake Chocolate Chip Cookie Tin",
            "slug" => "cornflake-chocolate-chip-cookie-tin",
            "description" => "Our crunchy, chewy riff on the classic chocolate chip cookie, packed full of caramelized cornflakes and gooey marshmallows in a deep vanilla base.  6 Ct. Tin contains 6 individually wrapped cookies. 12 Ct. Tin contains 12 individually wrapped cookies.",
            "price" => 500
        ]);

        Product::create([
            "category_id" => 2,
            "name" => "Milk Bar Pie",
            "slug" => "milk-bar-pie",
            "description" => "The iconic dessert was a happy accident born in the kitchen of wd~50 when there wasn’t much in the fridge. When Tosi served the simple, gooey pie (inspired by southern Chess Pie) at staff dinner, she never anticipated the reaction it got — and a signature pie was born! With a sticky, buttery, salty-sweet filling in a hearty oat cookie crust, Milk Bar Pie has been a Tosi favorite since the beginning",
            "price" => 1000,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 2,
            "name" => "The Cheerleader",
            "slug" => "the-cheerleader",
            "description" => "Everyone needs a little encouragement sometimes, and we’ve found that dessert does a pretty amazing job. A whole Milk Bar Pie and a dozen cookies of all kinds make anything feel possible.",
            "price" => 800,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 2,
            "name" => "The Sweet Spot",
            "slug" => "the-sweet-spot",
            "description" => "Not too big, but definitely not too small — you’ll always hit The Sweet Spot with this tempting bundle of shareable, snackable Milk Bar classics",
            "price" => 4000,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 3,
            "name" => "Candy Bar Snap Dozen Tin",
            "slug" => "candy-bar-snap-dozen-tin",
            "description" => "Once upon a time, there was a Milk Bar creation called Candy Bar Pie. It was chocolatey, it was caramel-ly, it was pretzel-y, it was peanut-buttery, and it was very, very tasty — and now, we've brought it back in the form of a Snap. What's inside: a crisp chocolate cookie topped with peanut butter caramel and salty mini pretzels, all dunked in milk chocolate.",
            "price" => 2500,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 4,
            "name" => "Gluten Free B'day Truffle Dozen Box",
            "slug" => "gluten-free-bday-truffle-dozen-box",
            "description" => "We rolled all the childhood flavor of our signature cake into a single bite — no utensils needed. No gluten needed, either. Made from Gluten-Free Birthday Cake, these rainbow-flecked, vanilla-happy, gluten-free goodies are coated in a barely-there white chocolate shell and rolled in B'Day sand.
            Includes one gift box of 12 B'Day Truffles.",
            "price" => 800
        ]);

        Product::create([
            "category_id" => 1,
            "name" => "Gluten Free Birthday Cake",
            "slug" => "gluten-free-birthday-cake",
            "description" => "Our classic Birthday Cake, inspired by the supermarket stuff we grew up with — now made gluten-free! Three tiers of rainbow-flecked, gluten-free vanilla B'Day cake layered with creamy B'Day frosting and crunchy gluten-free B'Day crumbs. Tastes like childhood.",
            "price" => 3000,
            "featured" => true
        ]);

        Product::create([
            "category_id" => 4,
            "name" => "Pumpkin Truffle Dozen Box",
            "slug" => "pumpkin-truffle-dozen-box",
            "description" => "Big pumpkin flavor in one tasty bite. We rolled our favorite Fall cake (the Pumpkin Dulce de Leche Cake, of course) into the rich, fudgy treat of the season: cozy cinnamon spice cake studded with butterscotch chips, coated in a thin layer of white chocolate and rolled in cinnamon sand.
            Includes one gift box of 12 Pumpkin Dulce de Leche Truffles.",
            "price" => 2000
        ]);

        Product::create([
            "category_id" => 3,
            "name" => "The Cookie Faves Tin",
            "slug" => "the-cookie-faves-tin",
            "description" => "Big pumpkin flavor in one tasty bite. We rolled our favorite Fall cake (the Pumpkin Dulce de Leche Cake, of course) into the rich, fudgy treat of the season: cozy cinnamon spice cake studded with butterscotch chips, coated in a thin layer of white chocolate and rolled in cinnamon sand.
            Includes one gift box of 12 Pumpkin Dulce de Leche Truffles.",
            "price" => 1500,
            "featured" => true
        ]);
    }
}
