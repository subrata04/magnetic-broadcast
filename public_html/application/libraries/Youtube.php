<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @file system/application/libraries/Youtube_Lib.php
* @version 1.1
* @author Maxime
*/
class Youtube{
    protected $url = 'http://gdata.youtube.com/feeds/api/videos?';
    protected $a_options;
    private $cache_life = 7200; // 2 hours

    function __construct(){
        $this->a_options = array();
    }

    /**
     * Return an array of results
     *
     * @param Boolean $b_cache
     * @return Array
     */
    public function result_array($b_cache=FALSE){
        $return = array();

        # Build the URL
        if(!empty($this->a_options)){
            $this->url .= '&'.implode('&', $this->a_options);
        }
        $o_xml = $this->get_oxml($b_cache);

        if(is_object($o_xml) && isset($o_xml->entry)){
            foreach($o_xml->entry as $video){

                $tmp = $this->parse_video($video);
                if(!empty($tmp)){
                    $return[] = $tmp;
                }
            }
        }

        return $return;
    }

    /**
     * Execute the query and return the XML result
     *
     * @param Boolean $b_cache
     * @return XMLString
     */
    public function result_xml($b_cache=FALSE){
        # Build the URL
        if(!empty($this->a_options)){
            $this->url .= '&'.implode('&', $this->a_options);
        }

        # reset the options
        $this->a_options = array();
        return $this->get_curl($b_cache);
    }

    /**
     * Add the keyword to the search query
     *
     * @param String $keyword
     * @return $this
     */
    public function search($keyword=FALSE){
        $return = array();

        if($keyword !== FALSE && trim($keyword) != ''){
            $this->a_options[] = 'q='.urlencode(trim($keyword));
        }
        return $this;
    }

    /**
     * Add a ordering filter to the results
     *
     * @param String $str
     * @return $this
     */
    public function orderby($str=''){
        if($str!=''){
            switch (trim(strtolower($str))){
                case 'relevance':$this->a_options[] = 'orderby=relevance';break;
                case 'published':$this->a_options[] = 'orderby=published';break;
                case 'viewCount':$this->a_options[] = 'orderby=viewCount';break;
                case 'rating':$this->a_options[] = 'orderby=rating';break;
            }
        }
        return $this;
    }

    /**
     * Add a video format filter to the results
     *
     * @param String $str
     * @return $this
     */
    public function format($str=''){
        if($str!=''){
            switch (trim(strtolower($str))){
                case 'h263':$this->a_options[] = 'format=1';break;
                case 'swf':$this->a_options[] = 'format=5';break;
                case 'mpeg4':$this->a_options[] = 'format=6';break;
            }
        }
        return $this;
    }

    /**
     * Add a developer key to the query
     *
     * @param String $str
     * @return $this
     */
    public function key($str=''){
        if($str!=''){
            $this->a_options[] = 'key='.$str;
        }
        return $this;
    }

    /**
     * Add a location filter to the results
     *
     * @param String $str
     * @return $this
     */
    public function location($str=''){
        if($str!=''){
            $this->a_options[] = 'location='.$str;
        }
        return $this;
    }

    /**
     * Add a location_radius filter to the results
     *
     * @param String $str
     * @return $this
     */
    public function location_radius($str=''){
        if($str!=''){
            $this->a_options[] = 'location-radius='.$str;
        }
        return $this;
    }

    /**
     * Add a restriction filter to the results
     *
     * @param String $str
     * @return $this
     */
    public function restriction($str=''){
        if($str!=''){
            $this->a_options[] = 'restriction='.$str;
        }
        return $this;
    }

    /**
     * Limit the number of results
     *
     * @param Integer $str
     * @return $this
     */
    public function limit($str=10, $offset=0){
        if(is_numeric($str)){
            $this->a_options[] = 'max-results='.$str;
        }

        if(is_numeric($offset) && $offset > 0){
            $this->offset($offset);
        }
        return $this;
    }

    /**
     * Limit the number of results
     *
     * @param Integer $str
     * @return $this
     */
    public function offset($str=0){
        if(is_numeric($str) && $str > 0){
            $str++;
            $this->a_options[] = 'start-index='.$str;
        }
        return $this;
    }

    /**
     * Add a safeSearch filter to the results
     *
     * @param String $str
     * @return $this
     */
    public function safeSearch($str=''){
        if($str!=''){
            switch (trim(strtolower($str))){
                case 'none':$this->a_options[] = 'safeSearch=none';break;
                case 'moderate':$this->a_options[] = 'safeSearch=moderate';break;
                case 'strict':$this->a_options[] = 'safeSearch=strict';break;
            }
        }
        return $this;
    }

