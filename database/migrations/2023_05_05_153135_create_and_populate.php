<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAndPopulate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("customers", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("user")->unique();
            $table->string("password");
            $table->integer("loyalty")->default(0);
            $table->string("session")->nullable();
        });

        DB::table("customers")->insert([
            [
                "name" => "Fei Fei Li",
                "user" => "feifeili",
                // "password" => bcrypt("password"),
                "password" => hash("sha256", "password"),
                "loyalty" => 50,
            ],
            [
                "name" => "Vico Lomar",
                "user" => "vicolomar",
                // "password" => bcrypt("password"),
                "password" => hash("sha256", "password"),
                "loyalty" => 350,
            ],
        ]);

        Schema::create("coffees", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("category");
            $table->text("description");
            $table->integer("price");
            $table->string("imageUrl")->nullable();
        });

        DB::table("coffees")->insert([
            [
                "name" => "Ristretto",
                "category" => "Espresso",
                "description" => "A short shot of espresso with a rich and intense flavor.",
                "price" => 43000,
                "imageUrl" => "ristretto.jpg",
            ],
            [
                "name" => "Lungo",
                "category" => "Espresso",
                "description" => "A long shot of espresso with a milder flavor and more volume.",
                "price" => 33000,
                "imageUrl" => "lungo.jpg",
            ],
            [
                "name" => "Classic Cappuccino",
                "category" => "Cappuccino",
                "description" => "A traditional Italian coffee drink made with equal parts espresso, steamed milk, and milk foam.",
                "price" => 45000,
                "imageUrl" => "classic.jpg",
            ],
            [
                "name" => "Caramel Cappuccino",
                "category" => "Cappuccino",
                "description" => "A sweet variation of a cappuccino, made with caramel syrup and topped with whipped cream and caramel drizzle.",
                "price" => 49000,
                "imageUrl" => "caramel.jpg",
            ],
            [
                "name" => "Vanilla Latte",
                "category" => "Latte",
                "description" => "A creamy and sweet coffee drink made with espresso, steamed milk, and vanilla syrup.",
                "price" => 48000,
                "imageUrl" => "vanilla.jpg",
            ],
            [
                "name" => "Hazelnut Latte",
                "category" => "Latte",
                "description" => "A nutty and flavorful coffee drink made with espresso, steamed milk, and hazelnut syrup.",
                "price" => 33000,
                "imageUrl" => "hazelnut.jpg",
            ],
            [
                "name" => "Black Cold Brew",
                "category" => "Cold Brew",
                "description" => "A smooth and strong coffee drink made by steeping coffee grounds in cold water for an extended period of time.",
                "price" => 39000,
                "imageUrl" => "black.jpg",
            ],
            [
                "name" => "Mint Mocha Cold Brew",
                "category" => "Cold Brew",
                "description" => "A refreshing and chocolatey cold brew coffee with a hint of mint flavor, perfect for warm weather.",
                "price" => 32000,
                "imageUrl" => "mint.jpg",
            ],
        ]);

        Schema::create("transactions", function (Blueprint $table) {
            $table->id();
            $table->integer("customerId");
            $table->integer("coffeeId");
            $table->integer("price");
            $table->timestamp("timestamp")->useCurrent();
            $table->foreign("customerId")->references("id")->on("customers")->onDelete("cascade");
            $table->foreign("coffeeId")->references("id")->on("coffees")->onDelete("cascade");
        });

        $vicoLomar = DB::table('customers')->where('name', 'Vico Lomar');
        $ristretto = DB::table('coffees')->where('name', 'Ristretto');

        // Insert 3 transactions for Vico Lomar purchasing Ristretto coffee on different dates
        DB::table('transactions')->insert([
            [
                'customerId' => $vicoLomar->value("id"),
                'coffeeId' => $ristretto->value("id"),
                'price' => 43000,
                'timestamp' => '2023-03-19',
            ],
            [
                'customerId' => $vicoLomar->value("id"),
                'coffeeId' => $ristretto->value("id"),
                'price' => 43000,
                'timestamp' => '2023-03-20',
            ],
            [
                'customerId' => $vicoLomar->value("id"),
                'coffeeId' => $ristretto->value("id"),
                'price' => 43000,
                'timestamp' => '2023-03-21',
            ],
        ]);

        $feiFeiLi = DB::table('customers')->where('name', 'Fei Fei Li');
        $lungo = DB::table('coffees')->where('name', 'Lungo');
        $classic = DB::table('coffees')->where('name', 'Classic Cappuccino');

        // Insert 3 transactions for Vico Lomar purchasing Ristretto coffee on different dates
        DB::table('transactions')->insert([
            [
                'customerId' => $feiFeiLi->value("id"),
                'coffeeId' => $lungo->value("id"),
                'price' => 33000,
                'timestamp' => '2023-03-18',
            ],
            [
                'customerId' => $feiFeiLi->value("id"),
                'coffeeId' => $classic->value("id"),
                'price' => 45000,
                'timestamp' => '2023-03-19',
            ],
            [
                'customerId' => $feiFeiLi->value("id"),
                'coffeeId' => $classic->value("id"),
                'price' => 45000,
                'timestamp' => '2023-03-21',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("customers");
        Schema::dropIfExists("coffees");
        Schema::dropIfExists("transactions");
    }
}
