<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Show the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index'); // Sesuaikan dengan lokasi file view
    }

    /**
     * Show the portfolio page.
     *
     * @return \Illuminate\View\View
     */
    public function portfolio()
    {
        $portfolioItems = [
            ['id' => 1, 'category' => 'App', 'title' => 'App 1', 'image' => 'masonry-portfolio-1.jpg'],
            ['id' => 2, 'category' => 'Card', 'title' => 'Product 1', 'image' => 'masonry-portfolio-2.jpg'],
            ['id' => 3, 'category' => 'Web', 'title' => 'Branding 1', 'image' => 'masonry-portfolio-3.jpg'],
            ['id' => 4, 'category' => 'App', 'title' => 'App 2', 'image' => 'masonry-portfolio-4.jpg'],
            ['id' => 5, 'category' => 'Card', 'title' => 'Product 2', 'image' => 'masonry-portfolio-5.jpg'],
            ['id' => 6, 'category' => 'Web', 'title' => 'Branding 2', 'image' => 'masonry-portfolio-6.jpg'],
            ['id' => 7, 'category' => 'App', 'title' => 'App 3', 'image' => 'masonry-portfolio-7.jpg'],
            ['id' => 8, 'category' => 'Card', 'title' => 'Product 3', 'image' => 'masonry-portfolio-8.jpg'],
            ['id' => 9, 'category' => 'Web', 'title' => 'Branding 3', 'image' => 'masonry-portfolio-9.jpg'],
        ];

        return view('frontend.portfolio', compact('portfolioItems'));
    }

    /**
     * Show the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('frontend.contact'); // Sesuaikan dengan lokasi file view
    }
}
