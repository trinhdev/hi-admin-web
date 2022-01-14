@extends('layouts.default')

@section('content')
<header>
    <h1>Remote UX Card Sorting</h1>
  </header>
  
  <section class="new-card-container">
    <input type="text" maxlength="12" id="cardText" placeholder="New Card..." onkeydown="if (event.keyCode == 13)
                          document.getElementById('add').click()">
    <button id="add" class="button add-button" onclick="addCard()">Add New Card</button>
  </section>
  
  <div class="container">
  
    <ul class="columns">
  
      <li class="column cards-column">
        <div class="column-header">
          <h4>Cards</h4>
        </div>
        <ul class="card-list" id="cards">
          <li class="card">
            <p>Code</p>
          </li>
          <li class="card">
            <p>Design</p>
          </li>
          <li class="card">
            <p>Research</p>
          </li>
        </ul>
      </li>
  
      <div class="directions">
        <svg width="20%" height="20%" viewBox="0 0 418 176" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img">
                      <g id="Canvas" transform="matrix(2 0 0 2 8986 -622)">
                      <g id="arrow">
                      <use xlink:href="#arrow-0" transform="translate(-4493 315.5)"/>
                      </g>
                      </g>
                      <defs>
                      <path id="arrow-0" d="M 201 39L 204.514 42.5572L 208.183 38.9323L 204.446 35.3772L 201 39ZM 0 44L 201 44L 201 34L 0 34L 0 44ZM 204.446 35.3772L 163.446 -3.62279L 156.554 3.62279L 197.554 42.6228L 204.446 35.3772ZM 197.486 35.4428L 156.486 75.9428L 163.514 83.0572L 204.514 42.5572L 197.486 35.4428Z"/>
                      </defs>
                  </svg>
  
        <p>Drag cards and place them in order of importance to you on the right</p>
  
      </div>
  
      <li class="column order-column">
        <div class="column-header">
          <h4>In Order</h4>
        </div>
        <div class="range" id="highest">
          <p>Highest</p>
        </div>
        <ul class="card-list" id="order">
          <li class="card">
            <p>Coffee</p>
          </li>
          <li class="card">
            <p>Tea</p>
          </li>
        </ul>
        <div class="range" id="lowest">
          <p>Lowest</p>
        </div>
      </li>
  
    </ul>
  
  </div>
  
  <section class="delete-cards-container">
    <button class="button delete-button" onclick="deleteCardsCards()">Delete Cards in Left Column</button>
    <button class="button delete-button" onclick="deleteAllCards()">Delete All Cards</button>
    <button class="button delete-button" onclick="deleteOrderCards()">Delete Cards in Right Column</button>
  </section>
  
  <footer>
    <p>Built with <a href="https://github.com/bevacqua/dragula" target="_blank">Dragula</a> and Vanilla JS by <a href="http://nikkipantony.com" target="_blank">Nikki Pantony</a></p>
  </footer>

  <style>
      @import url("https://fonts.googleapis.com/css?family=Arimo:400,700|Roboto+Slab:400,700");

:root {
  font-size: calc(0.5vw + 1vh);
}

* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

h1,
h4 {
  font-family: "Arimo", sans-serif;
}

header h1 {
  font-size: 3rem;
  margin: 4rem auto;
}

p {
  font-family: "Roboto Slab", serif;
}

a,
a:link,
a:active,
a:visited {
  color: #0066aa;
  text-decoration: none;
  border-bottom: #000013 0.16rem solid;
}

a:hover {
  color: #000013;
  border-bottom: #0066aa 0.16rem solid;
}

header,
footer {
  width: 38rem;
  margin: 2rem auto;
  text-align: center;
}

.new-card-container {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  width: 22rem;
  height: 5.7rem;
  margin: auto;
  background: #a8a8a8;
  border: #000013 0.2rem solid;
  border-radius: 0.2rem;
  padding: 0.4rem;
}

.delete-cards-container {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  width: 37rem;
  height: 5.3rem;
  margin: auto;
  background: #a8a8a8;
  border: #000013 0.2rem solid;
  border-radius: 0.2rem;
  padding: 0.4rem;
}

.container {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
}

.columns {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: start;
  -ms-flex-align: start;
  align-items: flex-start;
  margin: 1.5rem auto;
}

.column {
  width: 10rem;
  margin: 1rem 2rem;
  background: #a8a8a8;
  border: #000013 0.2rem solid;
  border-radius: 0.2rem;
}

.column-header {
  padding: 0.1rem;
  border-bottom: #000013 0.2rem solid;
}

.column-header h4 {
  text-align: center;
}

.column-header {
  background: #13a4d9;
}

.card-list {
  min-height: 3rem;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li {
  list-style-type: none;
}

.button {
  font-family: "Arimo", sans-serif;
  font-weight: 700;
  border: #000013 0.14rem solid;
  border-radius: 0.2rem;
  color: #000013;
  padding: 0.6rem 1rem;
  margin-bottom: 0.3rem;
  cursor: pointer;
}

.delete-button {
  background-color: #ff4444;
  margin: 0.3rem 0.4rem;
}

.delete-button:hover {
  background-color: #fa7070;
}

.add-button {
  background: #28c375;
  padding: 0 1rem;
  height: 2.8rem;
  width: 10rem;
  margin-top: 0.8rem;
}

.add-button:hover {
  background-color: #35eb90;
}

.card {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  vertical-align: middle;
  list-style-type: none;
  background: #fff;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
  margin: 0.4rem;
  height: 4rem;
  border: #000013 0.15rem solid;
  border-radius: 0.2rem;
  cursor: move;
  text-align: center;
  vertical-align: middle;
}

#cardText {
  background: #fff;
  border: #000013 0.15rem solid;
  border-radius: 0.2rem;
  text-align: center;
  font-family: "Roboto Slab", serif;
  height: 4rem;
  width: 9rem;
  margin: 0.2rem 0.8rem 0 0.4rem;
}

.card p {
  margin: auto;
}

.directions {
  z-index: 2;
  margin: auto;
  text-align: center;
  font-weight: 700;
  width: 13.3rem;
}

.range {
  text-align: center;
  width: 6rem;
  margin: 1rem auto;
}

.range p {
  padding: 0.3rem;
  border: #e2e2e2 0.12rem solid;
  border-radius: 0.2rem;
  color: #fff;
}

#highest {
  background-color: #28c375;
}

#lowest {
  background-color: #ff4444;
}

/* Dragula CSS Release 3.2.0 from: https://github.com/bevacqua/dragula */

.gu-mirror {
  position: fixed !important;
  margin: 0 !important;
  z-index: 9999 !important;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
}

.gu-hide {
  display: none !important;
}

.gu-unselectable {
  -webkit-user-select: none !important;
  -moz-user-select: none !important;
  -ms-user-select: none !important;
  user-select: none !important;
}

.gu-transit {
  opacity: 0.2;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
  filter: alpha(opacity=20);
}

  </style>
@endsection