<?php

class Config{

    private $client = "AQMvz-l3XHRLi2aHA0oSANfks5l-VwwS40Los6JPnGCLFceyXAN1LTnharyA0s5GrsFjYhh2iNxpeNrj";
    private $secret = "EDjYV3HndXdvNAbTYRcmSX9oZBHYFzqciEaasVUJd4Huez84IJCmtKZ1N_IM4Vs6Gh3BE_CX0NYxf4eD";

    public function getClient(){
        return $this->client;
    }
    public function getSecret(){
        return $this->secret;
    }
}
