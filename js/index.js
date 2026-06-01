const connecte = (typeof estConnecte !== 'undefined') ? estConnecte : false;

function etoiles(note) {
    if (!note) return '<span class="etoiles" aria-label="Pas encore de note">☆☆☆☆☆ <small>(0 avis)</small></span>';
    const n = parseFloat(note);
    let label = '';
    for (let i = 1; i <= 5; i++) label += i <= Math.round(n) ? '★' : '☆';
    return `<span class="etoiles" aria-label="Note : ${n.toFixed(1)} sur 5">${label} <small>(${n.toFixed(1)}/5)</small></span>`;
}

function afficherMagasin(magasins) {
    const liste = document.getElementById("magasinsListe");
    liste.innerHTML = "";
    if (!magasins || magasins.length === 0) {
        liste.innerHTML = "<p style='color:#aaa;padding:1rem'>Aucun magasin trouvé.</p>";
        return;
    }
    magasins.forEach(magasin => {
        const article = document.createElement("a");
        article.href = "ficheMagasin.php?idMag=" + magasin.idMag;
        article.setAttribute("class", "magasin");
        article.setAttribute("role", "listitem");
        article.setAttribute("aria-label", "Voir la fiche de " + magasin.nomMag);

        article.setAttribute("role", "listitem");

        const divGauche = document.createElement("div");
        divGauche.setAttribute("class", "gauche");
        const img = document.createElement("img");
        img.src = "img/" + magasin.imgSrc;
        img.setAttribute("class", "imgMag");
        img.setAttribute("alt", "Photo du magasin " + magasin.nomMag);
        divGauche.appendChild(img);

        const divDroit = document.createElement("div");
        divDroit.setAttribute("class", "droit");

        const h3 = document.createElement("h3");
        h3.textContent = magasin.nomMag;      


        const p1 = document.createElement("p");
        p1.textContent = magasin.adresse + " " + magasin.codePostal + ", " + magasin.ville;

        const p2 = document.createElement("p");
        p2.textContent = "Produits : " + magasin.listeProd;

        const pNote = document.createElement("p");
        pNote.innerHTML = etoiles(magasin.moyenneNote);

        const divBouton = document.createElement("div");
        divBouton.setAttribute("class", "boutons");

        const aCarte = document.createElement("a");
        aCarte.href = "carte-des-magasins.php?idMagasin=" + magasin.idMag;
        aCarte.textContent = "Voir sur la carte";
        aCarte.setAttribute("class", "boutonLogin");
        aCarte.setAttribute("aria-label", "Voir " + magasin.nomMag + " sur la carte");
        divBouton.appendChild(aCarte);

        if (connecte) {
            const aNoter = document.createElement("a");
            aNoter.href = "noter.php?idMag=" + magasin.idMag;
            aNoter.textContent = "⭐ Noter";
            aNoter.setAttribute("class", "boutonLogin");
            aNoter.setAttribute("aria-label", "Noter le magasin " + magasin.nomMag);
            divBouton.appendChild(aNoter);
        }

        divDroit.appendChild(h3);
        divDroit.appendChild(p1);
        divDroit.appendChild(p2);
        divDroit.appendChild(pNote);
        divDroit.appendChild(divBouton);
        article.appendChild(divGauche);
        article.appendChild(divDroit);
        liste.appendChild(article);
    });
}

function listerMagasins() {
    fetch('http://localhost/peguy/appliVegan/php/lister.php')
        .then(res => res.json())
        .then(magasins => afficherMagasin(magasins))
        .catch(() => document.getElementById("magasinsListe").innerHTML = "<p style='color:#aaa'>Impossible de charger les magasins.</p>");
}

if (document.getElementById("filtre")) {
    document.querySelectorAll("#filtre button").forEach(btn => {
        btn.addEventListener("click", function () {
            document.querySelectorAll("#filtre button").forEach(b => b.classList.remove("actif"));
            this.classList.add("actif");
            const filtre = this.dataset.filtre;
            if (filtre === "tous") listerMagasins();
            else filtrerProduit(filtre);
        });
    });
}

function filtrerProduit(value) {
    fetch('http://localhost/peguy/appliVegan/php/filtrerProduit.php?filtre=' + value)
        .then(res => res.json())
        .then(magasins => 
            afficherMagasin(magasins)
        );
}

if (document.getElementById("selecteurVille")) {
    const selecteur = document.getElementById("selecteurVille");
    if (typeof villePreselect !== 'undefined' && villePreselect !== '') {
        selecteur.value = villePreselect;
        filtrerVille(villePreselect);
    }
    selecteur.addEventListener("change", function () {
        const valeur = this.value;
        if (valeur === "tous") {
            listerMagasins();
        }
        else {
            filtrerVille(valeur);
        }
    });
}

function filtrerVille(value) {
    fetch('http://localhost/peguy/appliVegan/php/filtrerVille.php?selecteurVille=' + value)
        .then(res => res.json())
        .then(magasins => 
            afficherMagasin(magasins)
        );
}

if (document.getElementById("recherche")) {
    document.getElementById("recherche").addEventListener("input", function () {
        const value = this.value.trim() || 'noSearch';
        fetch('http://localhost/peguy/appliVegan/php/rechercher.php?recherche=' + encodeURIComponent(value))
            .then(res => res.json())
            .then(magasins => { 
                if (magasins){
                    afficherMagasin(magasins);
                } 
                else {
                    listerMagasins();

                } 
            });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("magasinsListe")) {
        if (typeof villePreselect === 'undefined' || villePreselect === ''){
            listerMagasins();
        } 
    }
});
