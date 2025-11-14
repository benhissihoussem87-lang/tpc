module.exports = {

    //Fonction d'affichage
    // Pour retourner la page Home Etudiant
    AjoutEnseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }


        let etablissement = req.body.etablissement;

        let nom = req.body.nom;

        let tel = req.body.tel;
        let grade = req.body.grade;
        let mdp = "RA2E";
        let sql = "INSERT INTO `enseignant`(`nom`, `tel`, `etablissement`,   `mdp`, `grade`) VALUES ('" + nom + "',   '" + tel + "', '" + etablissement + "', '" + mdp + "', '" + grade + "')";
        //Exécution de requete
        db.query(sql, (err, result) => {
            if (err) {
                req.session.Error = "enseignant existe déja";

                res.redirect('/GestionEnseignants');
                message: req.session.Error;
            } else {
                req.session.GestionEnseignants = " L'ajout de l'enseignant  a été effectué avec succès";

                res.redirect('/GestionEnseignants');
                message: req.session.GestionEnseignants;

            }

        }); //Fin exécution requete

    },

    // Pour retourner la page Home Enseignant
    HomeEnseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }

        let nomGroupe = req.session.groupe;
        let filiere = req.params.filiere;
        let categorie = req.session.diplome;
        let specialite = req.params.specialite;
        let niveaux = req.params.niveaux;
        let enseignant = req.session.nom;
        let dt = new Date();
        let mois = "";
        let jour = "";
        for (i = 0; i < 11; i++) {
            if (dt.getMonth() == 0) { mois = "01"; }
            if (dt.getMonth() == 1) { mois = "02"; }
            if (dt.getMonth() == 2) { mois = "03"; }
            if (dt.getMonth() == 3) { mois = "04"; }
            if (dt.getMonth() == 4) { mois = "05"; }
            if (dt.getMonth() == 5) { mois = "06"; }
            if (dt.getMonth() == 6) { mois = "07"; }
            if (dt.getMonth() == 7) { mois = "08"; }
            if (dt.getMonth() == 8) { mois = "09"; }
            if (dt.getMonth() == 9) { mois = "10"; }
            if (dt.getMonth() == 10) { mois = "11"; }
            if (dt.getMonth() == 11) { mois = "12"; }
        }
        if (dt.getDate() < 10) {
            jour = "0" + dt.getDate();
        } else {
            jour = dt.getDate();
        }
        if ((dt.getHours() - 1) < 10) {
            hr = "0" + (dt.getHours() - 1);
        } else {
            hr = dt.getHours() - 1;
        }
        //////*****Traitement de jour actuel** */
        let jourAct = dt.getDay();
        let jourActuel = "";
        if (jourAct == 1) {
            jourActuel = "Lundi\r";
        } else if (jourAct == 2) {
            jourActuel = "Mardi\r";
        } else if (jourAct == 3) {
            jourActuel = "Mercredi\r";
        } else if (jourAct == 4) {
            jourActuel = "Jeudi\r";
        } else if (jourAct == 5) {
            jourActuel = "Vendredi\r";
        } else if (jourAct == 6) {
            jourActuel = "Samedi\r";
        }
        /******** Fintraitement **** */
        let date_declaration = dt.getFullYear() + "-" + mois + "-" + jour;
        let heure = hr + ":" + dt.getMinutes();
        console.log("Heure " + heure);
        console.log("Enseignant " + enseignant);
        console.log('Id Prof ' + req.session.id_prof);
        let enseignantUser = req.session.nom;

        db.query("select * from enseignant where etablissement='" + req.session.etablissement + "' order by id Desc;select distinct(classe) from  emplois_du_temps where enseignant='" + req.session.nom + "' order by horaire Asc;select * from  envois where etablissement='" + req.session.etablissement + "'   order by id Desc;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' and type_document='Calendrier examen' order by id Desc limit 1 ;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' and type_document='Emplois du temps' order by id Desc limit 1;select * from nb_inscriptions where  nom_groupe='" + nomGroupe + "' and etablissement='" + req.session.etablissement + "' and categroie_diplome='" + categorie + "'and niveaux='" + niveaux + "' and filiere='" + filiere + "' and specialite='" + specialite + "' order by id Desc;select * from  nb_inscriptions where etablissement='" + req.session.etablissement + "' ;select * from groupes_enseignant where enseignant='" + enseignant + "' and  etablissement='" + req.session.etablissement + "' order by id Desc;select * from  evenements where etablissement='" + req.session.etablissement + "' and type='evenement' order by id Desc limit 1;select * from  enseignant where id='" + req.session.id_prof + "';select * from  emplois_du_temps where enseignant='" + enseignantUser + "' and jour='" + jourActuel + "';select distinct horaire,jour,nature,salle,Matiere from  emplois_du_temps  where enseignant='" + enseignantUser + "' ORDER BY horaire ;select * from notifications where destination='tous Enseignants' or type='un événement' ORDER BY date_creation,heure_envois DESC;select * from  emplois_du_temps  where enseignant='" + enseignantUser + "' ORDER BY horaire", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13], function(err, result) {
            if (err) throw err;
            // req.session.msgdeclarationAbsence=""; 
            req.session.msgEnvois_enseignant_etudiant = "";
            req.session.msgEnvois_enseignant_etudiantFile = "";
            res.render('enseignant/homeEnseignant.ejs', {

                etablissement: req.session.etablissement,
                enseignants: result[0],
                enseignants_Groupe: result[1],
                enseignants_Avis: result[2],
                enseignants_examens: result[3],
                enseignants_emplois: result[4],
                inscription: result[5],
                Etudiants_enseignants: result[6],
                enseignantsGroupe: result[7],
                evenements: result[8],
                infos_Enseignants: result[9],
                EmploisJourAct: result[10],
                Emplois: result[11],
                notification_tousEnseignants: result[12],
                EmploisGroupes: result[13],
                date_declaration: date_declaration,
                heure_sys: heure,

                message: ''

            });
        });
    },

    // Pour retourner la page Home Enseignant
    HomeEnseignant2: (req, res) => {

        let nomGroupe = req.session.groupe;
        let filiere = req.params.filiere;
        let categorie = req.session.diplome;
        let specialite = req.params.specialite;
        let niveaux = req.params.niveaux;
        let enseignant = req.session.nom;
        let dt = new Date();
        let mois = "";
        for (i = 0; i < 11; i++) {
            if (dt.getMonth() == 0) { mois = "01"; }
            if (dt.getMonth() == 1) { mois = "02"; }
            if (dt.getMonth() == 2) { mois = "03"; }
            if (dt.getMonth() == 3) { mois = "04"; }
            if (dt.getMonth() == 4) { mois = "05"; }
            if (dt.getMonth() == 5) { mois = "06"; }
            if (dt.getMonth() == 6) { mois = "07"; }
            if (dt.getMonth() == 7) { mois = "08"; }
            if (dt.getMonth() == 8) { mois = "09"; }
            if (dt.getMonth() == 9) { mois = "10"; }
            if (dt.getMonth() == 10) { mois = "11"; }
            if (dt.getMonth() == 11) { mois = "12"; }
        }
        let date_declaration = dt.getDate() + "/" + mois + "/" + dt.getFullYear();
        console.log("Enseignant " + enseignant);
        console.log('Id Prof ' + req.session.id_prof);

        db.query("select * from  enseignant where etablissement='" + req.session.etablissement + "' order by id Desc;select distinct(abriviation),num_groupe,matiere,categorie_diplome,niveaux,specialite,filiere,enseignant,etablissement,id from  groupes_enseignant where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' order by id Desc;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' order by id Desc;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' and type_document='Calendrier examen' order by id Desc limit 1 ;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' and type_document='Emplois du temps' order by id Desc limit 1;select * from nb_inscriptions where  nom_groupe='" + nomGroupe + "' and etablissement='" + req.session.etablissement + "' and categroie_diplome='" + categorie + "'and niveaux='" + niveaux + "' and filiere='" + filiere + "' and specialite='" + specialite + "' order by id Desc;select * from  nb_inscriptions where etablissement='" + req.session.etablissement + "' ;select * from groupes_enseignant where enseignant='" + enseignant + "' and  etablissement='" + req.session.etablissement + "' order by id Desc;select * from  evenements where etablissement='" + req.session.etablissement + "' order by id Desc limit 1;select * from  enseignant where id='" + req.session.id_prof + "'", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], function(err, result) {
            if (err) throw err;


            res.render('enseignant/homeEnseignant2.ejs', {
                etablissement: req.session.etablissement,
                enseignants: result[0],
                enseignants_Groupe: result[1],
                enseignants_Avis: result[2],
                enseignants_examens: result[3],
                enseignants_emplois: result[4],
                inscription: result[5],
                Etudiants_enseignants: result[6],
                enseignantsGroupe: result[7],
                evenements: result[8],
                infos_Enseignants: result[9],
                date_declaration: date_declaration,
                message: ''

            });
        });
    },

    // Pour retourner la page Home Enseignant
    ProfilEnseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        let nomGroupe = req.session.groupe;
        let filiere = req.params.filiere;
        let categorie = req.session.diplome;
        let specialite = req.params.specialite;
        let niveaux = req.params.niveaux;
        let enseignant = req.session.nom;
        let dt = new Date();
        let mois = "";
        for (i = 0; i < 11; i++) {
            if (dt.getMonth() == 0) { mois = "01"; }
            if (dt.getMonth() == 1) { mois = "02"; }
            if (dt.getMonth() == 2) { mois = "03"; }
            if (dt.getMonth() == 3) { mois = "04"; }
            if (dt.getMonth() == 4) { mois = "05"; }
            if (dt.getMonth() == 5) { mois = "06"; }
            if (dt.getMonth() == 6) { mois = "07"; }
            if (dt.getMonth() == 7) { mois = "08"; }
            if (dt.getMonth() == 8) { mois = "09"; }
            if (dt.getMonth() == 9) { mois = "10"; }
            if (dt.getMonth() == 10) { mois = "11"; }
            if (dt.getMonth() == 11) { mois = "12"; }
        }
        let date_declaration = dt.getDate() + "/" + mois + "/" + dt.getFullYear();
        console.log("Enseignant " + enseignant);
        console.log('Id Prof ' + req.session.id_prof);

        db.query("select * from  enseignant where etablissement='" + req.session.etablissement + "' order by id Desc;select distinct(abriviation),num_groupe,matiere,categorie_diplome,niveaux,specialite,filiere,enseignant,etablissement,id from  groupes_enseignant where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' order by id Desc;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' order by id Desc;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' and type_document='Calendrier examen' order by id Desc limit 1 ;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' and type_document='Emplois du temps' order by id Desc limit 1;select * from nb_inscriptions where  nom_groupe='" + nomGroupe + "' and etablissement='" + req.session.etablissement + "' and categroie_diplome='" + categorie + "'and niveaux='" + niveaux + "' and filiere='" + filiere + "' and specialite='" + specialite + "' order by id Desc;select * from  nb_inscriptions where etablissement='" + req.session.etablissement + "' ;select * from groupes_enseignant where enseignant='" + enseignant + "' and  etablissement='" + req.session.etablissement + "' order by id Desc;select * from  evenements where etablissement='" + req.session.etablissement + "' order by id Desc limit 1;select * from  enseignant where id='" + req.session.id_prof + "';select * from  absences_enseignant where etablissement='" + req.session.etablissement + "' and prof='" + enseignant + "' order by date_declaration Desc ", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], function(err, result) {
            if (err) throw err;


            res.render('enseignant/ProfilEnseignant.ejs', {
                etablissement: req.session.etablissement,
                enseignants: result[0],
                enseignants_Groupe: result[1],
                enseignants_Avis: result[2],
                enseignants_examens: result[3],
                enseignants_emplois: result[4],
                inscription: result[5],
                Etudiants_enseignants: result[6],
                enseignantsGroupe: result[7],
                evenements: result[8],
                infos_Enseignants: result[9],
                absence_Enseignants: result[10],
                date_declaration: date_declaration,
                message: ''

            });
        });
    },

    // Pour retourner la page Home Enseignant
    AvisEnseignants: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        let nomGroupe = req.session.groupe;
        let filiere = req.params.filiere;
        let categorie = req.session.diplome;
        let specialite = req.params.specialite;
        let niveaux = req.params.niveaux;
        let enseignant = req.session.nom;
        let dt = new Date();
        let mois = "";
        for (i = 0; i < 11; i++) {
            if (dt.getMonth() == 0) { mois = "01"; }
            if (dt.getMonth() == 1) { mois = "02"; }
            if (dt.getMonth() == 2) { mois = "03"; }
            if (dt.getMonth() == 3) { mois = "04"; }
            if (dt.getMonth() == 4) { mois = "05"; }
            if (dt.getMonth() == 5) { mois = "06"; }
            if (dt.getMonth() == 6) { mois = "07"; }
            if (dt.getMonth() == 7) { mois = "08"; }
            if (dt.getMonth() == 8) { mois = "09"; }
            if (dt.getMonth() == 9) { mois = "10"; }
            if (dt.getMonth() == 10) { mois = "11"; }
            if (dt.getMonth() == 11) { mois = "12"; }
        }
        let date_declaration = dt.getDate() + "/" + mois + "/" + dt.getFullYear();
        console.log("Enseignant " + enseignant);
        console.log('Id Prof ' + req.session.id_prof);

        db.query("select * from  enseignant where etablissement='" + req.session.etablissement + "' order by id Desc;select distinct(abriviation),num_groupe,matiere,categorie_diplome,niveaux,specialite,filiere,enseignant,etablissement,id from  groupes_enseignant where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' order by id Desc;select * from  envois where etablissement='" + req.session.etablissement + "'   order by id Desc ;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' and type_document='Calendrier examen' order by id Desc limit 1 ;select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "' and type_document='Emplois du temps' order by id Desc limit 1;select * from nb_inscriptions where  nom_groupe='" + nomGroupe + "' and etablissement='" + req.session.etablissement + "' and categroie_diplome='" + categorie + "'and niveaux='" + niveaux + "' and filiere='" + filiere + "' and specialite='" + specialite + "' order by id Desc;select * from  nb_inscriptions where etablissement='" + req.session.etablissement + "' ;select * from groupes_enseignant where enseignant='" + enseignant + "' and  etablissement='" + req.session.etablissement + "' order by id Desc;select * from  evenements where etablissement='" + req.session.etablissement + "' order by id Desc limit 1;select * from  enseignant where id='" + req.session.id_prof + "';select * from notifications where destination='tous Enseignants' or type='un événement' ORDER BY date_creation,heure_envois DESC", [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10], function(err, result) {
            if (err) throw err;


            res.render('enseignant/AvisEnseignants.ejs', {
                etablissement: req.session.etablissement,
                enseignants: result[0],
                enseignants_Groupe: result[1],
                enseignants_Avis: result[2],
                enseignants_examens: result[3],
                enseignants_emplois: result[4],
                inscription: result[5],
                Etudiants_enseignants: result[6],
                enseignantsGroupe: result[7],
                evenements: result[8],
                infos_Enseignants: result[9],
                notification_tousEnseignants: result[10],
                date_declaration: date_declaration,
                message: ''

            });
        });
    },
    // Pour DeclarationEnseignant
    Declaration_absence_enseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/uma');
        }
        //Recupération des valeurs de formulaire

        let etablissement = req.body.etablissement;
        let description = req.body.description;
        let descriptions = '"' + description + '"';
        let date_debut = req.body.datedebut;
        let photo_enseignant = req.body.photoEnseignant;
        let enseignant = req.body.enseignant;
        let groupe = req.body.groupe;
        let abriviation = req.body.abriviation;
        let date_fin = req.body.datefin;
        let heure = req.body.heure;
        let date_declaration = req.body.date_declaration;
        /*****Pour redirecttion*** */
        let filiere = req.body.filiere;
        let categorie = req.body.categorie;
        let niveaux = req.body.niveaux;
        let classe = abriviation + ' ' + groupe;
        let specialite = req.body.specialite;
        /*******Fin redirection */
        let dt = new Date();
        let mois = "";
        let hr = "";
        if (dt.getHours() < 10) { hr = "0" + dt.getHours(); } else { hr = dt.getHours(); }


        let heure_envois = hr + ":" + dt.getMinutes();
        for (i = 0; i < 11; i++) {
            if (dt.getMonth() == 0) { mois = "01"; }
            if (dt.getMonth() == 1) { mois = "02"; }
            if (dt.getMonth() == 2) { mois = "03"; }
            if (dt.getMonth() == 3) { mois = "04"; }
            if (dt.getMonth() == 4) { mois = "05"; }
            if (dt.getMonth() == 5) { mois = "06"; }
            if (dt.getMonth() == 6) { mois = "07"; }
            if (dt.getMonth() == 7) { mois = "08"; }
            if (dt.getMonth() == 8) { mois = "09"; }
            if (dt.getMonth() == 9) { mois = "10"; }
            if (dt.getMonth() == 10) { mois = "11"; }
            if (dt.getMonth() == 11) { mois = "12"; }
        }
        let date_envois = dt.getDate() + "/" + mois + "/" + dt.getFullYear();
        //console.log('date_debut '+date_debut);
        let documents = "";
        if (req.files == null) {

            documents = "";
        } else {
            let docs = req.files.document;
            documents = docs.name;
            // upload the file to the /public/assets/img directory
            docs.mv(__dirname + `/../assets/documents/Absences_Enseignant/${documents}`, (err) => {
                if (err) {
                    return res.status(500).send(err);
                }
            });
        }
        //Requete insertion


        db.query("INSERT INTO   `absences_enseignant`(`prof`, `etablissement`, `etat_validation`, `abriviation`, `num_groupe`, `date_debut`, `date_fin`, `date_declaration`, `heure`, `description`, `documents`,`photo_enseignant`) VALUES('" + enseignant + "','" + etablissement + "','en cours', '" + abriviation + "','" + groupe + "', '" + date_debut + "','" + date_fin + "', '" + date_declaration + "','" + heure + "', " + descriptions + ", '" + documents + "', '" + photo_enseignant + "');select * from absences_enseignant ORDER BY id DESC limit 1 ", [0, 1], function(err, result) {
            console.log("Id last est : " + result[1][0].id);
            let abrv = groupe + ' ' + abriviation;
            idLast = result[1][0].id;
            let sqlnotification = "INSERT INTO  `notifications`(`etablissement`, `emmeteur`, `date_creation`,`heure_envois`, `type`, `destination`, `etat`,`id_source`) VALUES('" + etablissement + "','" + enseignant + "','" + date_envois + "','" + heure_envois + "', 'une absence', '" + abrv + "','0', '" + idLast + "')";
            db.query(sqlnotification);

        });





        // Fin dernier id

        /***************Fin notification *********/
        req.session.msgEnvois_enseignant_etudiant = "Déclaration effectuée";
        res.redirect('/getEtudiantsClasse/' + classe);
        messageEnvois_enseignant_etudiant = req.session.msgEnvois_enseignant_etudiant
            // }

        // });//Fin exécution requete

    }, //Fin  DeclarationEnseignant 



    //Affecter Enseignant
    AffecterEnseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }


        let etablissement = req.body.etablissement;
        /*****Affectation multiple**** */
        /*******Enseignant */
        let enseignants = req.body.enseignant;
        let enseignant = enseignants.split("\n");
        let nbenseignants = enseignant.length;
        /*******Matieres */
        let matieres = req.body.matiere;
        let matiere = matieres.split("\n");
        let nbematiere = matiere.length;
        /********* */
        //let matieres='"'+matiere+'"';
        /************ */
        let groupe = req.body.groupe;
        let categorie = req.body.categorie;
        let abriviation = req.body.abriviation;
        let niveaux = req.body.niveaux;
        let specialite = req.body.specialite;
        let filiere = req.body.filiere;

        //let photoEnseignant="select * from enseignant where nom='"+enseignant+"' and etablissement='"+etablissement+"' ";

        /*db.query(photoEnseignant,(err,resultPhoto) =>{
            var nbres=resultPhoto.length;
            console.log("Nb: "+nbres);
           
                
                Object.keys(resultPhoto).forEach(function(key) {
                    var rowP = resultPhoto[key];
                    var phts=rowP.photo;
                    req.session.phts=phts;
                     */
        // console.log(" Enseignant "+enseignant);
        for (let i = 0, j = 0; i < nbenseignants, j < nbematiere; i++, j++) {



            let matieres = '"' + matiere[j] + '"';
            let sql = "INSERT INTO `groupes_enseignant`(`matiere`, `num_groupe`, `categorie_diplome`, `abriviation`, `niveaux`, `specialite`, `filiere`, `enseignant`, `etablissement`,`photo_enseignant`) VALUES (" + matieres + ",   '" + groupe + "', '" + categorie + "', '" + abriviation + "', '" + niveaux + "', '" + specialite + "', '" + filiere + "', '" + enseignant[i] + "', '" + etablissement + "', '')";
            let sqlAjoutEnseignant = "INSERT INTO `enseignant`(`nom`, `etablissement`) VALUES ('" + enseignant[i] + "', '" + etablissement + "')";
            db.query(sqlAjoutEnseignant);
            db.query(sql);


        }
        //Exécution de requete
        /*db.query(sql,(err,result) =>{
            if(err)
            {
                message='Erreur ajout';
                return message;
            }
            else{*/
        req.session.msgs = " L'affectation de l'enseignant  " + enseignant + "a été effectué avec succès"


        res.redirect("/getNumInscriptionRechGroupe/" + groupe + "/" + filiere + "/" + categorie + "/" + niveaux + "/" + specialite + "/" + abriviation);
        msgs = req.session.msgs;
        //}
        //});//Fin exécution requete

        // });


        //});//Fin exécution requete



    },

    AfficherEnseignants: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        let abriviation = req.params.abriviation;
        let groupe = req.params.groupe;
        console.log("abriviation " + abriviation + " groupe " + groupe);
        let query = "select * from  groupes_enseignant where etablissement='" + req.session.etablissement + "' and abriviation='" + abriviation + "' and num_groupe='" + groupe + "' ";

        db.query(query, (err, result) => {
            if (err) {
                res.redirect('/');
            }

            res.render('enseignant/Afficher.ejs', {

                etablissement: req.session.etablissement,
                abriviation: abriviation,
                groupe: groupe,
                enseignants: result,
                message: ''
            });
        });
    },

    messagerie_enseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        //let groupe=req.params.groupe;
        //console.log("abriviation "+abriviation +" groupe "+groupe);

        let query = "select * from  enseignant where etablissement='" + req.session.etablissement + "'";

        db.query(query, (err, result) => {
            if (err) {
                res.redirect('/');
            }

            res.render('enseignant/messageries.ejs', {

                etablissement: req.session.etablissement,
                pseudo: req.session.pseudo,

                enseignants: result,
                message: ''
            });
        });
    },

    compte_enseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        //let groupe=req.params.groupe;
        //console.log("abriviation "+abriviation +" groupe "+groupe);

        let query = "select * from  enseignant where etablissement='" + req.session.etablissement + "'";

        db.query(query, (err, result) => {
            if (err) {
                res.redirect('/');
            }

            res.render('enseignant/compte.ejs', {

                etablissement: req.session.etablissement,
                pseudo: req.session.pseudo,


                message: ''
            });
        });
    },

    messagerie_enseignant_etudiant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        //let groupe=req.params.groupe;
        //console.log("abriviation "+abriviation +" groupe "+groupe);

        let query = "select * from  nb_inscriptions where etablissement='" + req.session.etablissement + "' and nom_groupe='" + req.session.groupe + "' and abriviation='" + req.session.abriviation + "'";

        db.query(query, (err, result) => {
            if (err) {
                res.redirect('/');
            }

            res.render('enseignant/messageries_etudiant.ejs', {

                etablissement: req.session.etablissement,
                pseudo: req.session.pseudo,

                enseignants_etudiant: result,
                message: ''
            });
        });
    },



    //Afficher Groupe Enseignant

    Afficher_Groupe_Enseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        //let groupe=req.params.groupe;
        // console.log("etablissement "+req.session.etablissement +" Enseignant "+req.session.nom);

        let query = "select distinct(abriviation),num_groupe,matiere,categorie_diplome,niveaux,specialite,filiere,enseignant,etablissement from  groupes_enseignant where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "'";

        db.query(query, (err, result) => {
            var row = result.length;
            console.log("Res : " + row);
            if (err) {
                res.redirect('/');
            }

            res.render('enseignant/AfficherGroupe.ejs', {

                etablissement: req.session.etablissement,
                pseudo: req.session.pseudo,

                enseignants_Groupe: result,
                message: ''
            });
        });
    },

    //Planning Enseignant

    Planning_Enseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        //let groupe=req.params.groupe;
        // console.log("etablissement "+req.session.etablissement +" Enseignant "+req.session.nom);

        let query = "select * from  envois where etablissement='" + req.session.etablissement + "'  and  enseignant='" + req.session.nom + "'";

        db.query(query, (err, result) => {
            var row = result.length;
            console.log("Res : " + row);
            if (err) {
                res.redirect('/');
            }

            res.render('enseignant/planning.ejs', {

                etablissement: req.session.etablissement,
                pseudo: req.session.pseudo,

                enseignants_Groupe: result,
                message: ''
            });
        });
    },
    //Afficher Groupe Enseignant

    Gestion_Enseignants: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        req.session.msgsG = "";
        req.session.msg = "";
        req.session.msgs = "";
        req.session.msgSP1 = "";
        req.session.msgAE = "";
        req.session.ErrorEnvois = "";
        req.session.ErrorGroupe_Afficher = "";

        if (req.session.GestionEnseignants != null) {
            req.session.msgSP = req.session.GestionEnseignants;
        } else {
            req.session.msgSP = "";
        }
        //Pour Error

        if (req.session.Error != null) {
            req.session.msgError = req.session.Error;
        } else {
            req.session.msgError = "";
        }

        let query = "select * from  enseignant where etablissement='" + req.session.etablissement + "'";

        db.query(query, (err, result) => {
            if (err) {
                res.redirect('/');
            }

            res.render('enseignant/consulter.ejs', {

                etablissement: req.session.etablissement,


                All_enseignants: result,
                messagesE: req.session.msgSP,
                messagesError: req.session.msgError
            });
        });
    },


    //Fonction pour retourner la page de conx
    getNumEtudiantsGroupe: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }

        let msgs = "";
        msgs = req.session.msgEnvois_enseignant_etudiant;
        if (msgs != null) { req.session.msgEnvois_enseignant_etudiant = msgs; } else {
            req.session.msgEnvois_enseignant_etudiant = "";
        }

        //Pour File
        msgsFile = req.session.msgEnvois_enseignant_etudiantFile;
        if (msgsFile != null) { req.session.msgEnvois_enseignant_etudiantFile = msgsFile; } else {
            req.session.msgEnvois_enseignant_etudiantFile = "";
        }
        req.session.GestionNumInscription = "";
        //let nom_groupe=req.params.nomGroupe;
        let nomGroupe = req.params.nomGroupe;
        let filiere = req.params.filiere;
        let categorie = req.params.categorie;
        let specialite = req.params.specialite;
        let niveaux = req.params.niveaux;
        let abriviation = req.params.abriviation;
        let enseignant = req.session.nom;
        let photoenseignant = req.session.photo;
        let dt = new Date();
        let mois = "";
        for (i = 0; i < 11; i++) {
            if (dt.getMonth() == 0) { mois = "01"; }
            if (dt.getMonth() == 1) { mois = "02"; }
            if (dt.getMonth() == 2) { mois = "03"; }
            if (dt.getMonth() == 3) { mois = "04"; }
            if (dt.getMonth() == 4) { mois = "05"; }
            if (dt.getMonth() == 5) { mois = "06"; }
            if (dt.getMonth() == 6) { mois = "07"; }
            if (dt.getMonth() == 7) { mois = "08"; }
            if (dt.getMonth() == 8) { mois = "09"; }
            if (dt.getMonth() == 9) { mois = "10"; }
            if (dt.getMonth() == 10) { mois = "11"; }
            if (dt.getMonth() == 11) { mois = "12"; }
        }
        let date_declaration = dt.getDate() + "/" + mois + "/" + dt.getFullYear();

        console.log('abriviation ' + abriviation);
        console.log('nomGroupe ' + nomGroupe);
        // console.log(' le  tetet stst tet  Enseignant ' +enseignant);   
        db.query("select * from nb_inscriptions where  nom_groupe='" + nomGroupe + "' and etablissement='" + req.session.etablissement + "' and categroie_diplome='" + categorie + "'and niveaux='" + niveaux + "' and filiere='" + filiere + "' and specialite='" + specialite + "';select * from enseignant where etablissement='" + req.session.etablissement + "';select * from groupes_enseignant;select * from envois_enseignant_etudiant where etablissement='" + req.session.etablissement + "' and enseignant='" + enseignant + "' and groupe='" + nomGroupe + "' and abriviation='" + abriviation + "'", [0, 1, 2, 3], function(err, result) {
            console.log("select * from nb_inscriptions where  nom_groupe='" + nomGroupe + "' and etablissement='" + req.session.etablissement + "' and categroie_diplome='" + categorie + "'and niveaux='" + niveaux + "' and filiere='" + filiere + "' and specialite='" + specialite + "'");
            if (err) throw err;

            res.render('enseignant/getNumEtudiantsGroupe.ejs', {

                filiere: filiere,
                categorie: categorie,
                photo_Enseignant: photoenseignant,
                niveaux: niveaux,
                specialite: specialite,
                nomGroupe: nomGroupe,
                abriviation: abriviation,
                inscription: result[0],
                enseignants: result[1],
                matieresenseignants: result[2],
                envois_enseignant_etudiant: result[3],
                etablissement: req.session.etablissement,
                date_declaration: date_declaration,
                msgEnvois_enseignant_etudiant: req.session.msgEnvois_enseignant_etudiant,
                msgEnvois_enseignant_etudiantFile: req.session.msgEnvois_enseignant_etudiantFile

            });
        });

    },


    //Fonction pour retourner la page de conx
    getEtudiantsClasse: (req, res) => {

        if (req.session.etablissement == null) {

            res.redirect('/');
        }

        let msgs = "";
        msgs = req.session.msgEnvois_enseignant_etudiant;
        if (msgs != null) { req.session.msgEnvois_enseignant_etudiant = msgs; } else {
            req.session.msgEnvois_enseignant_etudiant = "";
        }
        req.session.GestionNumInscription = "";

        //let nom_groupe=req.params.nomGroupe;
        let classe = req.params.classe;
        console.log("Classssssssse   " + classe);
        let cls = classe.split(' ');
        let nb = cls.length;
        console.log("Groupe est : " + cls[nb - 1]);
        console.log("Abriviation est : " + cls[nb - nb] + ' ' + cls[nb - 2]);
        let abriviation = cls[nb - nb] + ' ' + cls[nb - 2];
        let nomGroupe = cls[nb - 1];
        let enseignant = req.session.nom;
        let enseignants = enseignant + '\r';
        let photoenseignant = req.session.photo;
        console.log("Photo est : " + photoenseignant);
        let dt = new Date();
        let mois = "";
        for (i = 0; i < 11; i++) {
            if (dt.getMonth() == 0) { mois = "01"; }
            if (dt.getMonth() == 1) { mois = "02"; }
            if (dt.getMonth() == 2) { mois = "03"; }
            if (dt.getMonth() == 3) { mois = "04"; }
            if (dt.getMonth() == 4) { mois = "05"; }
            if (dt.getMonth() == 5) { mois = "06"; }
            if (dt.getMonth() == 6) { mois = "07"; }
            if (dt.getMonth() == 7) { mois = "08"; }
            if (dt.getMonth() == 8) { mois = "09"; }
            if (dt.getMonth() == 9) { mois = "10"; }
            if (dt.getMonth() == 10) { mois = "11"; }
            if (dt.getMonth() == 11) { mois = "12"; }
        }
        let date_declaration = dt.getDate() + "/" + mois + "/" + dt.getFullYear();
        let enseignantH = enseignants + '\r\n';
        let sql = "select * from envois_enseignant_etudiant where etablissement='" + req.session.etablissement + "' and enseignant='" + enseignantH + "' and groupe='" + nomGroupe + "' and abriviation='" + abriviation + "'";
        console.log(sql);
        db.query("select * from nb_inscriptions where  nom_groupe='" + nomGroupe + "' and etablissement='" + req.session.etablissement + "' ;select * from enseignant where etablissement='" + req.session.etablissement + "';select * from groupes_enseignant;select * from envois_enseignant_etudiant where etablissement='" + req.session.etablissement + "' and enseignant='" + enseignantH + "' and groupe='" + nomGroupe + "' and abriviation='" + abriviation + "';select * from notifications where destination='tous Enseignants' or type='un événement' ORDER BY date_creation,heure_envois DESC", [0, 1, 2, 3, 4], function(err, result) {

            if (err) throw err;

            res.render('enseignant/getEtudiantsClasse.ejs', {

                photo_Enseignant: photoenseignant,
                filiere: null,
                categorie: null,
                niveaux: null,
                specialite: null,
                nomGroupe: nomGroupe,
                abriviation: abriviation,
                inscription: result[0],
                enseignants: result[1],
                matieresenseignants: result[2],
                envois_enseignant_etudiant: result[3],
                notification_tousEnseignants: result[4],
                etablissement: req.session.etablissement,
                date_declaration: date_declaration,
                msgEnvois_enseignant_etudiant: req.session.msgEnvois_enseignant_etudiant,
                msgEnvois_enseignant_etudiantFile: req.session.msgEnvois_enseignant_etudiantFile
            });
        });

    },

    //Modification Informations Personnel

    Modifier_Infos_Personnel: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        let id = req.body.id_prof;
        let nom = req.body.nom;
        let tel = req.body.tel;
        let mdp = req.body.mdpnew;

        let sql = "update `enseignant` set nom='" + nom + "',tel='" + tel + "', mdp='" + mdp + "' where `id`='" + id + "'";
        //Exécution de requete
        db.query(sql, (err, result) => {
            if (err) {
                message = 'Erreur ajout';
                return message;
            }
            res.redirect('/ProfilEnseignant');
        }); //Fin exécution requete

    },

    //Modification Informations Personnel

    photos_enseignant: (req, res) => {
        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        let id = req.body.id_prof;
        let enseignant = req.body.enseignant;
        let photos = req.files.photo_enseignant;
        console.log("Enseignant est : " + enseignant);
        let photo = photos.name;
        // upload the file to the /public/assets/img directory
        photos.mv(__dirname + `/../assets/photos_Enseignants/${photo}`, (err) => {
            let sql = "update `enseignant` set photo='" + photo + "' where `id`='" + id + "'";
            let sqlG = "update `groupes_enseignant` set photo_enseignant='" + photo + "' where `enseignant`='" + enseignant + "'";
            db.query(sqlG);
            //Exécution de requete
            db.query(sql, (err, result) => {
                if (err) {
                    message = 'Erreur ajout';
                    return message;
                }
                res.redirect('/Enseignant');
            }); //Fin exécution requete
        });

    },

    Modifier_mdp_Enseignant: (req, res) => {

        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        let id = req.body.id_prof;

        let mdp = req.body.mdpnew;



        let sql = "update `enseignant` set mdp='" + mdp + "' where `id`='" + id + "'";
        //Exécution de requete
        db.query(sql, (err, result) => {
            if (err) {
                message = 'Erreur ajout';
                return message;
            }
            res.redirect('/Compte');
        }); //Fin exécution requete


    },

    //Delete Affectation

    deleteAffectationEnseignant: (req, res) => {
        //Recupération des valeurs de formulaire

        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        let id = req.params.id;
        //console.log("etablissement "+etablissement+" cycle "+cycle);
        //Requete insertion

        let sql = "delete from groupes_enseignant where id='" + id + "'";
        //Exécution de requete
        db.query(sql, (err, result) => {
            if (err) {
                message = 'Erreur ajout';
                return message;
            }
            res.redirect('/dashboard');
        }); //Fin exécution requete


    }, //Delete Affectation

    deleteEnseignant: (req, res) => {
        //Recupération des valeurs de formulaire

        if (req.session.etablissement == null) {

            res.redirect('/');
        }
        let id = req.params.id;
        //console.log("etablissement "+etablissement+" cycle "+cycle);
        //Requete insertion

        let sql = "delete from enseignant where id='" + id + "'";
        //Exécution de requete
        db.query(sql, (err, result) => {
            if (err) {
                message = 'Erreur ajout';
                return message;
            }
            res.redirect('/GestionEnseignants');
        }); //Fin exécution requete


    }, //Delete Enseignant

};