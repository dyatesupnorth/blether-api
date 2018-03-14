<?php
/**
 * Created by PhpStorm.
 * User: master-d
 * Date: 11/01/15
 * Time: 15:08
 */

class DatabaseSeeder extends Seeder {
    public function run()
    {
        Eloquent::unguard();

        // call our class and run our seeds
        $this->call('BletherAppSeeder');
        $this->command->info('blether seeds finished.'); // show information in the command line after everything is run
    }
} 