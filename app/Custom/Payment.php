<?php
namespace App\Custom;

use Exception;


class Payment
    {
        public function __construct()
        {
           // $this->stripe = new Stripe(env('STRIPE_API_KEY', ''), env('STRIPE_API_VER', ''));

        }

        public function create_payment($userData)
        {
            // $charge = $this->stripe->charges()->create([
            //     'customer' => 'cus_4EBumIjyaKooft',
            //     'currency' => 'USD',
            //     'amount'   => 50.49,
            // ]);



            // try {


            // } catch (Exception $e) {
            //     // Zorunlu parametrelerden bir ve daha fazlası eksik

            // }
        }


    }

