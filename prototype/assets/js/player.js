class Player {
  constructor(cards, table, playerIndex) {
    this.cards = cards
    this.width=0.4
    this.relYPos=0.8
    this.table=table
    this.playerIndex = playerIndex
  }

  displayCards() {
    document.getElementById('cardHolder').innerHTML = this.toString()
  }

  draw() {
    var c = document.getElementById("gameField");
    var context = c.getContext('2d')

    var width = this.width * c.width
    var posy = c.height * this.relYPos
    var spacing = width/cards.length

    var left = (c.width - width) / 2

    if(cards.length > 0){
      context.clearRect(left,posy,(cards.length)*spacing+cards[0].width,cards[0].height)
    }
    else{
      context.clearRect(left,posy,500,500)
    }

    for (var i = 0; i < cards.length; i++){
      var card = cards[i]
      var posx = left + i*spacing
      card.draw(posx,posy,1)
    }
  }

  clicked(x,y) {
    for (var i = 0; i < this.cards.length; i++){
      var card = this.cards[i]
      if(this.cards[i].isClicked(x,y)){
        if(this.table.addCard(this.playerIndex, this.cards[i])){
          this.table.card1 = this.cards[i]
          this.cards.splice(i,1)
          break          
        }
      }
    }
    this.table.draw()
    this.draw()
  }

}

class Table {
  constructor(startPlayer){
    this.relXPos = 0.8
    this.relYPos = 0.2
    this.relSize = 0.06

    this.currentPlayer = startPlayer
    this.cards = [null, null, null, null]
  }

  addCard(playerIndex, card){
    if(playerIndex == this.currentPlayer){
      this.cards[playerIndex] = card
      this.draw()
      this.currentPlayer = (this.currentPlayer+1)%4
      return true
    }
    else{
      alert("Du bist nicht am Zug!")
      return false
    }
  }

  draw(){
    var c = document.getElementById("gameField");
    var context = c.getContext('2d')

    var centerX = c.width*this.relXPos
    var centerY = c.height*this.relYPos
    var offset = c.width*this.relSize

    if(this.cards[0] != null){
      this.cards[0].draw(centerX, centerY+offset)
    }
    if(this.cards[1] != null){
      this.cards[1].draw(centerX-offset, centerY)
    }
    if(this.cards[2] != null){
      this.cards[2].draw(centerX, centerY-offset)
    }
    if(this.cards[3] != null){
      this.cards[3].draw(centerX+offset, centerY)
    }
  }

}

class Card{
  cardFiles = [
    "assets/images/b6.jpg",
    "assets/images/b7.jpg",
    "assets/images/b8.jpg",
    "assets/images/b9.jpg",
    "assets/images/b0.jpg",
    "assets/images/b1.jpg",
    "assets/images/b2.jpg",
    "assets/images/b3.jpg",
    "assets/images/b4.jpg",
    "assets/images/e6.jpg",
    "assets/images/e7.jpg",
    "assets/images/e8.jpg",
    "assets/images/e9.jpg",
    "assets/images/e0.jpg",
    "assets/images/e1.jpg",
    "assets/images/e2.jpg",
    "assets/images/e3.jpg",
    "assets/images/e4.jpg",
    "assets/images/r6.jpg",
    "assets/images/r7.jpg",
    "assets/images/r8.jpg",
    "assets/images/r9.jpg",
    "assets/images/r0.jpg",
    "assets/images/r1.jpg",
    "assets/images/r2.jpg",
    "assets/images/r3.jpg",
    "assets/images/r4.jpg",
    "assets/images/s6.jpg",
    "assets/images/s7.jpg",
    "assets/images/s8.jpg",
    "assets/images/s9.jpg",
    "assets/images/s0.jpg",
    "assets/images/s1.jpg",
    "assets/images/s2.jpg",
    "assets/images/s3.jpg",
    "assets/images/s4.jpg"
  ]
  constructor(index){
    this.index = index
    this.x = 0
    this.y = 0
    this.borderSize=1
    this.image = new Image();

    this.width = 100
    this.height = 160

    this.loaded = false

    this.image.card = this
    this.image.src = this.cardFiles[index]
    this.image.onload = function() {
      this.card.draw(this.card.x, this.card.y)
      this.card.loaded=true
    }
  }


  draw(x,y){
    this.x=x
    this.y=y
    var c = document.getElementById("gameField");
    var ctx = c.getContext("2d");
    ctx.drawImage(this.image,x,y,this.width, this.height)
  }

  isClicked(x,y) {
    return this.x <= x && this.x + this.width >= x &&  this.y <= y && this.y + this.height >= y
  }

}

Player.prototype.toString = function playerToString() {
  out = ""
  for (var i = 0; i < cards.length; i++){
    out += this.cards[i].toString() + ", "
  }
  return out
}


Card.prototype.toString = function cardToString() {
  return this.suit + this.value
}





cards = [
  new Card(0),
  new Card(2),
  new Card(8),
  new Card(10),
  new Card(12),
  new Card(14),
  new Card(30),
  new Card(31),
  new Card(35)
]

var table = new Table(0)
var player = new Player(cards, table, 0)
player.draw()

var elem = document.getElementById('gameField'),
    elemLeft = elem.offsetLeft,
    elemTop = elem.offsetTop,
    context = elem.getContext('2d'),
    elements = [];

// Add event listener for `click` events.
elem.addEventListener('click', function(event) {
    var c = document.getElementById("gameField");
    var rect = c.getBoundingClientRect();
    var ctx = c.getContext("2d");

    var x =(event.clientX-rect.left)*c.width/rect.width,
        y = (event.clientY-rect.top)*c.height/rect.height;
    player.clicked(x,y)
}, false);
