<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Elasticsearch\ClientBuilder;

/**
 * Description of EsController
 *
 * @author Administrator
 */
class EsController extends BaseController{
    //put your code here
    public function list(){
        echo "<pre>";
        $client = ClientBuilder::create()->build();
        print_r($client);
        echo 123;
    }
    
    public function setHosts(){
        echo "<pre>";
        $hosts = ['192.168.0.221:9200'];
        $client = ClientBuilder::create()->setHosts($hosts)->build();
        print_r($client);
    }
    
    public function setRetries(){
        echo "<pre>";
        $hosts = ['192.168.0.221:9200'];
        $client = ClientBuilder::create()
                ->setHosts($hosts)
                ->setRetries(0)                
                ->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'body' => [
                'query' => [
                    'match' => [
                        'testField' => 'abc'
                    ]
                ]
            ]
        ];
        try{
            $client->search($params);
        } catch (Elasticsearch\Common\Exceptions\Curl\CouldNotConnectToHost $e){
            echo 123;
            $previous = $e->getPrevious();
            if($previous instanceof Elasticsearch\Common\Exceptions\MaxRetriesException){
                echo "Max Retries";
            }
        }
        //print_r($client);
    }
}
