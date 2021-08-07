function shuffle(array) {
        var currentIndex = array.length,
                temporaryValue,
                randomIndex;

        while (currentIndex !== 0) {
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
        }

        return array;
}

let toggledCards = []; // to store cards in this array

let matchedB = 0;
const allPairs = 10;

const deckA = document.querySelector(".deckA  ");

pressed = false;

function shuffleDeck() {
        const cardsForShufflingA = Array.from(
                document.querySelectorAll(".deckA li")
        );
        const shuffledCardsA = shuffle(cardsForShufflingA);
        for (card of shuffledCardsA) {
                deckA.appendChild(card);
        }
        const cardsForShufflingB = Array.from(
                document.querySelectorAll(".deckB li")
        );
        const shuffledCardsB = shuffle(cardsForShufflingB);
        for (card of shuffledCardsB) {
                deckB.appendChild(card);
        }
}

shuffleDeck();

deckA.addEventListener("click", appearCard);

function appearCard() {
        const press = event.target;
        if (
                press.classList.contains("card") &&
                !press.classList.contains("match") &&
                toggledCards.length < 2 &&
                !toggledCards.includes(press)
        ) {
                toggleCard(press);
                addToggledCard(press);

                if (toggledCards.length === 2) {
                        isMatch(press);
                }
        }
}

function toggleCard(press) {
        press.classList.toggle("open");
        press.classList.toggle("show");
}

function addToggledCard(press) {
        toggledCards.push(press);
        console.log(toggledCards);
}

function isMatch() {
        if (
                toggledCards[0].firstElementChild.className ===
                toggledCards[1].firstElementChild.className
        ) {
                toggledCards[0].classList.toggle("match");
                toggledCards[1].classList.toggle("match");
                toggledCards = [];
                matchedB++;
                document.getElementById("score").innerHTML = `${matchedB}/10 `;
                setTimeout(function () {
                        alertPos();
                }, 200);
                setTimeout(function () {
                        win();
                }, 2000);
        } else {
                setTimeout(function () {
                        toggleCard(toggledCards[0]);
                        toggleCard(toggledCards[1]);
                        toggledCards = [];
                }, 1000);
        }
}

function gameOver() {
        resetCards();
}

function resetCards() {
        const cardsA = document.querySelectorAll(".deckA li");
        const cardsB = document.querySelectorAll(".deckA li");
        for (cardA of cardsA) {
                cardA.className = "card";
        }
        for (cardB of cardsB) {
                cardB.className = "card";
        }
}

function win() {
        if (matchedB === allPairs) {
                setTimeout(function () {
                        gameOver();
                }, 3000);
                
                document.getElementById("score").innerHTML = `0/10 `;
                matchedB=0;
        }
}
function alertPos() {
        if (matchedB === allPairs) {
                const cardClick = document.querySelector(".card  ");
                cardClick.setAttribute("data-toggle","modal");
                cardClick.setAttribute("data-target","#wingame");
                cardClick.click();
                cardClick.removeAttribute("data-target");
                cardClick.removeAttribute("data-toggle");
        }
}
