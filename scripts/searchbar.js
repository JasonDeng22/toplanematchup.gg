// https://www.geeksforgeeks.org/search-bar-using-html-css-and-javascript/
// https://stackoverflow.com/questions/5338716/get-multiple-elements-by-id
// https://www.geeksforgeeks.org/how-to-select-all-elements-that-contains-some-specific-css-property-using-jquery/


// this function is for the search functionality on the home page. The home page doesn't have DOM elements
// that we can manipulate, so we will need to autocomplete / recommend searches as the user types.
function homepageSearch() {

}

function champListSearch() {
    // user input and value
    let input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    // all the champion cards
    let cards = document.getElementsByClassName('card');
    // table rows + body, as well as the entire table itself
    let tr = document.getElementsByTagName("tr"); // 0 row is the head row
    let tbody = document.getElementsByTagName("tbody");
    let champtable = document.getElementById("champtable");
    // names from the cards
    let names = document.querySelectorAll('[id=name]');
    // names from the table rows
    let namesTable = document.querySelectorAll('[id=chtbnm]');

    // loop through all the cards. if the text content of the <p> with id="name" includes the input from
    // search bar, then include that card in the DOM. Otherwise, don't display it. If the table is populated
    // instead, search function should DOM manipulate that thing
    if (tbody.innerHTML != null || champtable.style.display != "none") {
        for (let i = 0; i < cards.length; i++) {
            console.log("in here");
            if (!namesTable[i].textContent.toLowerCase().includes(input.value)) {
                tr[i + 1].style.display = "none";
            }
            else {
                tr[i + 1].style.display = "";
            }
        }
    } else {
        for (let i = 0; i < cards.length; i++) {
            if (!names[i].textContent.toLowerCase().includes(input.value)) {
                cards[i].style.display = "none";
            }
            else {
                cards[i].style.display = "flex";
            }
        }
    }
}