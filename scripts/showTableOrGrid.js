/* Sources used
1)https://www.w3schools.com/js/js_json_parse.asp
2)https://www.w3schools.com/tags/tag_img.asp
3)
4)
*/

// This JS file will be where we allow users to choose whether or not to view champs in a grid-style
// or table style. We will make an AJAX query to get all the information needed for the champions

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
        newCell.innerHTML = "<p>" + (i + 1) + "</p>";

        // add champ icon TODO
        var newCell = newRow.insertCell(1);
        newCell.innerHTML = '<img style="padding-top: 0px; width: auto; box-shadow: 0px 0px 0px black;" src="./champArt/' +
            champs[i]["name"] + 'Icon.png" alt="' + champs[i]["name"] +
            '" width="25" height="25">';

        // add champ name
        var newCell = newRow.insertCell(2);
        newCell.innerHTML = "<p id='chtbnm'>" + champs[i]["name"] + "</p>";

        // add champ win rate
        var newCell = newRow.insertCell(3);
        newCell.innerHTML = "<p>" + champs[i]["winRate"] + "</p>";

        // add champ pick rate
        var newCell = newRow.insertCell(4);
        newCell.innerHTML = "<p>" + champs[i]["pickRate"] + "</p>";
    }

    // since we built the table, hide all the cards
    let cards = document.getElementsByClassName('card');
    for (let i = 0; i < cards.length; i++) {
        cards[i].style.display = "none";
    }
}

// repopulate display with cards, hide table
function buildCards() {
    let cards = document.getElementsByClassName('card');
    for (let i = 0; i < cards.length; i++) {
        cards[i].style.display = "flex";
    }
    let champtable = document.getElementById("champtable");
    champtable.style.display = "none";
}
