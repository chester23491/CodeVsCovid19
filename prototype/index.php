<html>
<body>
  <div>
    <label for="room">Your Room</label>
    <input name="room" id="room" value="">
  </div>
  <div>
    <label for="name">Your Name</label>
    <input name="name" id="name" value="">
  </div>
  <div>
    <button onclick="onSubmit()">Start Game</button>
    <!-- <i type="submit" value="Start Game " name="submit" > -->
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
  $.ajaxSetup({
      xhrFields: {
        withCredentials: true
      }
    });

function onSubmit() {
  name = document.getElementById("name").value
  room = document.getElementById("room").value

  $.post("http://studentethz.ch/api/?action=create_player&p_name="+name,
       function(data) {
        console.log(data)
    })
  $.post("http://studentethz.ch/api/?action=join_game&room_name="+room);


  $.getJSON("http://studentethz.ch/api/?action=my_cards",
       function(data) {
         if(data.error == -1){
           console.log(data.cards)
           for(var i = 0; i < data.cards.length; i++){
             player.cards.push(new Card(data.cards[i]))
           }
           player.draw()
         }
    });


  console.log("WE are here")
  // window.location = "game.php";
  
  //request = new XMLHttpRequest();
  //request.open("POST", HOST, true);
  //request.withCredentials();
  //request.send("http://studentethz.ch/api/?action=create_player&p_name="+name);

}
//$.get("http://studentethz.ch/api/?action=create_player&p_name="+$name)
</script>


<!--<?php
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $room = $_POST['room'];

    session_start();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_COOKIEFILE, "__DIR__/../tmp/CoronaJass");
    curl_setopt($ch, CURLOPT_URL, "http://studentethz.ch/api/?action=create_player&p_name=".$name);
    $output = curl_exec($ch);
    curl_setopt($ch, CURLOPT_URL, "http://studentethz.ch/api/?action=join_game&room_name=".$room);
    $game_joint = curl_exec($ch);
    curl_setopt($ch, CURLOPT_URL, "http://studentethz.ch/api/?action=game_state");
    $game_state = curl_exec($ch);
    curl_close($ch);

    header('Location: game.php');
    exit();
}
?>
-->
</body>
</html>