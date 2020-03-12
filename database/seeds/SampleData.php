<?php

namespace Database\Seeds;

use App\Abstracts\Model;
use App\Models\Banking\Account;
use App\Models\Common\Contact;
use App\Models\Common\Item;
use App\Models\Purchase\Bill;
use App\Models\Sale\Invoice;
use App\Models\Setting\Category;
use Illuminate\Database\Seeder;

class SampleData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::reguard();

        config(['mail.driver' => 'log']);

        $count = (int) $this->command->option('count');
        $acc_count = ($count <= 10) ? $count : 10;

        $this->command->info('Creating sample data...');

        $bar = $this->command->getOutput()->createProgressBar(6);
        $bar->setFormat('verbose');

        $bar->start();

        factory(Contact::class, $count)->create();
        $bar->advance();

        factory(Category::class, $count)->create();
        $bar->advance();

        factory(Item::class, $count)->create();
        $bar->advance();

        factory(Account::class, $acc_count)->create();
        $bar->advance();

        factory(Bill::class, $count)->create();
        $bar->advance();

        factory(Invoice::class, $count)->create();
        $bar->advance();

        $bar->finish();

        $this->command->info('');
        $this->command->info('Sample data created.');

        Model::unguard();
    }
}
