<?php

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

    function __construct($map, $imagefolder, $pointofinterest, $currentx, $currenty)
    {

    }

    function generateGrid($array_tiles)
    {
        $con = new mysqli("localhost", "root", "", 'avontuur');
        $result = mysqli_query($con, "SELECT x, y FROM locations")or die("<strong>SQL error: </strong>".mysqli_error($con));
        $array = array();
        while($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }
        $x = 15;
        $y = 15;
        $grid_array = "";
        $i = false;
        $index_array = 0;
        for ($x_t = 1; $x_t < ($x + 1); $x_t++) {
            $grid_array .= "<div class='column'>";
            for ($y_t = 1; $y_t < ($y + 1); $y_t++) {
                foreach ($array as $single_locations){
                    $single_locations['x'] == $x_t && $single_locations['y'] == $y_t ? $location_found = true : $location_found = false;
                    if ($location_found){break;}
                }
                if (!isset($location_found)){
                    if (!$i) {
                        $grid_array = "<span class='no_location'>No locations found</span>";
                        $i = true;
                    }
                    $grid_array .= "<div class='block-" . $x_t . "-" . $y_t . "'><img class='map_img' src='tiles/". $array_tiles[$index_array] .".png'/></div>";
                }
                elseif ($location_found){
                    $grid_array .= "<div class='block-" . $x_t . "-" . $y_t . "' data-location='true'><img class='map_img' src='tiles/". $array_tiles[$index_array] .".png'/></div>";
                }
                else{
                    $grid_array .= "<div class='block-" . $x_t . "-" . $y_t . "'><img class='map_img' src='tiles/". $array_tiles[$index_array] .".png'/></div>";
                }
                $index_array++;
            }
        }
        $grid_array .= "</div>";
        return $grid_array;
    }

    function MinimapHTML($array_tiles) {
        $minimap = $this->generateGrid($array_tiles);

        // todo: create minimap html

        return '<div class="minimap">' . $minimap . '</div>';
    }

    function BigmapHTML() {
        $minimap = "";
        // todo: create minimap html

        return '<div class="minimap">' . $minimap .'</div>';
    }

    function HTML() {

        return '<div class="test"><img src="tmw_desert_spacing.png" alt="uhm"></div>';
//        return '<div class="test">' . $minimap .'</div>';
    }

}