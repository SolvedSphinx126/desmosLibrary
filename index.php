<!DOCTYPE html>
<html>
    <body>

        <h1>Desmos page</h1>

        

    </body>
</html>

<html>
    <head>
        <title>Desmos Graphs</title>
        <link rel="stylesheet" href="./style.css">
        
    </head>
    <body>
    <header style="bg-color=#AAAAAA">

    </header>
        <ul id="graph-list">
        <?php
            require_once('OpenGraph.php');
            
            $filedata = file_get_contents('./graphs.json');
            $graphs = json_decode($filedata, true);
            
            foreach ($graphs["graphs"] as $graph) {
                $id = $graph["id"];
                $dims = $graph["dims"];
                if($dims == 2) {
                    $graphMeta = OpenGraph::fetch("https://www.desmos.com/calculator/$id");
                    $imgsrc = "https://www.desmos.com/calc_thumbs/production/$id.png";
                    $link = "https://desmos.com/calculator/$id";
                }
                else if($dims == 3) {
                    $graphMeta = OpenGraph::fetch("https://www.desmos.com/3d/$id");
                    $imgsrc = "https://www.desmos.com/calc-3d-thumbs/production/5267fc0ae4.png";
                    $link = "https://desmos.com/3d/$id";
                }
                
                $title = $graphMeta->title;
                echo "
                        <li class='calculator' id='138uyetddq'>
                            <a href=$link>
                            <img src=$imgsrc>
                            <p>$title</p>
                            </a>
                        </li>
                    ";

                foreach ($graphMeta as $key => $value) {
                    //echo "$key => $value";
                }
                
            }
        ?>
        </ul>
    </body>
</html>
    
