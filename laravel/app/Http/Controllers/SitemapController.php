<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categories;
use App\lessons;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/carapesan'))
            ->add(Url::create('/petunjuk'))
            ->add(Url::create('/member/package'))
            ->add(Url::create('/kontak'));

        lessons::all()->each(function (lessons $lessons) use ($sitemap) {
            $sitemap->add(Url::create("/lessons/{$lessons->slug}"));
        });

        categories::all()->each(function (categories $categories) use ($sitemap) {
            $sitemap->add(Url::create("/lessons/category/{$categories->title}"));
        });

        $sitemap->writeToFile(storage_path('sitemap.xml'));
    }
}
