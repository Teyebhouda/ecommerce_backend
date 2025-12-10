<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;

class SettingController extends Controller
{


    public function  index()
    {
        return response()->json(
            [
                "order_code_prefix" => getSetting('order_code_prefix')
            ]
        );
    }

    public function contactInfo()
    {
       return [
            "location" =>       getSetting('topbar_location'),
            "contact_number" => getSetting('navbar_contact_number'),
            "email" =>          getSetting('topbar_email'),
            "logo" =>           uploadedAsset(getSetting('navbar_logo')),
             ];
    }
    public function socialLinks()
    {
       return [
            "facebook" =>   getSetting('facebook_link'),
            "twitter" =>    getSetting('twitter_link'),
            "instagram" =>  getSetting('instagram_link'),
            "youtube" =>    getSetting('youtube_link'),
            "linkedin" =>   getSetting('linkedin_link'),
        ];
    }
    public function footerInfo()
    {
       return [
            "footer_about" =>       getSetting('footer_about'),
            "footer_address" =>     getSetting('footer_address'),
            "footer_email" =>       getSetting('footer_email'),
            "footer_phone" =>       getSetting('footer_phone'),
        ];
    }
    public function seoInfo()
    {
       return [
            "meta_title" =>         getSetting('meta_title'),
            "meta_description" =>   getSetting('meta_description'),
            "meta_keywords" =>      getSetting('meta_keywords'),
        ];
    }
    public function paymentInfo()
    {
       return [
            "paypal_mode" =>        getSetting('paypal_mode'),
            "paypal_client_id" =>   getSetting('paypal_client_id'),
            "paypal_secret" =>      getSetting('paypal_secret'),
            "stripe_key" =>         getSetting('stripe_key'),
            "stripe_secret" =>      getSetting('stripe_secret'),
        ];
    }
    

    public function sliderInfo()
{
    $sliders = [];

    if (getSetting('hero_sliders') != null) {
        $raw = json_decode(getSetting('hero_sliders'));

        // On transforme chaque slider
        foreach ($raw as $slider) {
            $slider->image_url = uploadedAsset($slider->image);
            $sliders[] = $slider;
        }
    }

    return $sliders;
}
 // Catégories Navbar
    public function navbarCategories()
    {
        $categories = [];
        if (getSetting('show_navbar_categories')) {
            $raw = getSetting('navbar_categories') ? json_decode(getSetting('navbar_categories')) : [];

            foreach ($raw as $cat) {
                $category = Category::find($cat);
                if ($category) {
                    $categories[] = [
                        "id" => $category->id,
                        "name" => $category->collectLocalization('name'),
                        "image" => uploadedAsset($category->collectLocalization('thumbnail_image')),
                        "slug" => $category->slug,
                    ];
                }
            }
        }

        return response()->json($categories);
    }
    public function navbarPages()
    {
        // This function can be implemented to return navbar pages if needed
        $pages = [];
        if( getSetting('show_navbar_pages')) {
            $raw = getSetting('navbar_pages') ? json_decode(getSetting('navbar_pages')) : [];

            foreach ($raw as $pageId) {
                $page = Page::find($pageId);
                if ($page) {
                    $pages[] = [
                        "id" => $page->id,
                        "title" => $page->collectLocalization('title'),
                        "slug" => $page->slug,
                    ];
                }
            }
        }
    }
}