<?php
/**
 * Ponut - Applicant Tracking System
 *
 * @author      Clivern <hello@clivern.com>
 * @link        http://ponut.co
 * @license     MIT
 * @package     Ponut
 */

namespace Ponut\Libraries\Export;

use Symfony\Component\HttpFoundation\StreamedResponse;

class CSV
{

    /**
     * File Name
     * @var string
     */
    private $filename;

    /**
     * Data Source
     * @var object
     */
    private $source;

    /**
     * Chunk items
     * @var integer
     */
    private $items;

    /**
     * CSV Header
     * @var array
     */
    private $header;

    /**
     * Raw Callback
     * @var func
     */
    private $callback;


    private static $instance;

    public static function instance()
    {
        if ( !isset(self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Set CSV File Name
     *
     * @param  string $filename
     * @return object
     */
    public function file($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * Set Data Source
     *
     * @param  object $source
     * @return object
     */
    public function source($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * Set Chunk Total Items
     *
     * @param  integer $items
     * @return object
     */
    public function chunks($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * Set CSV Header
     *
     * @param  array $header
     * @return object
     */
    public function header($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Set Raw Builder Callback
     *
     * @param  func $callback
     * @return object
     */
    public function callback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * Export CSV
     *
     * @return string
     */
    public function export()
    {

        $headers = array(
            'Content-Type'        => 'text/csv',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=' . $this->filename . '.csv',
            'Expires'             => '0',
            'Pragma'              => 'public',
        );

        $additional_param = [];
        $response = new StreamedResponse(function() use($additional_param){
            // Open output stream
            $handle = fopen('php://output', 'w');
            fputs($handle, "\xEF\xBB\xBF"); # UTF-8 Bom

            // Add CSV headers
            if( is_array($this->header) ){
                foreach ($this->header as $header) {
                    fputcsv($handle, $header);
                }
            }

            $this->source->chunk($this->items, function($items) use($handle) {
                foreach ($items as $item) {
                    $expo_arr = call_user_func($this->callback, $item);

                    if( isset($expo_arr[0]) && is_array($expo_arr[0]) ){
                        foreach ($expo_arr as $value) {
                            if( !empty($value) ){
                                fputcsv($handle, $value);
                            }
                        }
                    }else{
                        if( !empty($expo_arr) ){
                            fputcsv($handle, $expo_arr);
                        }
                    }

                }
            });

            // Close the output stream
            fclose($handle);
        }, 200, $headers);

        return $response->send();
    }

    /**
     * Get CSV
     *
     * @return string
     */
    public function getContent()
    {

        $data = "";
        if( is_array($this->header) ){
            foreach ($this->header as $header) {
                $data .= implode(',', $header) . "\n";
            }
        }

        $this->source->chunk($this->items, function($items) use (&$data) {
            foreach ($items as $item) {
                // Add a new row with data
                $expo_arr = call_user_func($this->callback, $item);

                if( isset($expo_arr[0]) && is_array($expo_arr[0]) ){
                    foreach ($expo_arr as $value) {
                        if( !empty($value) ){
                            $data .= implode(',', $value) . "\n";
                        }
                    }
                }else{
                    if( !empty($expo_arr) ){
                        $data .= implode(',', $expo_arr) . "\n";
                    }
                }
            }
        });

        return $data;
    }
}