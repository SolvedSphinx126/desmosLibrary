<!DOCTYPE html>
<html>
    <head>
        <title>Desmos Graphs</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <header style="bg-color=#AAAAAA">
            Here is the Admin Panel
        </header>
        <ul id="graph-list">
            <?php

                require_once(__DIR__.'/../OpenGraph.php');
                
                function require_auth() {
                    // your username and password as hashed by ./admin/getPasswordHash.php
                    $AUTH_USER = '';
                    $AUTH_PASS = '';
                    header('Cache-Control: must-revalidate, max-age=0');
                    $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
                    $is_not_authenticated = (
                        !$has_supplied_credentials ||
                        $_SERVER['PHP_AUTH_USER'] != $AUTH_USER ||
                        !password_verify($_SERVER['PHP_AUTH_PW'], $AUTH_PASS)
                    );
                    if ($is_not_authenticated) {
                        header('HTTP/1.1 401 Authorization Required');
                        header('WWW-Authenticate: Basic realm="Access denied"');
                        exit;
                    }
                    if (!$is_not_authenticated) {
                        printGraphsAdmin();
                    }
                }

                require_auth();

                function printGraphsAdmin() {
                    $filedata = file_get_contents('../graphs.json');
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
                    }
                    
                }
            ?>
        </ul>
    </body>
</html>
    
