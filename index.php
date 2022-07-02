<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="hangjegy.png">
  <title>Guess the TS song</title>
</head>
<body>
  <link rel="stylesheet" href="style.css">
  <script src="init.js"></script>
  <table class="center" style="white-space:nowrap">
    <tr>
        <h1>Guess the <span class="taylorswift">Taylor Swift</span>   song!</h1>
    </tr>
    <tr>
      <p class="choosealbums_text">Choose albums to generate random songs from:</p>
    </tr>
    <tr>
        <td>
          <form action="/main_game.php" method="post" class="form">
              <input type="checkbox" id="ts" name="albums[]" value="ts">
              <label for="ts">Taylor Swift (Debut album)</label><br>
              <input type="checkbox" id="fearless" name="albums[]" value="fearless">
              <label for="fearless">Fearless</label><br>
              <input type="checkbox" id="sn" name="albums[]" value="sn">
              <label for="sn">Speak Now</label><br>
              <input type="checkbox" id="red" name="albums[]" value="red">
              <label for="red">Red</label><br>
              <input type="checkbox" id="1989" name="albums[]" value="1989">
              <label for="1989">1989</label><br>
              <input type="checkbox" id="rep" name="albums[]" value="rep">
              <label for="rep">Reputation</label><br>
              <input type="checkbox" id="lover" name="albums[]" value="lover">
              <label for="lover">Lover</label><br>
              <input type="checkbox" id="folk" name="albums[]" value="folk">
              <label for="folk">Folklore</label><br>
              <input type="checkbox" id="em" name="albums[]" value="em">
              <label for="em">Evermore</label><br><br><br>
              Music time in seconds (0.5-10): <input type="text" name="songtime" class="givetime_field"><br><br>
              <input type="submit" value="Start game">
            </form>
        </td>
    </tr>
  </table>
  <div style="position:fixed; bottom:3%; left:0; padding: 20px;">To Luca ♥</div>
  <div style="position:fixed; bottom:0; left:0; padding: 20px;">We'll ride the getaway car together</div>
  <div class="created">Created by: Dóra Békei, 2022 ©</div>
</body>
</html>