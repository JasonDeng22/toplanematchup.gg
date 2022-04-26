// https://www.geeksforgeeks.org/search-bar-using-html-css-and-javascript/
// https://stackoverflow.com/questions/5338716/get-multiple-elements-by-id
// https://www.geeksforgeeks.org/how-to-select-all-elements-that-contains-some-specific-css-property-using-jquery/
// https://www.codingnepalweb.com/search-bar-autocomplete-search-suggestions-javascript/
// https://stackoverflow.com/questions/1026069/how-do-i-make-the-first-letter-of-a-string-uppercase-in-javascript

// this below codeis for the search functionality on the home page.
// we will need to autocomplete / recommend searches as the user types.

const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
const icon = searchWrapper.querySelector(".icon");
let linkTag = searchWrapper.querySelector("a");
let webLink;

function submits() {
    let input = document.getElementById('input');
    input.value = input.value.toLowerCase();
    console.log(input.value);

    if (input.value) {
        input.value = capitalizeFirstLetter(input.value);
        // localhost link
        webLink = `http://localhost/cs4640/project/?command=championInfo&champName=${input.value}`
        // CS4640 server link
        // webLink = `https://cs4640.cs.virginia.edu/jd3pgy/project/?command=championInfo&champName=${input.value}`
        linkTag.setAttribute("href", webLink);
        linkTag.click();
    }
    return false;
}

// function for capitalizing the first letter, since input will be converted to all lowercase
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

// if user press any key and release
inputBox.onkeyup = (e) => {
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if (userData) {
        icon.onclick = () => {

            // localhost link
            webLink = `http://localhost/cs4640/project/?command=championInfo&champName=${userData}`
            // CS4640 server link
            // webLink = `https://cs4640.cs.virginia.edu/jd3pgy/project/?command=championInfo&champName=${userData}`
            linkTag.setAttribute("href", webLink);
            linkTag.click();
        }
        emptyArray = suggestions.filter((data) => {
            //filtering array value and user characters to lowercase and return only those words which include user enetered chars
            return data.toLocaleLowerCase().includes(userData.toLocaleLowerCase());
        });
        emptyArray = emptyArray.map((data) => {
            // passing return data inside li tag
            return data = `<li>${data}</li>`;
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
        }
    } else {
        searchWrapper.classList.remove("active"); //hide autocomplete box
    }
}

function select(element) {
    let selectData = element.textContent;
    inputBox.value = selectData;
    icon.onclick = () => {
        // localhost link
        webLink = `http://localhost/cs4640/project/?command=championInfo&champName=${selectData}`
        // CS4640 server link
        // webLink = `https://cs4640.cs.virginia.edu/jd3pgy/project/?command=championInfo&champName=${selectData}`
        linkTag.setAttribute("href", webLink);
        linkTag.click();
    }
    searchWrapper.classList.remove("active");
}

function showSuggestions(list) {
    let listData;
    if (!list.length) {
        userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;
    } else {
        listData = list.join('');
    }
    suggBox.innerHTML = listData;
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