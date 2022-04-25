/* Sources used
1) https://www.w3schools.com/jsref/jsref_sort.asp
2) https://www.freecodecamp.org/news/how-to-clone-an-array-in-javascript-1d3183468f6a/
3) http://www.advancesharp.com/questions/17603/javascript-array---get-range-of-items
4) https://www.freecodecamp.org/news/how-to-clone-an-array-in-javascript-1d3183468f6a/
5) https://stackoverflow.com/questions/2802341/javascript-natural-sort-of-alphanumerical-strings
6) https://www.w3schools.com/js/js_htmldom_elements.asp
*/


// this JS file will be used to perform sorting by alphabetical, win rates, pick rates

// add hover elements to li tags. originally, it only showed with that cursor you get when you hover 
//over text. Adding href="#" removed this, but it kept resending us to top of page / refreshing the page. 
//Thus, use jQuery to add a hover class on event hover to add the pointer cursor (the one that looks 
// like a hand pointing) to li elements. 
$(document).ready(function () {
    $("li").hover(
        function () {
            $(this).addClass("hover");
        },
        function () {
            $(this).removeClass("hover");
        }
    );

    // for the table, add sorting for win rates and pick rates when they click on the th elements

    // $("th").each()
});

// used for alphanumerical sorting
// var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });

function alphabeticalSort() {
    var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });
    var input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    var cards = document.getElementsByClassName('card');
    // arrays of all the names, winrates, and pickrates of champs inside the Cards
    let names = document.querySelectorAll('[id=name]');

    // extract textContents to another array to perform sorting
    let namesArr = [];

    for (var i = 0; i < names.length; i++) {
        namesArr.push(names[i].textContent);

    }
    // console.log(namesArr);
    // console.log(namesArr.sort(collator.compare));
    namesArr.sort(collator.compare);

    // now, loop through all the cards and add them appropriately. Remove all the cards and add them approriately

    for (let j = 0; j < namesArr.length; j++) {
        for (let k = 0; k < cards.length; k++) {
            if (cards[k].textContent.includes(namesArr[j])) {
                $("#rowCards").append(cards[k]);
                break;
            }
        }
    }
}

function winRateSort() {
    var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });
    var input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    var cards = document.getElementsByClassName('card');
    let winRates = document.querySelectorAll('[id=winRate]');
    let winRatesArr = [];
    for (var i = 0; i < winRates.length; i++) {
        winRatesArr.push(winRates[i].textContent);
    }
    // console.log(winRatesArr);
    // console.log(winRatesArr.sort(collator.compare));
    winRatesArr.sort(collator.compare).reverse();
    console.log(winRatesArr);
    console.log(cards, cards.length);

    // now, loop through all the cards and add them appropriately
    // var row = $("#rowCards").get()[0];
    // row.children.innerHTML = "";

    for (let j = 0; j < winRates.length; j++) {
        for (let k = 0; k < cards.length; k++) {
            if (cards[k].textContent.includes(winRatesArr[j])) {
                $("#rowCards").append(cards[k]); // jQuery
                break;
            }
        }
    }
}

function pickRateSort() {
    var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });
    var input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    var cards = document.getElementsByClassName('card');
    let pickRates = document.querySelectorAll('[id=pickRate]');
    let pickRatesArr = [];
    for (var i = 0; i < pickRates.length; i++) {
        pickRatesArr.push(pickRates[i].textContent);
    }
    // console.log(pickRatesArr);
    // console.log(pickRatesArr.sort(collator.compare));
    pickRatesArr.sort(collator.compare).reverse();

    for (let j = 0; j < pickRatesArr.length; j++) {
        for (let k = 0; k < cards.length; k++) {
            if (cards[k].textContent.includes(pickRatesArr[j])) {
                $("#rowCards").append(cards[k]);
                break;
            }
        }
    }
}