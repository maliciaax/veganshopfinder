/*window.onload = function donneeMagasin(idMag){
    fetch('http://localhost/peguy/appliVegan/php/map.php?idMagasin='+idMag)
        .then(res => res.json())
        .then(infos => {
            const latitude = infos.latitude
            const longitude = infos.longitude
            console.log(infos.latitude,infos.longitude)
            afficherPopUp (latitude,longitude)
            
        });

}

function afficherPopUp (latitude,longitude){
    var marker = L.marker([latitude, longitude]).addTo(map);
    marker.bindPopup("<b>Hello world!</b><img src='img/profil.png'><br>jsdsdsdhjsdhj.").openPopup();
}*/

var map = L.map('map').setView([43.337528, 5.463416], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

fetch('http://localhost/peguy/appliVegan/php/map.php')
    .then(res => res.json())
    .then(magasins => {
        magasins.forEach(magasin => {
            const latitude = parseFloat(magasin.latitude);
            const longitude = parseFloat(magasin.longitude);


            if (isNaN(latitude) || isNaN(longitude)) return; // ignorer si coordonnées invalides

            const marker = L.marker([latitude, longitude]).addTo(map);
            marker.bindPopup('<b>'+magasin.nomMag+'</b><br> <img style="width: 10rem" src="img/'+magasin.imgSrc+'"><br>'+magasin.adresse);

            // Ouvrir automatiquement le popup du magasin choisi
            if (magasin.idMag == idMagasinChoisi) {
                marker.openPopup();
                map.setView([magasin.latitude, magasin.longitude], 15);
            }
        });
    });


/*let test = window.location.search
console.log(test)

var map = L.map('map').setView([43.337528, 5.463416], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);*/

//var marker = L.marker([43.329587, 5.463038]).addTo(map);
//marker.bindPopup("<b>Hello world!</b><img src='img/profil.png'><br>I am a popup.").openPopup();


