const a = document.querySelector("#aereiOK").getElementsByTagName("tr")
const p = document.querySelector("#pilotiOK").getElementsByTagName("tr")
const ass = document.querySelector("#assOK").getElementsByTagName("tr")

let posti
let idVelivolo
let dataOraPartenza = document.querySelector("#conf_part").textContent
let dataPartenza = dataOraPartenza.split("T")[0]
let oraPartenza = dataOraPartenza.split("T")[1]
let idAeroOrig = document.querySelector("#conf_orig").textContent
let idAeroDest = document.querySelector("#conf_dest").textContent
let durata
let ore
let numPil
let numAss

let okVelivolo = false
let okPiloti = false
let okAssistenti = false

for (let i = 1; i < a.length; i++) {
    a[i].addEventListener("click", function () {
        if (this.className != "selA") {
            let old = document.querySelector(".selA")
            if (old) {
                old.style.backgroundColor = ""
                old.classList.remove("selA")
            }
            this.style.backgroundColor = "#04AA6D"
            this.classList.add("selA")
            okVelivolo = true
        } else {
            this.style.backgroundColor = ""
            this.classList.remove("selA")
            okVelivolo = false
        }
        posti = this.childNodes[5].textContent
        idVelivolo = this.childNodes[1].textContent
        durata = document.querySelector("#conf_dura").textContent
        ore = durata.split(":")[0]
        if (ore < 10) {
            numPil = 2
        } else {
            numPil = 4
        }
        numAss = Math.floor(posti / 50) + 1
        clearOldSelection()
    })
}

for (let i = 1; i < p.length; i++) {
    p[i].addEventListener("click", function () {
        if (numPil) {
            let currentSelP;
            if (this.className != "selP") {
                this.classList.add("selP")
                currentSelP = document.querySelectorAll(".selP")
                if (currentSelP.length >= numPil) {
                    for (let i = 0; i < currentSelP.length; i++) {
                        currentSelP[i].style.backgroundColor = "#04AA6D"
                    }
                    okPiloti = true
                } else {
                    this.style.backgroundColor = "#DC143C"
                }
            } else {
                this.style.backgroundColor = ""
                this.classList.remove("selP")
                currentSelP = document.querySelectorAll(".selP")
                if (currentSelP.length < numPil) {
                    for (let i = 0; i < currentSelP.length; i++) {
                        currentSelP[i].style.backgroundColor = "#DC143C"
                    }
                    okPiloti = false
                }
            }
        }

    })
}

for (let i = 1; i < ass.length; i++) {
    ass[i].addEventListener("click", function () {
        if (numAss) {
            let currentSelAss;
            if (this.className != "selAss") {
                this.classList.add("selAss")
                currentSelAss = document.querySelectorAll(".selAss")
                if (currentSelAss.length >= numAss) {
                    for (let i = 0; i < currentSelAss.length; i++) {
                        currentSelAss[i].style.backgroundColor = "#04AA6D"
                    }
                    okAssistenti = true
                } else {
                    this.style.backgroundColor = "#DC143C"
                }
            } else {
                this.style.backgroundColor = ""
                this.classList.remove("selAss")
                currentSelAss = document.querySelectorAll(".selAss")
                if (currentSelAss.length < numAss) {
                    for (let i = 0; i < currentSelAss.length; i++) {
                        currentSelAss[i].style.backgroundColor = "#DC143C"
                    }
                    okAssistenti = false
                }
            }
        }
    })
}

function confirm() {
    if(okVelivolo && okPiloti && okAssistenti) {
        let infoVolo = JSON.stringify({"durata":durata, "data":dataPartenza, "ora":oraPartenza, "idVelivolo":idVelivolo, "codiceAeroportoOrigine":idAeroOrig, "codiceAeroportoDest":idAeroDest})
        let personaleVolo = []
        let scali = []


        if(document.querySelector("#conf_sca1")){
            scali.push(document.querySelector("#conf_sca1").innerHTML)
        }
        if(document.querySelector("#conf_sca2")){
            scali.push(document.querySelector("#conf_sca2").innerHTML)
        }
        if(document.querySelector("#conf_sca3")){
            scali.push(document.querySelector("#conf_sca3").innerHTML)
        }

        let pilotNodes = document.querySelectorAll(".selP > td:first-child")
        let assNodes = document.querySelectorAll(".selAss > td:first-child")
        pilotNodes.forEach(td => {
            personaleVolo.push(td.textContent)
        });
        assNodes.forEach(td => {
            personaleVolo.push(td.textContent)
        })

        const formData = new FormData();
        formData.append('infoVolo', infoVolo);
        formData.append('personale', JSON.stringify(personaleVolo));
        if(scali.length > 0) {
            formData.append('scali', JSON.stringify(scali))
        }
        axios.post("carica_dati_volo.php", formData)
        .then(function(response){
            if (response["statusText"] = "OK") {
                window.location.href = window.location.href
            }
        })
    }
}

function clearOldSelection() {
    let selP = document.querySelectorAll(".selP")
    let selAss = document.querySelectorAll(".selAss")
    okPiloti = false
    okAssistenti = false


    if (selP) {
        for (let i = 0; i < selP.length; i++) {
            selP[i].style.backgroundColor = ""
            selP[i].classList.remove("selP")
        }
    }
    if (selAss) {
        for (let i = 0; i < selAss.length; i++) {
            selAss[i].style.backgroundColor = ""
            selAss[i].classList.remove("selAss")
        }
    }
}