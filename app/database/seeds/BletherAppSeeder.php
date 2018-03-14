<?php

/**
 * Created by PhpStorm.
 * User: master-d
 * Date: 11/01/15
 * Time: 15:11
 */
class BletherAppSeeder extends Seeder
{
    public function run()
    {

        // clear our database ------------------------------------------
        DB::table('users')->delete();
        DB::table('user_friends')->delete();
        DB::table('blethers')->delete();
        DB::table('comments')->delete();

        // seed our bears table -----------------------

        User::create(array(
            'firstname' => 'Dave',
            'lastname' => 'Yates',
            'email' => 'dyates.upnorth@gmail.com',
            'password' => Hash::make('maeson07'),
            'image' => 'anon_user.png',
        ));

        User::create(array(
            'firstname' => 'Erin',
            'lastname' => 'Foulis',
            'email' => 'erinfoulis@yahoo.com',
            'password' => Hash::make('maeson07'),
            'image' => 'other_user.png',
        ));

        User::create(array(
            'firstname' => 'Maeson',
            'lastname' => 'Yates',
            'email' => 'maesonyates@gmail.com',
            'password' => Hash::make('maeson07'),
            'image' => 'other_user.png',
        ));
        User::create(array(
            'firstname' => 'Steven',
            'lastname' => 'Roy',
            'email' => 'pop@gmail.com',
            'password' => Hash::make('maeson07'),
            'image' => 'other_user.png',
        ));
        User::create(array(
            'firstname' => 'Linda',
            'lastname' => 'Mellor',
            'email' => 'lins@live.co.uk',
            'password' => Hash::make('maeson07'),
            'image' => 'other_user.png',
        ));
        User::create(array(
            'firstname' => 'Lance',
            'lastname' => 'Mellor',
            'email' => 'mellor32@gmail.com',
            'password' => Hash::make('maeson07'),
            'image' => 'other_user.png',
        ));
        User::create(array(
            'firstname' => 'Louise',
            'lastname' => 'Yates',
            'email' => 'laweezeyates@gmail.com',
            'password' => Hash::make('maeson07'),
            'image' => 'other_user.png',
        ));
        User::create(array(
            'firstname' => 'James',
            'lastname' => 'Southgate',
            'email' => 'southgate@gmail.com',
            'password' => Hash::make('maeson07'),
            'image' => 'other_user.png',
        ));
        User::create(array(
            'firstname' => 'John Yates',
            'lastname' => 'Yates',
            'email' => 'johnyates@gmail.com',
            'password' => Hash::make('maeson07'),
            'image' => 'other_user.png',
        ));

        $this->command->info('The users are alive!');

        //create relationships

        Friend::create(array(
            'user_id' => 1,
            'friend_id' => 2
        ));

        Friend::create(array(
            'user_id' => 1,
            'friend_id' => 5
        ));

        Friend::create(array(
            'user_id' => 1,
            'friend_id' => 7
        ));

        Friend::create(array(
            'user_id' => 1,
            'friend_id' => 3
        ));

        // seed our blethers table ---------------------

        $blether1 = Blether::create(array(
            'user_id' => 1,
            'subject' => 'First Blether'
        ));
        $blether2 = Blether::create(array(
            'user_id' => 1,
            'subject' => 'Daves second Blether'
        ));
        $blether3 = Blether::create(array(
            'user_id' => 2,
            'subject' => 'First Blether'
        ));
        $blether4 = Blether::create(array(
            'user_id' => 2,
            'subject' => 'Erins Second Blether'
        ));
        $blether5 = Blether::create(array(
            'user_id' => 3,
            'subject' => 'Maesons First Blether'
        ));


        //seed comments table -----------------

         Comment::create(
            array(
                'blether_id' => 1,
                'user_id' => 1,
                'content' => 'first comment on daves first blether'

            ));

        $tag1 = Tag::create(
            array(
                'tag' => 'excited',
                'tagFriendly' => '#excited'

            ));

        $tag1->blethers()->attach($blether1->_id);


        /*$bookGE = Book::create(array(
            'title' => 'Great Expectations',
            'author' => 'Charles Dickens'
        ));
        $bookNF = Book::create(array(
            'title' => 'Night Film',
            'author' => 'Marisha Pessl'
        ));
        $bookJE = Book::create(array(
            'title' => 'Jane Eyre',
            'author' => 'Charlotte Bronty'
        ));
        $bookM = Book::create(array(
            'title' => 'Misery',
            'author' => 'Stephen King'
        ));
        $bookOT = Book::create(array(
            'title' => 'Odd Thomas',
            'author' => 'Dean Koontz'
        ));*/
        // link our bears to picnics ---------------------
        // for our purposes we'll just add all bears to both picnics for our many to many relationship
//        $userDave->blethers()->associate($blether1);
        /*$userDave->books()->attach($bookOT->id);
        $userDave->books()->attach($bookM->id);
        $userDave->books()->attach($bookJP->id);
        $userErin->books()->attach($bookJP->id);
        $userErin->books()->attach($bookGE->id);
        $userErin->books()->attach($bookNF->id);
        $userMaeson->books()->attach($bookJP->id);
        $userMaeson->books()->attach($bookGE->id);
        $userMaeson->books()->attach($bookM->id);*/

        $this->command->info('Much Read, So Books');

    }
}