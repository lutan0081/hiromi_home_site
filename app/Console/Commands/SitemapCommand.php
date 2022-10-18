<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //保存先
        $file = resource_path('views/sitemap.xml');
        //初期化
        $start_content = '<?xml version="1.0" encoding="UTF-8"?>'
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        \File::put($file,$start_content);
        
        // ｰｰｰｰｰｰｰｰｰｰｰｰｰURL欄ｰｰｰｰｰｰｰｰｰｰｰｰｰ
        // url_1
        $content = "<url>
            <loc>".route('/')."</loc>
            <lastmod>2021-06-02</lastmod>
            </url>";
        \File::append($file,$content);

        // 追加する場合は以下から
        // $content = "<url>
        // <loc>".route('/')."</loc>
        // <lastmod>2021-06-02</lastmod>
        // </url>";
        // \File::append($file,$content);

        // ｰｰｰｰｰｰｰｰｰｰｰｰｰURL欄ｰｰｰｰｰｰｰｰｰｰｰｰｰ

        //最後閉じタグが必要
        $end_content = '</urlset>';
        \File::append($file,$end_content);

        //本番環境のときは、Googleにピンを送る
        if(config('app.env') == 'production'){
            'https://www.google.com/ping?sitemap=https://https://hiromi-home.net/.jp/sitemap.xml';
        }
    }
}
