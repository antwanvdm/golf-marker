import '../css/main.css';
import MapBoxInteraction from './MapBoxInteraction';

window.addEventListener("load", init);
let mapBoxInteraction;

function init()
{
    document.querySelector("body").classList.add('loaded');
    if (document.location.pathname !== "/") {
        return;
    }

    mapBoxInteraction = new MapBoxInteraction(getCurrentLocation);
    document.querySelector("#kmRange").addEventListener('keyup', (e) => mapBoxInteraction.updateRangeCircle(e.target.value));
    document.querySelector("#find-your-marker-form").addEventListener('submit', formSubmitHandler);
}

function getCurrentLocation()
{
    navigator.geolocation.getCurrentPosition((position) => {
        mapBoxInteraction.addCurrentLocation(position.coords.latitude, position.coords.longitude);
    }, () => {
        alert("Sorry, zonder je locatie kun je deze app niet gebruiken!");
    });
}

function formSubmitHandler(e)
{
    e.preventDefault();
    document.querySelectorAll("input").forEach((el) => el.classList.remove("error"));

    if (document.querySelector("#approve-terms").checked == false) {
        document.querySelector("#approve-terms+label").classList.add("error");
        return;
    } else {
        document.querySelector("#approve-terms+label").classList.remove("error");
    }

    fetch('http://localhost:9999', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            location: mapBoxInteraction.currentLocation,
            name: document.querySelector("#name").value,
            email: document.querySelector("#email").value,
            dateTime: document.querySelector("#dateTime").value,
            handicap: document.querySelector("#handicap").value,
            kmRange: document.querySelector("#kmRange").value
        })
    }).then((response) => {
        return response.json();
    }).then((data) => {
        if (typeof data.error !== 'undefined') {
            if (typeof data.errorDetail !== "undefined") {
                for (const [key, value] of Object.entries(data.errorDetail)) {
                    document.querySelector("#" + key).classList.add("error");
                }
            }
        }
        setResult(data.results)
    });
}

function setResult(results)
{
    document.querySelector("#find-your-marker-form").remove();
    mapBoxInteraction.disable();

    let text = `Dank voor het invullen van data. Op dit moment zijn er helaas nog geen matches gevonden. <br/><br/>Zodra er een match beschikbaar is door iemand anders zijn/haar invulling, ontvangen jullie beide een email met elkaars contactgegevens.`;
    if (results !== false) {
        text = `Gefeliciteerd, er zijn 1 of meerdere matches gevonden! Jij en je match(es) ontvangen een mail met elkaars contactgegevens. Vanuit hier kun je zien wat de handicap is, evenals de aangegeven starttijd. <br/><br/>Voor matchmaking purposes berekenen we altijd 1 uur voor en 1 uur na starttijd om de kans op het vinden van een marker te vergroten. Veel succes met contact leggen, en alvast plezier op de door jullie gekozen golfbaan!`;
    }

    document.querySelector("#paragraph-text").innerHTML = text;
}
