<html>
<head>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="javascript" href="js/js.js"/>
    <link href="jquery-3.0.0.min"/>
</head>
<body>
    <div class="navbar">
        <?php
            require_once('MapRenderer.class.php');

        $array_tiles = array(
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,
            0,30,30,30,30,0,0,0,0,30,30,30,30,0,0,
            0,30,30,30,30,30,30,30,30,30,0,0,30,0,0,
            0,0,0,0,36,36,45,45,45,45,45,45,0,0,0,
            0,0,0,0,0,36,45,45,0,0,0,45,0,0,0,
            0,0,0,0,0,36,36,45,0,0,0,0,0,0,0,
            0,0,0,0,0,0,36,45,36,36,36,36,0,0,0,
            0,0,0,0,0,0,36,45,36,36,0,0,36,36,36,
            0,45,45,0,0,0,36,45,0,0,30,0,0,0,0,
            45,45,0,45,0,0,36,45,0,0,30,30,30,0,0,
            45,0,0,0,45,0,45,45,0,0,30,30,30,0,0,
            45,45,0,0,45,45,45,0,0,0,30,0,0,0,0,
            0,45,45,45,0,45,0,0,0,0,30,0,0,0,0,
            0,0,0,0,0,0,0,0,30,30,30,0,0,0,0,
            0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,

            );
        
            $map = "";
            $pointofinterest = "";
            $currentx = "";
            $currenty = "";
            $imagefolder = "";
            $foo = new MapRenderer($map, $imagefolder, $pointofinterest, $currentx, $currenty);
    
            echo $foo->MinimapHTML($array_tiles);
//            echo $foo->BigmapHTML();
//            echo $foo->HTML();
        ?>
    </div>
</body>
</html>


