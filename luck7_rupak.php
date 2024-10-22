<?php
  $balance = 100;
  $diceOne = 0;
  $diceTwo = 0;
  $diceTotal = 0;
  $bet = 10;

  $luckySevenPrize = 30;
  $otherPrize = 20;
  
  $message = "";

  if( isset($_POST["hdMode"]) ) {

    $balance = $_POST['hdBalance'];

    if($_POST["hdMode"] == 1) {
      $diceOne = rand(1,6);
      $diceTwo = rand(1,6);
      $diceTotal = $diceOne + $diceTwo;
      $balance -= $bet;

      if(($_POST["betType"] == "below 7" && $diceTotal < 7) || ($_POST["betType"] == "above 7" && $diceTotal > 7)) {
        $balance += $otherPrize;
        $message = "Congratulations! You win! Your balance is now <span class=\"highlight\">" . $balance . "</span> Rs.";
      } else if($_POST["betType"] == "lucky 7" && $diceTotal == 7) {
        $balance += $luckySevenPrize;
        $message = "Congratulations! You win! Your balance is now <span class=\"highlight\">" . $balance . "</span> Rs.";
      } else {
        $message = "Sorry! You lost this game! Your balance is now <span class=\"highlight\">" . $balance . "</span> Rs.";
      }
    } else if($_POST["hdMode"] == 2) {
      $balance = 100;
      $message = "";
    }
  }

?>

<style>
.highlight {
color: red;
}

button {
  font-weight: 800;
  font-size: 18px;
}
</style>

<form name="frm" method="POST">
<p>Welcome to Lucky <span class="highlight">7</span> Game</p>
<p>Place your bet (Rs. <?php echo $bet; ?>)</p>

<input type="radio" name="betType" value="below 7">Below 7
<input type="radio" name="betType" value="lucky 7">7
<input type="radio" name="betType" value="above 7">Above 7
<button name="play" type="button" onclick="doSubmit(1)" >Play</button>

<?php if(isset($_POST["hdMode"]) && $_POST["hdMode"] == 1) { ?>
<p class="highlight">Game results</p>
Dice <span class="highlight">1</span>: <span class="highlight"><?php echo( $diceOne > 0 ? $diceOne : ""); ?></span> <br />
Dice <span class="highlight">2</span>: <span class="highlight"><?php echo( $diceTwo > 0 ? $diceTwo : ""); ?></span> <br />
Total: <span class="highlight"><?php echo( $diceTotal > 0 ? $diceTotal : ""); ?></span>

<p><?php echo $message; ?></p>
<?php } ?>

<p>
  <button name="reset_play" type="button" onclick="doSubmit(2)" >Reset and Play Again</button>
  <button style="margin-left: 10px;" name="continue_play" onclick="doSubmit(3)" type="button">Continue Playing</button>
</p>

<input type="hidden" id="hdMode" name="hdMode" value="">
<input type="hidden" id="hdBalance" name="hdBalance" value="<?php echo $balance; ?>">
</form>

<script>
  function doSubmit(mode) {
    document.getElementById("hdMode").value = mode;
    document.frm.submit();
  }
</script>  
