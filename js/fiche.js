function etoiles(note, grand = false) {
    if (!note) return '<span class="etoiles">☆☆☆☆☆ <small>(0 avis)</small></span>';
    const n = parseFloat(note);
    let html = '';
    for (let i = 1; i <= 5; i++) html += i <= Math.round(n) ? '★' : '☆';
    const size = grand ? 'font-size:1.8rem' : '';
    return `<span class="etoiles" style="${size}" aria-label="Note ${n.toFixed(1)} sur 5">${html} <small>(${n.toFixed(1)}/5)</small></span>`;
}

fetch('http://localhost/peguy/appliVegan/php/getFicheMagasin.php?idMag=' + idMag)
    .then(res => res.json())
    .then(mag => {
        if (!mag) {
            document.getElementById('fiche-contenu').innerHTML = '<p style="color:#aaa;text-align:center;padding:2rem">Magasin introuvable.</p>';
            return;
        }

        // Commentaires
        let htmlCommentaires = '';
        if (mag.commentaires && mag.commentaires.length > 0) {
            mag.commentaires.forEach(c => {
                let etoilesComm = '';
                for (let i = 1; i <= 5; i++) etoilesComm += i <= c.note ? '★' : '☆';
                const date = c.dateCom ? new Date(c.dateCom).toLocaleDateString('fr-FR') : '';
                htmlCommentaires += `
                    <article class="commentaire" aria-label="Avis de ${c.prenom} ${c.nom}">
                        <div class="comm-header">
                            <span class="comm-auteur">${c.prenom} ${c.nom}</span>
                            <span class="comm-etoiles">${etoilesComm}</span>
                            <span class="comm-date">${date}</span>
                        </div>
                        <p class="comm-titre"><strong>${c.titre}</strong></p>
                        <p class="comm-contenu">${c.contenu}</p>
                    </article>`;
            });
        } else {
            htmlCommentaires = '<p style="color:#aaa">Aucun avis pour ce magasin.</p>';
        }

        const boutonNoter = estConnecte
            ? `<a href="noter.php?idMag=${mag.idMag}" class="boutonLogin" aria-label="Noter ${mag.nomMag}">⭐ Laisser un avis</a>`
            : `<a href="connexionUtilisateur-Form.php" class="boutonLogin">Connectez-vous pour noter</a>`;

        document.getElementById('fiche-contenu').innerHTML = `
            <div class="fiche-hero">
                <img src="img/${mag.imgSrc}" alt="Photo de ${mag.nomMag}" class="fiche-img">
                <div class="fiche-infos">
                    <h1 class="fiche-nom">${mag.nomMag}</h1>
                    ${etoiles(mag.moyenneNote, true)}

                    <ul class="fiche-details" aria-label="Informations du magasin">
                        <li>📍 ${mag.adresse}, ${mag.codePostal} ${mag.ville}</li>
                        <li>📞 <a href="tel:${mag.numMag}">${mag.numMag}</a></li>
                        <li>✉️ <a href="mailto:${mag.mailMag}">${mag.mailMag}</a></li>
                        <li>🌿 Produits : ${mag.listeProd || 'Non renseignés'}</li>
                    </ul>

                    <div class="fiche-boutons">
                        <a href="carte-des-magasins.php?idMagasin=${mag.idMag}" class="boutonLogin">🗺️ Voir sur la carte</a>
                        ${boutonNoter}
                        <a href="magasin.php" class="boutonLogin bouton-retour">← Retour</a>
                    </div>
                </div>
            </div>

            <section class="fiche-commentaires" aria-labelledby="titre-avis">
                <h2 id="titre-avis">Avis des clients</h2>
                <div class="liste-commentaires">${htmlCommentaires}</div>
            </section>
        `;

        // Mettre à jour le titre de la page
        document.title = `VeganShopFinder | ${mag.nomMag}`;
    })
    .catch(() => {
        document.getElementById('fiche-contenu').innerHTML = '<p style="color:#aaa;text-align:center;padding:2rem">Impossible de charger la fiche.</p>';
    });
