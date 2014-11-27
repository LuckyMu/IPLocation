<?php

/**
 * Geo Class
 * @author Lucky
 */
class Geo
{

    protected $api = "http://www.telize.com/geoip/%s";    //API address

    protected $properties = [];   //Array results

    public function __get($key){
        if(!empty($this->properties[$key])){
            return $this->properties[$key];
        }
    }

    /**
     * Query location through IP address
     * @param $ip string
     */
    public function query($ip)
    {
        $url = sprintf($this->api, $ip);
        $data = $this->getData($url);
        if(!empty($data)){
            $this->properties=json_decode($data,true);
        }
    }

    /**
     * Get Data From API
     * @param $url
     * @return string $output
     */
    protected function getData($url)
    {
        // Create curl resource
        $ch = curl_init();
        // Set url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Set maximum query time
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        // Return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);
        // Close curl resource to free up system resources
        curl_close($ch);

        if(strpos($output,'city')===false){
            return null;
        }
        return $output;
    }
}