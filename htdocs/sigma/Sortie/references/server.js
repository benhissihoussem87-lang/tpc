const express=require('express');
const mysql=require('mysql');
const fs = require('fs');
const app=express();
const fileUpload = require('express-fileupload');
const bodyParser = require('body-parser');
var session = require('express-session');
var flash = require('req-flash');
app.use(session({secret: 'keyboard cat'}))
app.use(bodyParser.urlencoded({ extended: false }));
app.use(fileUpload());
app.use(bodyParser.json()); // parse form data client
app.use(express.static('assets'));
app.use(flash());

fs.readFile('test.txt', function (err, data) {
    var dataArray = data;
    //console.log(dataArray[1]);
  });
const {Declaration_Absences,Gestion_Declaration_Absences,authentification,authentificationAdmin,deconnexion,deconnexions,HomeFaculte,AjoutSystemeEnseignement,envois,envoisSpecifie,envoisTous,envois_enseignantEtudiant,envois_enseignant_etudiant,envoisRattrappage,AfficherGroupe,ConsulterGroupe,AjoutGroupe,GestionSpecialites,GestionGroupes,homeEtablissement,seconnecter,connecter,SystemeEnseignement,GestionSpecialite,Evenement_Ajout,Avis_Ajout,Avis_Ajout_Niveaux,evenement_Afficher,Affectation_salle_Examen,dashboard,envois_emplois,notifications,detailnotification} = require('./routes/routes');
const {AjoutNumInscription,AjouterNumInscription,AjouterNumInscriptions,getNumInscription,getNumInscriptionRechGroupe,demandeInscription,Autorisation,AutorisationDashboard} = require('./routes/routesInscription');
const {Afficher,Afficher2,DeleteGroupe,RechercheGroupe} = require('./routes/routesGroupes');
const {HomeEtudiant,messagerie_etudiant,Home_Etudiant,relation_enseignant_Etudiant,Home_Etudiant2,Groupe_Etudiant_notes,planningEtudiant_Calendrier,planning_Etudiant,Groupe_Etudiant_avis,Enseignant_Etudiant,Modifier_Photo_Etudiant,Tous_les_avisEtudiants,Tous_cours,Tous_tds,detailEnvois,ProfilEtudiant,Modifier_Infos_PersonnelEtudiant,DeleteNumInscription} = require('./routes/routesEtudiants');
const {AjoutEnseignant,AfficherEnseignants,messagerie_enseignant,compte_enseignant,messagerie_enseignant_etudiant,Afficher_Groupe_Enseignant,Gestion_Enseignants,AffecterEnseignant,getNumEtudiantsGroupe,getNumEtudiantsGroupe2,Modifier_Infos_Personnel,photos_enseignant,Modifier_mdp_Enseignant,Planning_Enseignant,HomeEnseignant,HomeEnseignant2,Declaration_absence_enseignant,AvisEnseignants,ProfilEnseignant,deleteAffectationEnseignant,deleteEnseignant,getEtudiantsClasse} = require('./routes/routesEnseignant');
const {AfficherSpecialite} = require('./routes/routesSpecialites');
const { Server } = require('http');
app.get('/uma',authentificationAdmin);
app.get('/',authentification);
//app.get('/index2',authentification2);
app.get('/dashboard',dashboard);
app.post('/',seconnecter);
app.post('/uma',connecter);
app.get('/deconnexion',deconnexion);
app.get('/deconnexions',deconnexions);
app.get('/Faculte',HomeFaculte);
app.get('/Enseignant',HomeEnseignant);
app.get('/AvisEnseignants',AvisEnseignants);
app.get('/Enseignant2',HomeEnseignant2);
app.get('/ProfilEnseignant',ProfilEnseignant);
app.get('/ProfilEtudiant',ProfilEtudiant);
app.get('/Etudiants',Home_Etudiant);
/*app.get('/Relation_Enseignant',relation_enseignant_Etudiant);*/
app.get('/detailEnvois/:id',detailEnvois);
app.get('/Cours',Tous_cours);
app.get('/Tds',Tous_tds);
app.get('/Tous_les_avis',Tous_les_avisEtudiants);
app.get('/Etudiants2',Home_Etudiant2);
app.get('/SystemeEnseignement',SystemeEnseignement);
app.post('/SystemeEnseignement',AjoutSystemeEnseignement);
app.get('/homeEtablissement',homeEtablissement);
app.get('/GestionSpecialite',GestionSpecialite);
app.post('/Evenement_Ajout',Evenement_Ajout);
app.post('/Avis_Ajout',Avis_Ajout);
app.post('/Avis_Ajout_Niveaux',Avis_Ajout_Niveaux);
app.post('/GestionSpecialite',GestionSpecialites);
app.get('/GestionGroupes',GestionGroupes);
app.get('/GestionEnseignants',Gestion_Enseignants);
app.post('/GestionGroupes',AjoutGroupe);
app.get('/AfficherGroupes',AfficherGroupe);
app.get('/AfficherSpecialite',AfficherSpecialite);
app.post('/AfficherGroupes',ConsulterGroupe);
app.get('/RechercheGroupe/:id/:abriviation',RechercheGroupe);
app.get('/AjoutNumInscription/:id/:nomGroupe',AjoutNumInscription);
app.get('/getNumInscription/:nomGroupe',getNumInscription); 
app.get('/getNumInscriptionRechGroupe/:nomGroupe/:filiere/:categorie/:niveaux/:specialite/:abriviation',getNumInscriptionRechGroupe);
app.get('/getEtudiantsClasse/:classe',getEtudiantsClasse);