    /**
     * Add a time filter to the results
     *
     * @param String $str
     * @return $this
     */
    public function time($str=''){
        if($str!=''){
            switch (trim(strtolower($str))){
                case 'today':$this->a_options[] = 'time=today';break;
                case 'this_week':$this->a_options[] = 'time=this_week';break;
                case 'this_month':$this->a_options[] = 'time=this_month';break;
                case 'all_time':$this->a_options[] = 'time=all_time';break;
            }
        }
        return $this;
    }

    /**
     * Create a simple XML Object with the XML String received and return it
     *
     * @param Boolean $b_cache
     * @return Mixed
     */
    private function get_oxml($b_cache=FALSE){
        $s_xml = $this->get_curl($b_cache);

        try {
            $obj_xml = @new SimpleXMLElement($s_xml, LIBXML_NOCDATA);
        }
        catch (Exception $e){
            //if ($this->debug) echo 'Invalid XML string: ' , $e->getMessage() , "";
            $obj_xml = FALSE;
        }
        return $obj_xml;
    }

    /**
     * curl function to call the API
     *
     * @param string $s_url
     * @param boolean $b_cache
     * @return xml result
     */
    private function get_curl($b_cache=FALSE){
        $request = TRUE;

        # If the user decide to use the cache, we check that we have the data into the cache
        if($b_cache === TRUE){
            $md5_cache = 'itunes_'.md5($this->url).'.cache';

            # The cache folder is always located at the same place system/cache
            $cache_dir = dirname(__FILE__).'/../../cache/libraries';
            $cache_file = $cache_dir.'/'.$md5_cache;

            # We check that the folder exist, if not create it
            if(!file_exists($cache_dir)){
                mkdir($cache_dir);
            }else{
                # Now we check the file exists and is not out of date

                if(file_exists($cache_file)){
                    $filemtime = @filemtime($cache_file);

                    # If the cache still up to date
                    if ($filemtime !== FALSE && (time() - $filemtime < $this->cache_life)){
                        $request = FALSE;
                        $str_xml = file_get_contents($cache_file);
                    }else{
                        @unlink($cache_file);
                    }
                }
            }
        }

        if($request === TRUE){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_USERAGENT, "MOZILLA/5.0 (WINDOWS; U; WINDOWS NT 5.1; EN-US; RV:1.9.0.3) GECKO/2008092417 FIREFOX/3.0.3");
            // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10); // timeout de 10 sec.
            # we get the xml file contening the ads
            $str_xml = curl_exec($ch);
            $error = curl_error($ch);
            $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            # we close the curl connexion
            curl_close($ch);

            # If the cache is enabled, we save the response into the cache
            if($b_cache === TRUE){
                $fp = fopen($cache_file, 'w+');
                fwrite($fp, $str_xml);
                fclose($fp);
            }
        }

        return $str_xml;
    }

    private function parse_video(&$o_xml_video){
        $return = array();

        if(isset($o_xml_video->id)){
            $return['id'] = (string)$o_xml_video->id;
            $return['title'] = (string)$o_xml_video->title;
            $return['desc'] = (string)$o_xml_video->content;
            $return['author'] = (string)$o_xml_video->author->name;
            $return['author_link'] = (string)$o_xml_video->author->uri;
            $return['published_date'] = (integer)strtotime((string)$o_xml_video->published);
            $return['updated_date'] = (integer)strtotime((string)$o_xml_video->updated);
            $return['category'] = array();
            if(isset($o_xml_video->category)){
                foreach($o_xml_video->category as $cat){
                    if(isset($cat->attributes()->label)){
                        $return['category'][] = (string)$cat->attributes()->label;
                    }
                }
            }

            if(isset($o_xml_video->link)){
                foreach($o_xml_video->link as $link){
                    if((string)$link->attributes()->rel == 'alternate'){
                        $return['url'] = (string)$link->attributes()->href;
                    }
                }
            }

            # Get the data from the media namespace
            $media = $o_xml_video->children('http://search.yahoo.com/mrss/');

            if(is_object($media)){

                $return['keyword'] = (string)$media->group->keywords;

                $return['images']['small'] = array();
                $return['images']['large'] = array();

                if(isset($media->group->thumbnail)){
                    foreach($media->group->thumbnail as $img){
                        $height = (string)$img->attributes()->height;

                        if($height == '90'){
                            $return['images']['small'][] = (string)$img->attributes()->url;
                        }elseif($height == '240'){
                            $return['images']['large'][] = (string)$img->attributes()->url;
                        }
                    }
                }
            }
        }

        return $return;
    }
}
