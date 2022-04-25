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
    $("#championsTable,#winrateTable,#pickrateTable").each(function () {
        $(this).hover(
            function () {
                $(this).addClass("hover");
            },
            function () {
                $(this).removeClass("hover");
            }
        );
    });
});

// used for alphanumerical sorting
// var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });
let ascendingAlpha = true;
let ascendingWR = false;
let ascendingPR = false;

function alphabeticalSort() {
    var isTable = JSON.parse(localStorage.getItem("previousSetup"));
    var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });
    var input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    if (isTable) {
        // table rows + body, as well as the entire table itself
        let tr = document.getElementsByTagName("tr"); // 0 row is the head row
        let tbody = document.getElementsByTagName("tbody");
        let champtable = document.getElementById("champtable");
        let namesTable = document.querySelectorAll('[id=chtbnm]');

        let namesArr = [];
        for (var i = 0; i < namesTable.length; i++) {
            namesArr.push(namesTable[i].textContent);
        }
        if (ascendingAlpha) {
            namesArr.sort(collator.compare);
            ascendingAlpha = false;
        } else {
            namesArr.sort(collator.compare).reverse();
            ascendingAlpha = true;
        }
        for (let j = 0; j < namesArr.length; j++) {
            for (let k = 0; k < tr.length; k++) {
                if (tr[k].textContent.includes(namesArr[j])) {
                    $("#tbod").append(tr[k]);
                    break;
                }
            }
        }
        // change table index numbers back to 1-n
        let indexTable = document.querySelectorAll('[id=chtbnx]');
        for (let x = 0; x < namesArr.length; x++) {
            var tempStr = x + 1;
            indexTable[x].textContent = tempStr;
        }
    } else {

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
}

function winRateSort() {
    var isTable = JSON.parse(localStorage.getItem("previousSetup"));
    var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });
    var input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    if (isTable) {
        // table rows + body, as well as the entire table itself
        let tr = document.getElementsByTagName("tr"); // 0 row is the head row
        let wrTable = document.querySelectorAll('[id=chtbwr]');

        let wrArr = [];
        for (var i = 0; i < wrTable.length; i++) {
            wrArr.push(wrTable[i].textContent);
        }
        if (!ascendingWR) {
            wrArr.sort(collator.compare).reverse();
            ascendingWR = true;
        } else {
            wrArr.sort(collator.compare);
            ascendingWR = false;
        }
        for (let j = 0; j < wrArr.length; j++) {
            for (let k = 0; k < tr.length; k++) {
                if (tr[k].textContent.includes(wrArr[j])) {
                    $("#tbod").append(tr[k]);
                    break;
                }
            }
        }
        // change table index numbers back to 1-n
        let indexTable = document.querySelectorAll('[id=chtbnx]');
        for (let x = 0; x < wrArr.length; x++) {
            var tempStr = x + 1;
            indexTable[x].textContent = tempStr;
        }

    } else {
        var cards = document.getElementsByClassName('card');
        let winRates = document.querySelectorAll('[id=winRate]');
        let winRatesArr = [];
        for (var i = 0; i < winRates.length; i++) {
            winRatesArr.push(winRates[i].textContent);
        }

        winRatesArr.sort(collator.compare).reverse();

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
}

function pickRateSort(repeat) {
    var isTable = JSON.parse(localStorage.getItem("previousSetup"));
    var collator = new Intl.Collator(undefined, { numeric: true, sensitivity: 'base' });
    var input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    if (isTable) {
        // table rows + body, as well as the entire table itself
        let tr = document.getElementsByTagName("tr"); // 0 row is the head row
        let prTable = document.querySelectorAll('[id=chtbpr]');

        let prArr = [];
        for (var i = 0; i < prTable.length; i++) {
            prArr.push(prTable[i].textContent);
        }
        if (!ascendingPR) {
            prArr.sort(collator.compare).reverse();
            if (!repeat) {
                ascendingPR = true;
            }
        } else {
            prArr.sort(collator.compare);
            if (!repeat) {
                ascendingPR = false;
            }
        }

        for (let j = 0; j < prArr.length; j++) {
            for (let k = 0; k < tr.length; k++) {
                if (tr[k].textContent.includes(prArr[j])) {
                    $("#tbod").append(tr[k]);
                    break;
                }
            }
        }
        // change table index numbers back to 1-n
        let indexTable = document.querySelectorAll('[id=chtbnx]');
        for (let x = 0; x < prArr.length; x++) {
            var tempStr = x + 1;
            indexTable[x].textContent = tempStr;
        }

    } else {
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

    // for some absolutely obscure reason, I have to run the pick rate sort specifically twice or else
    // it doesn't work correctly. the other two sorts don't need this. why??
    if (repeat) {
        pickRateSort(false);
    }
}
