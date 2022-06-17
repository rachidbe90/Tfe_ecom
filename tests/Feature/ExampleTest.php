<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    // frontend test unite
    /**
     * @test
     */
    public function homeisok()
    {
//        $this->withExceptionHandling();
        $response = $this->get('/');
        $response
            ->assertSuccessful()
            ->assertViewIs('frontend.index');
    }

    /**
     * @test
     */
    public function shopIsOk()
    {
//        $this->withExceptionHandling();
        $response = $this->get('/shop');
        $response
            ->assertSuccessful()
            ->assertViewIs('frontend.pages.product.shop');
    }

    /**
     * @test
     */
    public function userAuthIsOk()
    {
//        $this->withExceptionHandling();
        $response = $this->get('/user/auth');
        $response
            ->assertSuccessful()
            ->assertViewIs('frontend.auth.auth');
    }

    /**
     * @test
     */
    public function cartIsOk()
    {
//        $this->withExceptionHandling();
        $response = $this->get('cart');
        $response
            ->assertSuccessful()
            ->assertViewIs('frontend.pages.cart.index');
    }

    /**
     * @test
     */
    public function wishlistIsOk()
    {
//        $this->withExceptionHandling();
        $response = $this->get('/wishlist');
        $response
            ->assertSuccessful()
            ->assertViewIs('frontend.pages.wishlist');
    }

    /**
     * @test
     */
    public function compareIsOk()
    {
//        $this->withExceptionHandling();
        $response = $this->get('/compare');
        $response
            ->assertSuccessful()
            ->assertViewIs('frontend.pages.compare');
    }

    /**
     * @test
     */
    public function autosearchIsOk()
    {
//        $this->withExceptionHandling();
        $response = $this->get('/autosearch');
        $response->assertSuccessful();
    }
}
