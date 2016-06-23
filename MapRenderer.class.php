<?php

require_once 'DB_vars.php';

class MapRenderer
{
    public $map;
    public $pointsofinterest;
    public $currentx;
    public $currenty;

    // settings
    public $color_poi;
    public $color_currentpos;
    public $color_cleared;

    /*
     * $map = array of Location objects;
     * $imagefolder = folder where images can be found.
     */

//    function __construct($map, $imagefolder, $pointofinterest, $currentx, $currenty)
    function __construct($array_tiles)
    {

    }

    function generateGrid($array_tiles)
    {
        $con = new mysqli(DB_vars::$server, DB_vars::$user, DB_vars::$password, DB_vars::$DB_name);
        $result = mysqli_query($con, "SELECT * FROM locations")or die("<strong>SQL error:</strong>". mysqli_error($con));
        $all_locations = array();
        while($row = mysqli_fetch_assoc($result)) {
            $all_locations[] = $row;
        }
        mysqli_close($con);
        $x = 15;
        $y = 15;
        $HTML_production = "";
        $location_print_boolean = false;
        $square_counter = 0;
        $HTML_production .= "<div class='container'>";
        for ($x_t = 1; $x_t < ($x + 1); $x_t++) {
            $HTML_production .= "<div style='height:". 100/$x ."%;' class='column'>";
            for ($y_t = 1; $y_t < ($y + 1); $y_t++) {
                foreach ($all_locations as $single_locations){
                    $single_locations['x'] == $x_t && $single_locations['y'] == $y_t ? $location_found = true : $location_found = false;
                    $single_locations['cleared'] == 1 ? $cleared = true : $cleared = false;
                    if ($location_found){break;}
                }
                if (!isset($location_found)){
                    if (!$location_print_boolean) {
                        $HTML_production = "<span class='no_location'>No locations found</span>";
                        $location_print_boolean = true;
                    }
                    $HTML_production .= "<div style='width:". 100/$y ."%;' class='block-" . $x_t . "-" . $y_t . "'><img class='map_img' src='tiles/". $array_tiles[$square_counter] .".png'/></div>";
                }
                elseif ($location_found){
                    if ($cleared){
                        $HTML_production .= "<div style='width:". 100/$y ."%;' class='block-" . $x_t . "-" . $y_t . "' data-location='true' data-location-clear='true'><img class='map_img' src='tiles/". $array_tiles[$square_counter] .".png'/></div>";
                    }
                    else{
                        $HTML_production .= "<div style='width:". 100/$y ."%;' class='block-" . $x_t . "-" . $y_t . "' data-location='true'><img class='map_img' src='tiles/". $array_tiles[$square_counter] .".png'/></div>";
                    }
                }
                else{
                    $HTML_production .= "<div style='width:". 100/$y ."%;' class='block-" . $x_t . "-" . $y_t . "'><img class='map_img' src='tiles/". $array_tiles[$square_counter] .".png'/></div>";
                }
                $square_counter++;
            }
            $HTML_production .= "</div>";
        }
        $HTML_production .= "</div>";
        return $HTML_production;
    }

    public function ClearLocation(){
        $con = new mysqli(DB_vars::$server, DB_vars::$user, DB_vars::$password, DB_vars::$DB_name);
        $result = mysqli_query($con, "SELECT * FROM locations")or die("<strong>SQL error:</strong>". mysqli_error($con));
        $all_locations = array();
        while($row = mysqli_fetch_assoc($result)) {
            $all_locations[] = $row;
        }
        mysqli_close($con);
    }

    function MinimapHTML($array_tiles) {
        $minimap = $this->generateGrid($array_tiles);

        // todo: create minimap html

        return '<div id="Minimap" class="minimap">' . $minimap . '</div>';
    }

    function BigmapHTML($array_tiles) {
        $bigmap = $this->generateGrid($array_tiles);
        // todo: create minimap html

        return '<div class="bigmap">' . $bigmap .'</div>';
    }

    function HTML() {

        return '<div class="test"><img src="tmw_desert_spacing.png" alt="uhm"></div>';
//        return '<div class="test">' . $minimap .'</div>';
    }

}