var labels=[];
var data=[];
let barChart;
//collecting the first 15 data from a json file in order to draw it using Chartjs
fetch("info.json",{cache: 'no-store'})
.then(response => response.json())
.then(json => {
    if(json.length>15){
        for ( var i = json.length-15; i < json.length; i++) {
            inter=json[i].reg_date
            labels.push(inter.slice(10));
            
            data.push(json[i].val_measure);
        }
    }
    else{
        for ( var i = 0; i < json.length; i++) {
        labels.push(json[i].reg_date.slice(10));
        data.push(json[i].val_measure);
    }
    }
//for the graphic representation
//getting the canvas element
const barCanvas=document.getElementById('barCanvas').getContext("2d");
barChart = new Chart(barCanvas,{
    type:'line',
    data:{
        labels: labels,
        datasets:[{
            label: 'Historique de valeur',
            data: data,
            fill: true,
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor:"#333",
            tension: 0.1
        }]
    }
});
barChart.update();
});

//defining a function to update the graphic representation
var changementAffichage = function(fichier){
    fetch(fichier,{cache: 'no-store'})
    .then(response => response.json())
    .then(json => {
        labels=[];
        data=[];
        if(json.length>15){
            for ( var i = json.length-15; i < json.length; i++) {
                labels.push(json[i].reg_date.slice(10));
                data.push(json[i].val_measure);
            }
        }
        else{
            for ( var i = 0; i < json.length; i++) {
            labels.push(json[i].reg_date.slice(10));
            data.push(json[i].val_measure);
        }
        }
        //pour la representation graphique
        barChart.data.labels=labels;
        barChart.data.datasets[0].data=data;
        barChart.update();
    });
}
  

//On sélectionne les liens utiles
let lienTemp, lienHemo, lienGly;
lienTemp = document.links['3'];
lienHemo = document.links['4'];
lienGly = document.links['5'];


//On utilise les propriétés gestionnaires d'évènement avec nos éléments pour gerer le second menu

let couleur='blue';
lienTemp.onclick = function(){
    let info=document.querySelector('div.info');
    let formulaire=document.querySelector('div.repr form');
    this.style.backgroundColor =couleur;
    lienHemo.style.backgroundColor ='transparent';
    lienGly.style.backgroundColor ='transparent';
    let contenu=document.querySelector('div.info');
    contenu.innerHTML=`<form action="traitementTemp.php" method="post">
    <div class="label"><label for="temp">Température (°C) :</label></div>
    <div class="entree"><input type="text" id="temp" name="temp" inputmode="numeric" placeholder="Entrez une valeur (ex 37.6)" autofocus required></div>
    <p class="default">ok</p>
    <div class="envoyer"><input type="submit" value="Envoyer"></div>
</form>`;
    let bouton_div=document.querySelector('div.envoyer');
    info.style.marginTop = "101px";
    bouton_div.style.marginTop = "101px";
    //mise à jour du graphique
    changementAffichage('temperature.json');
    formulaire.action="mesurerTemp.php";
};

lienHemo.onclick = function(){
    let info=document.querySelector('div.info');
    let formulaire=document.querySelector('div.repr form');
    this.style.backgroundColor =couleur;
    lienTemp.style.backgroundColor ='transparent';
    lienGly.style.backgroundColor ='transparent';
    let contenu=document.querySelector('div.info');
    contenu.innerHTML=`<form action="traitementHemo.php" method="post">
    <div class="label"><label for="hemo">Hémoglobine (g/dL) :</label></div>
    <div class="entree"><input type="text" id="hemo" name="hemo" inputmode="numeric" placeholder="Entrez une valeur (ex 15.2)" autofocus required></div>
    <div class="label" id="label_hct"><label for="hct">HCT (%) :</label></div>
    <div class="entree"><input type="text" id="hct" name="hct" inputmode="numeric" placeholder="Entrez une valeur (ex 35)"></div>
    <p class="default">ok</p>
    <div class="envoyer"><input type="submit" value="Envoyer"></div>
</form>`;
    let bouton_div=document.querySelector('div.envoyer');
    info.style.marginTop = "53px";
    bouton_div.style.marginTop = "53px";
    //mise à jour du graphique
    changementAffichage('hemo.json');
    formulaire.action="mesurerHemo.php";
};

lienGly.onclick = function(){
    let info=document.querySelector('div.info');
    let formulaire=document.querySelector('div.repr form');
    this.style.backgroundColor =couleur;
    lienHemo.style.backgroundColor ='transparent';
    lienTemp.style.backgroundColor ='transparent';
    let contenu=document.querySelector('div.info');
    contenu.innerHTML=`<form action="traitementGly.php" method="post">
    <div class="label"><label for="gly">Glycémie (g/L) :</label></div>
    <div class="entree"><input type="text" id="gly" name="gly" inputmode="numeric" placeholder="Entrez une valeur (ex 0.80)" autofocus required></div>
    <p class="default">ok</p>
    <div class="envoyer"><input type="submit" value="Envoyer"></div>
</form>`;
    let bouton_div=document.querySelector('div.envoyer');
    info.style.marginTop = "101px";
    bouton_div.style.marginTop = "101px";
    //mise à jour du graphique
    changementAffichage('glycemie.json');
    formulaire.action="mesurerGly.php";
};

