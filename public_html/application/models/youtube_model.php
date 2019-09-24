<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* An abstruct model for extending into other controllers.
* Here we will write the common functions
* 
* @author: Arnab Chattopadhyay
*/

$clientLibraryPath = FCPATH.'application/libraries/Gdata';
ini_set('include_path',get_include_path() . PATH_SEPARATOR . $clientLibraryPath);
require_once 'Zend/Loader.php'; // the Zend dir must be in your include_path
require_once APPPATH.'models/my_model.php';
class Youtube_model extends My_model {
    private $o_yt;
    public function __construct() {
        parent::__construct();
        Zend_Loader::loadClass('Zend_Gdata_YouTube');
        $this->yt = new Zend_Gdata_YouTube();
    }

    public function searchVideos($s_searchQuery='', $m_opt=array()) {
        $this->yt->setMajorProtocolVersion(2);
        $o_query = $this->yt->newVideoQuery();
        // Setting Options [start]
        if(isset($m_opt['setOrderBy']) && !empty($m_opt['setOrderBy']))
            $o_query->setOrderBy($m_opt['setOrderBy']);
        if(isset($m_opt['setMaxResults']) && !empty($m_opt['setMaxResults']))
            $o_query->setMaxResults($m_opt['setMaxResults']);    
        if(isset($m_opt['setStartIndex']) && !empty($m_opt['setStartIndex']))
            $o_query->setStartIndex($m_opt['setStartIndex']);    
        // Setting Options [end]

        $o_query->setSafeSearch('none');
        $o_query->setVideoQuery(urlencode($s_searchQuery));
        // Note that we need to pass the version number to the query URL function
        // to ensure backward compatibility with version 1 of the API.
        $o_videoFeed = $this->yt->getVideoFeed($o_query->getQueryUrl(2));
        return $this->getVideoFeedArray($o_videoFeed);
    }

    public function getVideoFeedArray($o_videoFeed) {
        $m_feed = array();
        $i_indx = 0;
        foreach ($o_videoFeed as $o_videoEntry) {
            $m_feed[$i_indx]['title'] = $o_videoEntry->getVideoTitle();
            $m_feed[$i_indx]['video_id'] = $o_videoEntry->getVideoId();
            $m_feed[$i_indx]['updated'] = $o_videoEntry->getUpdated();
            $m_feed[$i_indx]['description'] = $o_videoEntry->getVideoDescription();
            $m_feed[$i_indx]['tags'] = $o_videoEntry->getVideoTags();
            $m_feed[$i_indx]['video_url'] = $o_videoEntry->getVideoWatchPageUrl();
            $m_feed[$i_indx]['flash_url'] = $o_videoEntry->getFlashPlayerUrl();
            $m_feed[$i_indx]['duration'] = $o_videoEntry->getVideoDuration();
            $m_feed[$i_indx]['view'] = $o_videoEntry->getVideoViewCount();
            $m_feed[$i_indx]['rating'] = $o_videoEntry->getVideoRatingInfo();
            $m_feed[$i_indx]['location'] = $o_videoEntry->getVideoGeoLocation();
            $m_feed[$i_indx]['record_time'] = $o_videoEntry->getVideoRecorded();
            $m_videoThumbnails = $o_videoEntry->getVideoThumbnails();
            $m_feed[$i_indx]['thumb'] = $m_videoThumbnails;
            // pr($m_videoThumbnails, true);
            foreach($m_videoThumbnails as $m_thumb){
                $m_feed[$i_indx]['thumb_time'][] = $m_thumb['time'];
                $m_feed[$i_indx]['thumb_url'][] = $m_thumb['url'];
                $m_feed[$i_indx]['thumb_height'][] = $m_thumb['height'];
                $m_feed[$i_indx]['thumb_width'][] = $m_thumb['width']; 
            }
            $i_indx++;
        }
        return $m_feed;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
