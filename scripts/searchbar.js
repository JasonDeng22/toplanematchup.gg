// https://www.geeksforgeeks.org/search-bar-using-html-css-and-javascript/
// https://stackoverflow.com/questions/5338716/get-multiple-elements-by-id
// https://www.geeksforgeeks.org/how-to-select-all-elements-that-contains-some-specific-css-property-using-jquery/
function champListSearch() {
    let input = document.getElementById('searchbar');
    input.value = input.value.toLowerCase();
    let cards = document.getElementsByClassName('card');
    //console.log(cards);
    let names = document.querySelectorAll('[id=name]');
    //console.log(names);
    // loop through all the cards. if the text content of the <p> with id="name" includes the input from
    // search bar, then include that card in the DOM. Otherwise, don't display it

    for (let i = 0; i < cards.length; i++) {
        if (!names[i].textContent.toLowerCase().includes(input.value)) {
            cards[i].style.display = "none";
        }
        else {
            cards[i].style.display = "flex";
        }
    }

    //input.value = "";
    // if every single card has display = none, then write to DOM the champ wasn't found
    // let allNone = true;
    // let row = document.getElementsByClassName('row');
    // if (row[1].innerHTML.toLowerCase().includes("display: flex")) {
    //     allNone = false;
    // }
    // if (allNone) {
    //     $("#row").innerHTML = "<h3 style='color: white; text-align: center'>No Champs Found</h3>"
    // }
}