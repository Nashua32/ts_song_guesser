<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="hangjegy.png">
  <title>Guess the TS song</title>
</head>
<body>
  <link rel="stylesheet" href="style.css">

  <h1>Guess the <span class="taylorswift">Taylor Swift</span>   song!</h1>

    <div style="text-align: center">
        <h3>Selected time amount:</h3>
            <?php
                $t = $_POST['songtime'];
            ?>
            <p id="selectedTimeDisplay" style="text-align: center; font-family:Arial">Selected time will be here</p>
        <h3>Selected albums:</h3>

            <?php
                $albums = $_POST['albums'];
            ?>
            <p id="selectedAlbumsDisplay" style="text-align: center; font-family:Arial">Selected albums will be here</p>
    </div>

    <?php
        if($albums != null) {
            $rand_album_ind = array_rand($albums);
            $rand_album_name = "songs/" . $albums[$rand_album_ind];
            $songs_in_album = scandir($rand_album_name, 1);
            $rand_song_ind = array_rand($songs_in_album);
            if ($rand_song_ind > count($songs_in_album)-3) {
                $rand_song_ind = $rand_song_ind - 1;
                if ($rand_song_ind > 0) {
                    $rand_song_ind = $rand_song_ind -1;
                }
            }
            $title = $songs_in_album[$rand_song_ind];
            $file_name_path = $rand_album_name . "/";
            $file_name_path = $file_name_path . "$title";
        }
    ?>
    

    <div id="getTimeFromHere" style="display: none;">
        <?php
            echo htmlspecialchars($t);
        ?>
    </div>

    <div id="getTitleFromHere" style="display: none;">
        <?php
            if ($albums != null) {
                echo htmlspecialchars($file_name_path);
            }
        ?>
    </div>

    <div id="getAlbumslistFromHere" style="display: none">
        <?php
            if ($albums != null) {
                foreach ($albums as $album) {
                    echo htmlspecialchars($album);
                    echo ("-");
                }
            }
        ?>
    </div>

    <div id="getSonglistFromHere" style="display: none">
        <?php
            if ($albums!= null) {
                foreach ($albums as $album) {
                    $temp = "songs/" . $album;
                    $songs_in_album = scandir($temp, 1);
                    for ($i=0; $i<count($songs_in_album)-2; $i++) {
                        $tempforpath = "songs/" . $album . "/" . $songs_in_album[$i];
                        echo htmlspecialchars($tempforpath);
                        echo ("#");
                    }
                }
            }
        ?>
    </div>

    <script src="data.js"></script>

    
    

    <table class="table_second_page center_horizontally">
        <tr>
            <td style="vertical-align:middle; text-align: center">
                <button id="playbutton" class="purplebutton">play music</button> 
                <script src="audio_playing.js"></script>
            </td>
        </tr>
        <tr>
            <td>
                <form action="" method="post">
                    Guess song: 
                    <input type="text" name="songguess">
                    <input id="submitguessbutton" onclick="revealTitle()" name="submit" type="submit" class="button" value="Guess!"></input>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                    if (isset($_POST['submit'])) {
                        $guess = $_POST["songguess"];
                        echo "Guess is: ". $guess .'</br>';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <p>Actual title: <span id="act_title" style="font-family:Allura; font-size:25px"></span></p>
                <script>
                    document.getElementById("act_title").innerHTML = sessionStorage.songtitle;
                </script>
            </td>
        </tr>
        <tr>
            <td style="vertical-align:middle; text-align: center">
                <button id="nextbutton" class="purplebutton" onclick="newSong()">Next song</button>
            </td>
        </tr>
    </table>

    <script>
        //8 space van az elején valamiért
        function revealTitle() {
            temp = sessionStorage.songpath;
            temp = temp.trim();
            console.log(temp);
            let titl = "";
            let ind = 6;
            while (temp[ind] !== '/') {
                ind++;
            }
            ind++;
            let endind = temp.length-5;
            let len = temp.length-4-ind;
            titl = temp.substr(ind, len)
            console.log(titl);
            console.log(len);
            sessionStorage.songtitle = titl;
        }
    </script>
    <div style="position:fixed; bottom:3%; left:0; padding: 20px;">To Luca ♥</div>
    <div style="position:fixed; bottom:0; left:0; padding: 20px;">We'll ride the getaway car together</div>
    <div class="created">Created by: Dóra Békei, 2022 ©</div>
</body>
</html>