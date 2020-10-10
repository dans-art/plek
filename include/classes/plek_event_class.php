<?php
/**
 * Plugin Name: Plekvetica
 * Plugin URI: https://www.plekvetica.ch/
 * Description: Event-calendar related methods and properties to extend functionality.
 * Version: 1.2
 * Author: Daniel Spycher
 * Author URI: https://www.dans-art.ch/
 */

class plekEvents
{

    public $error = array(); //Array to store errors
    public $fetched_events = null; //Currently loaded events
    public $fetchArgs = null; //Arguments for the loaded events
    public $maxUploadSize = 8048576; //Max upload size in bytes
    public $minRes = array(200, 200); //Min Res for Uploads (width,height)
    public $newImageQual = 70; //Image quality 
    public $newImageRes = array(1920,1080); //Res for new Images
    public $mailTemplateMng = "templates/email/plek_events_info_email_eventmanager.php";//Template for Email to Eventmanager

    public function __construct()
    { }
    /**
     * Get all Events as a OBJ
     * Call this as a Shortcode to deliver the attributes
     * 
     * @return false or object
     */
    public function get_Events_obj()
    {
        $nargs = shortcode_atts(array(
            'offset' => 0,
            'posts_per_page' => -1,
            'post_status' => 'published',
            'eventDisplay'   => 'custom',
            'order' => 'ASC',
            'featured'       => null,
            'start_date'     => "",
            'end_date'     => "",
            'meta_query' => array(""),
            'tax_query' => ""
        ), $this->fetchArgs);
        $events = tribe_get_events($nargs);
        set_query_var('eventdata', $events);

        if ($events) {
            $this->fetched_events = $events;
            return true;
        } else {
            $this->error[] = __("Failed to load Posts", "pleklang");
            return false;
        }
    }
    /**
     * Set the Event status to "Publish"
     *
     * @param [int] $id - Event ID
     * @param [type] $setTo
     * @return string Update messsage, success or error message
     * TODO: Allow to set custom status
     */
    public function set_event_status($id,$setTo){
       $id = (int) $id;
        global $plek;
        $update = array(
            'ID'           => $id,
            'post_status' => 'publish'
        );
       $set = wp_update_post( $update );
        if(is_int($set) AND $set > 0){
            return $plek -> wrap_html_container(__("Event published!","pleklang"),"span","fatGreen");
        }else{
            return $plek -> wrap_html_container(__("Changing Status was unsuccessfully","pleklang"),"span","fatRed");
        }
      }
    }