app.get('/getNumEtudiantsGroupe/:nomGroupe/:filiere/:categorie/:niveaux/:specialite/:abriviation',getNumEtudiantsGroupe);
//app.get('/getNumEtudiantsGroupe2/:nomGroupe/:filiere/:categorie/:niveaux/:specialite/:abriviation',getNumEtudiantsGroupe2);
app.post('/AjoutNumInscription/:nomGroupe',AjouterNumInscription);
app.post('/AjouterNumInscription',AjouterNumInscriptions);
app.post('/AffecterEnseignant',AffecterEnseignant);
app.post('/demandeInscription',demandeInscription);
app.post('/envois',envois);
app.post('/envois_emplois',envois_emplois);
app.post('/envoisSpecifie',envoisSpecifie);
app.post('/envoisTous',envoisTous);
app.post('/envois_enseignant',envois_enseignant_etudiant);
app.post('/Declaration_absence_enseignant',Declaration_absence_enseignant);
app.post('/envois_enseignant_Etudiant',envois_enseignantEtudiant);
app.post('/envoisRattrappage',envoisRattrappage);
app.post('/AjoutEnseignant',AjoutEnseignant);
app.get('/AfficherEnseignants/:abriviation/:groupe',AfficherEnseignants);
app.get('/Groupe_Afficher/',Afficher);
app.get('/Groupe_Afficher2/',Afficher2);
app.get('/Groupe_Enseignant/',Afficher_Groupe_Enseignant);
app.get('/Planning_Enseignant/',Planning_Enseignant);
app.get('/SupprimerGroupe/:id',DeleteGroupe);
app.get('/messagerie_enseignant/',messagerie_enseignant);
app.get('/Compte/',compte_enseignant);
app.post('/Modifier_Photo_Enseignant/',photos_enseignant);
app.post('/Modifier_Photo_Etudiant/',Modifier_Photo_Etudiant);
app.post('/Affectation_salle_Examen/',Affectation_salle_Examen);
app.post('/Modifier_mdp_Enseignant/',Modifier_mdp_Enseignant);
app.post('/Modifier_Info_Personnel/',Modifier_Infos_Personnel);
app.post('/Modifier_Infos_PersonnelEtudiant/',Modifier_Infos_PersonnelEtudiant);
app.get('/Groupe_Etudiant_notes',Groupe_Etudiant_notes);
app.get('/Groupe_Etudiant_avis',Groupe_Etudiant_avis);
app.get('/planning_Etudiant',planning_Etudiant);
app.get('/Enseignant_Etudiant',Enseignant_Etudiant);
app.get('/planningEtudiant_Calendrier/',planningEtudiant_Calendrier);
app.get('/messagerie_enseignant_etudiant/',messagerie_enseignant_etudiant);
app.get('/messagerie_etudiant/',messagerie_etudiant);
app.get('/Etudiant/',HomeEtudiant);
app.get('/evenement_Afficher/',evenement_Afficher);
app.post('/Autorisation/:id/:nomGroupe/:categorie/:filiere/:niveaux/:specialite/:abriviation',Autorisation);
app.post('/AutorisationDashboard/:id/:nomGroupe/:categorie/:filiere/:niveaux/:specialite/:abriviation',AutorisationDashboard);
app.get('/Declaration_Absences',Declaration_Absences);
app.get('/Gestion_Declaration_Absences/:id/:etat',Gestion_Declaration_Absences);
app.get('/deleteAffectationEnseignant/:id',deleteAffectationEnseignant);
app.get('/deleteEnseignant/:id',deleteEnseignant);
app.get('/deleteNumInscription/:id/:nomGroupe/:filiere/:categorie/:niveaux/:specialite/:abriviation',DeleteNumInscription);
app.get('/notifications',notifications);
app.get('/detailnotification/:id',detailnotification);
const port=8080;
const db=mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'diginfo',
    multipleStatements:true
});
// connect to database
db.connect((err) => {
    if (err) {
        throw err;
    }
    console.log('connexion รงa va avec BD');
});
global.db = db;

app.set('views',__dirname+'/views');
app.set('view engine', 'ejs'); // configure template engine
app.listen(port,()=>{console.log(`Server running on port: ${port}`);
});
