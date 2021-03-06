/* Sources used
1)https://www.w3schools.com/js/js_json_parse.asp
2)https://www.w3schools.com/tags/tag_img.asp
3)
4)
*/

// This JS file will be where we allow users to choose whether or not to view champs in a grid-style
// or table style. We will make an AJAX query to get all the information needed for the champions
var tbl = {
    tHead: null,
    tBody: null
};
// get champs makes the AJAX call and returns the array / JSON object containing all the champs
function queryChamps() {
    return new Promise((resolve) => {
        // instantiate the object
        var ajax = new XMLHttpRequest();
        // open the request
        ajax.open("GET", "?command=getChamps", true);
        // ask for a specific response
        ajax.responseType = "text";
        // send the request
        ajax.send(null);

        // What happens if the load succeeds
        ajax.addEventListener("load", function () {
            // Return the word as the fulfillment of the promise
            if (this.status == 200) {
                // worked
                resolve(this.response);
            } else {
                console.log(
                    "When trying to get champs, the server returned an HTTP error code."
                );
            }
        });

        // What happens on error
        ajax.addEventListener("error", function () {
            console.log(
                "When trying to get champs, the connection to the server failed."
            );
        });
    });
}

async function getChamps(callback) {
    var champs = await queryChamps();
    callback(champs);
}
// champs is a JSON object that is AJAX'ed in as a string, convert it to object using JSON_parse
function buildTable(champ) {
    let champtable = document.getElementById("champtable");
    champtable.style.display = "";
    var table = document.getElementById("tbod");
    table.innerHTML = "";
    var newRow = null;
    const champs = JSON.parse(champ);

    for (let i = 0; i < champs.length; i++) {
        // console.log(champs[i]["name"]);
        // console.log(champs[i]["winRate"]);
        newRow = table.insertRow(table.rows.length);
        // add champ number (starting from 1)
        var newCell = newRow.insertCell(0);
        newCell.innerHTML = "<p id='chtbnx'>" + (i + 1) + "</p>";

        // add champ icon TODO
        var newCell = newRow.insertCell(1);
        newCell.innerHTML = '<img style="padding-top: 0px; width: auto; box-shadow: 0px 0px 0px black;" src="./champArt/' +
            champs[i]["name"] + 'Icon.png" alt="' + champs[i]["name"] +
            '" width="50" height="50">';

        // add champ name as link
        var newCell = newRow.insertCell(2);
        newCell.innerHTML = '<a id="chtbnm" href="?command=championInfo&champName=' + champs[i]["name"] + '">' + champs[i]["name"] + '</a>';
        // "<p id='chtbnm'>" + champs[i]["name"] + "</p>";

        // add champ win rate
        var newCell = newRow.insertCell(3);
        newCell.innerHTML = "<p id='chtbwr'>" + champs[i]["winRate"] + "%</p>";

        // add champ pick rate
        var newCell = newRow.insertCell(4);
        newCell.innerHTML = "<p id='chtbpr'>" + champs[i]["pickRate"] + "%</p>";
    }

    // since we built the table, hide all the cards
    let cards = document.getElementsByClassName('card');
    for (let i = 0; i < cards.length; i++) {
        cards[i].style.display = "none";
    }
    tbl.tHead = document.getElementsByTagName("thead");
    tbl.tBody = document.getElementsByTagName("tbody");
    localStorage.setItem("tblhtml", JSON.stringify(tbl));
    save();
}

// repopulate display with cards, hide table
function buildCards() {
    let cards = document.getElementsByClassName('card');
    for (let i = 0; i < cards.length; i++) {
        cards[i].style.display = "flex";
    }
    let champtable = document.getElementById("champtable");
    champtable.style.display = "none";
    save();
}

function save() {
    // user input and value
    var savedTable = JSON.parse(localStorage.getItem('tblhtml'));
    let input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    // table rows + body, as well as the entire table itself
    let tbody = savedTable.tBody;
    let champtable = document.getElementById("champtable");

    var isTable; // true if table was last loaded, false if cards were last loaded

    if (tbody.innerHTML != null || champtable.style.display != "none") {
        isTable = true;
    } else {
        isTable = false;
    }
    localStorage.setItem("previousSetup", JSON.stringify(isTable));
}
function setup() {
    var isTable = JSON.parse(localStorage.getItem("previousSetup"));
    if (isTable) {
        getChamps(buildTable);
    } else {
        buildCards();
    }
}

// functions for championInfo.php

function hideTable() {
    let button1 = document.getElementById("hide");
    let button2 = document.getElementById("show");
    button1.style.display = "none";
    button2.style.display = "flex";
    let table = document.getElementById("champtable");
    table.style.display = "none";
}

function showTable() {
    let button1 = document.getElementById("hide");
    let button2 = document.getElementById("show");
    button1.style.display = "flex";
    button2.style.display = "none";
    $('#champtable').css('display', '')
}
