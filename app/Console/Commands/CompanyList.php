<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;

class CompanyList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:company-list';

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

        function combiner($array){
            return [ $array[0] => $array[1] ];
        }
        $crawler = Goutte::request('GET', 'http://www.nepalstock.com/company?_limit=1000');

        $companies = [];

        $config=[
            'company_id',
            'image_url',
            'name',
            'code',
            'type',
            'link',
        ];
        
        $profile = [
            'name'
        ];

        $crawler->filter('#company-list table tr')->each(function($node, $index) use ($config, &$companies){
            if($index < 2 || count($node->filter('td')) == 1){
                return;
            }

            $company = [];
            $node->filter('td')->each(function($tr, $index) use (&$company, $config){
                if($index == 1){
                    $img = $tr->filter('.company-logo');
                    if(count($img)){
                        $company[$config[$index]] = $img->attr('src');
                    }
                    return;
                }

                if($index == 5){
                    $img = $tr->filter('.icon-view');
                    if(count($img)){
                        $href = $img->attr('href');
                        $company[$config[$index]] = $href;
                        $crawler = Goutte::request('GET',$href);
                        $company['profile'] = array_filter(array_collapse($crawler->filter('#company-view .my-table tr')->each(function($node){
                            if(count($node->filter('td')) < 2){
                                return;
                            }
                            return combiner($node->filter('td')->each(function($node){
                                return trim($node->html());
                            }));
                        }))); 
                    }
                    return;
                }
                $company[$config[$index]] = trim($tr->html());
            });
            array_push($companies, $company);
        });

        collect($companies)->each(function($company){
            $subject = \App\Company::where('code', $company['code'])->firstOrNew([]);
            $subject->forceFill($company);
            $subject->save();
        });
    }
}
