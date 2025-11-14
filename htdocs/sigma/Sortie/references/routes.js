 const { Console } = require("console");

module.exports = {
    //Fonction d'affichage
   
    //Fonction pour retourner la page de conx
    authentification: (req, res) => {
       let errorMDP="";
       if(req.session.ErreurConnexion!="")
        {
            errorMDP=req.session.ErreurConnexion;   
        }
        else{
            req.session.ErreurConnexion="";
        }
           
            res.render('index.ejs', {
                errorMDP:req.session.ErreurConnexion,
              
            message: ''
        
    });
    },
    authentificationAdmin: (req, res) => {
         let errorMDP="";
         if(req.session.ErreurConnexion!="")
        {
            errorMDP=req.session.ErreurConnexion;   
        }
        else{
            req.session.ErreurConnexion="";
        }
       //let admin=req.params.etablissement;
           
        res.render('indexAdmin.ejs', {
            errorMDP:req.session.ErreurConnexion,
        // admin:admin, 
        message: ''
    
});
},

    dashboard: (req, res) => {

        let dt=new Date();
  let mois="";
  let jour="";
  for(i=0;i<11;i++)
  {
    if(dt.getMonth()==0){mois="01";}
    if(dt.getMonth()==1){mois="02";}
    if(dt.getMonth()==2){mois="03";}
    if(dt.getMonth()==3){mois="04";}
    if(dt.getMonth()==4){mois="05";}
    if(dt.getMonth()==5){mois="06";}
    if(dt.getMonth()==6){mois="07";}
    if(dt.getMonth()==7){mois="08";}
    if(dt.getMonth()==8){mois="09";}
    if(dt.getMonth()==9){mois="10";}
    if(dt.getMonth()==10){mois="11";}
    if(dt.getMonth()==11){mois="12";}
  }
  if(dt.getDate()<10)
  {
    jour="0"+dt.getDate();  
  }
  else{
      jour=dt.getDate();   
  }
  if((dt.getHours()-1)<10)
  {
    hr="0"+(dt.getHours()-1);  
  }
  else{
      hr=dt.getHours()-1;   
  }
        let date_declaration=dt.getFullYear()+"-"+mois+"-"+jour;
       
        let heure=hr+":"+dt.getMinutes();
    
        db.query("select * from  nb_inscriptions where etablissement='"+req.session.etablissement+"' and autorisation='demande';select SUM(nb_groupe) as nb from  groupes_des_etudiants where etablissement='"+req.session.etablissement+"';select count(nom) as nbEnseignant from  enseignant where etablissement='"+req.session.etablissement+"';select count(num) as nbEtudians from  nb_inscriptions where etablissement='"+req.session.etablissement+"';select count(num) as nbEtudiantAutorise from  nb_inscriptions where etablissement='"+req.session.etablissement+"' and autorisation='autorise';select count(nom_groupe) as nbGroupe,count(num) as nbEtudiant,niveaux,categroie_diplome,autorisation from  nb_inscriptions where etablissement='"+req.session.etablissement+"' GROUP BY  niveaux,categroie_diplome;select * from  envois where etablissement='"+req.session.etablissement+"'  order by date_envois Desc;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='evenement' order by id Desc Limit 1;select * from   groupes_enseignant where etablissement='"+req.session.etablissement+"'", [0, 1,2,3,4,5,6,7], function(err, result) {
            
            if (err) throw err;
           console.log("select * from   groupes_enseignant where etablissement='"+req.session.etablissement+"'");
           req.session.msgsG="";  
           req.session.msg="";
            req.session.msgs="";
            req.session.msgSP1="";
            req.session.msgAE="";
            req.session.ErreurConnexion="";
            req.session.GestionEnseignants="";
            req.session.GestionNumInscription="";
            req.session.Error="";
            req.session.ErrorEnvois="";
            req.session.ErrorGroupe_Afficher="";
        res.render('declaration/dashboard.ejs', {
            etablissement:req.session.etablissement,
            dashboardEtudiantsDemande:result[0],
            nbGroupe:result[1],
            nbEnseignants:result[2],
            nbEtudiants:result[3],
            nbEtudiantsAutorise:result[4],
            statistique:result[5],
            envois:result[6],
            evenements:result[7],
            affectationsEnseignants:result[8],
            date_declaration:date_declaration,
            heure_sys:heure,

            messageG: req.session.msgsG,
    
});
});
},
    // Pour retourner la page Home Faculte
    HomeFaculte: (req, res) => {
       
           
        res.render('homeFaculte.ejs', {
          
        message: ''
    
});
},




 // Pour retourner la page SystemeEnseignement
 SystemeEnseignement: (req, res) => {
       
           
    res.render('SystemeEnseignement.ejs', {
      'etablissement':req.session.etablissement,
    message: ''

});
},

// Pour Ajouter SystemeEnseignement
AjoutSystemeEnseignement: (req, res)=>{
    //Recupération des valeurs de formulaire
    let message = '';
    let etablissement = req.body.etablissement;
    let cycle = req.body.cycle;
    let mdp = req.body.password;
  //console.log("etablissement "+etablissement+" cycle "+cycle);
 //Requete insertion
   
    let sql="INSERT INTO `tahoura`(`nom_etablissement`, `cycle_enseignement`, `password`) VALUES ('" +etablissement + "', '" + cycle + "', '" + mdp + "')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
       res.redirect('/SystemeEnseignement');
      });//Fin exécution requete
    

}, //Fin Fonction inscriptions apprenants

seconnecter: (req, res)=>{
    //Recupération des valeurs de formulaire
    let message = '';
    let etablissement = req.body.etablissement;
    let typeUser = req.body.typeUser;
    let mdp = req.body.password;
 
   if(typeUser=="Administration"){
    //console.log("MDP Admin "+mdp);
            let sql="select * from `tahoura` where `nom_etablissement`='"+etablissement+"' and  `password`='" + mdp + "'";
                //Exécution de requete
            db.query(sql,(err,result) =>{
                var nbres=result.length;
                console.log("Nb: "+nbres);
                if (nbres==0) {
                    req.session.ErreurConnexion="Vérifier votre identification";
                    res.redirect('/');
                    ErreurConnexion=req.session.ErreurConnexion
                }
                else{
                    req.session.mdp=mdp;
                    req.session.role="etablissement";
                    req.session.etablissement=etablissement;
                    req.session.msgEnvois_enseignant_etudiant="";
                    Object.keys(result).forEach(function(key) {
                        var rowEtab = result[key];
                        var cycle=rowEtab.cycle_enseignement;
                        req.session.cycle=cycle;
                        console.log("Mdp: "+mdp+" Etablissement: "+etablissement+" cycle: "+cycle);
                    });
            res.redirect('/dashboard');
            role=req.session.role
                }
            });
    }
  
    

}, //Fin Fonction inscriptions apprenants
 
connecter: (req, res)=>{
    //Recupération des valeurs de formulaire
    let message = '';
    let user = req.body.user;
    let users=user+'\r';
    //let fac = req.body.fac;
    let typeUser = req.body.typeUser;
    let mdp = req.body.password;
 console.log("Enseignant ==== "+user)

    if(typeUser=="Enseignant"){

                let sqlEnseignant="select * from `enseignant` where `nom`='"+users+"' and  `mdp`='" + mdp + "' ";
                 console.log(sqlEnseignant);
                //Exécution de requete
                db.query(sqlEnseignant,(err,result) =>{
                    var nbres=result.length;
                    console.log("Nb: "+nbres);
                    if (nbres==0) {
                
                        req.session.ErreurConnexion="Vérifier votre identification";
                         res.redirect('/uma');
                        ErreurConnexion=req.session.ErreurConnexion
                    }
                    else{
                        req.session.mdp=mdp;
                        req.session.role="enseignant";
                        req.session.type="enseignant";
                        req.session.msgEnvois_enseignant_etudiant="";
                        Object.keys(result).forEach(function(key) {
                            var rowEtab = result[key];
                            var pseudo=rowEtab.pseudo;
                            var nom=rowEtab.nom;
                             var id_prof=rowEtab.id;
                             var photo=rowEtab.photo;
                             var grade=rowEtab.grade;
							 var prenom=rowEtab.prenom;
							var tel=rowEtab.tel;
                            var etablissement=rowEtab.etablissement;
                            var Groupe=rowEtab.num_groupe;
                            var abriviation=rowEtab.abriviation;
                            var categorie_diplome=rowEtab.categroie_diplome;
                            req.session.pseudo=pseudo;
                            req.session.grade=grade;
                            req.session.photo=photo;
                            req.session.nom=nom;
                            req.session.id_prof=id_prof;
							 req.session.prenom=prenom;
							 req.session.tel=tel;
                            req.session.etablissement=etablissement;
                            req.session.groupe=Groupe;
                            req.session.abriviation=abriviation;
                            req.session.diplome=categorie_diplome;
                            //console.log("Photoooooooooooooooo connection est : "+req.session.photo);
						});
                        res.redirect('/Enseignant');
                role=req.session.role,
				fac=req.session.etablissement,
                nom=req.session.nom,
                pwd=req.session.mdp,
				 prenom=req.session.prenom,
                abriviation=req.session.abriviation,
                groupe=req.session.groupe,
                diplome=req.session.diplome,
				tel=req.session.tel,
                id_prof=req.session.id_prof,
                photo=req.session.photo,
                grade=req.session.grade
                
				
                    }
                });//Fin exécution requete
    }
   
    else if(typeUser=="Etudiant"){
       
        //console.log("MDP "+etablissement);
        let sqlEtudiant="select * from `nb_inscriptions` where num="+ user ;
        console.log(sqlEtudiant);
        //Exécution de requete
        db.query(sqlEtudiant,(err,result) =>{
            console.log("Result   !!!!!!!!!!!!!!!!!!! "+result);
            if(result==undefined)
            {
                req.session.ErreurConnexion="Vérifier votre identification";
                 res.redirect('/uma');
                ErreurConnexion=req.session.ErreurConnexion
            }
            else{
            var nbres=result.length;
           // console.log("Nb: "+nbres);
            if (nbres==0) {
        
                req.session.ErreurConnexion="Vérifier votre identification";
                    res.redirect('/uma');
                    ErreurConnexion=req.session.ErreurConnexion
            }
            else{
                req.session.mdp=mdp;
                req.session.role="etudiant";
                req.session.type="etudiant";
                req.session.msgEnvois_enseignant_etudiant="";
                Object.keys(result).forEach(function(key) {
                    var rowEtab = result[key];
                    var pseudo=rowEtab.num;
                    var nom=rowEtab.nom;
                    var prenom=rowEtab.prenom;
                    var Groupe=rowEtab.nom_groupe;
                  
                    var abriviation=rowEtab.abriviation;
                    var categorie_diplome=rowEtab.categroie_diplome;
                    var etablissement=rowEtab.etablissement;
                    var niveaux=rowEtab.niveaux;
                    var specialite=rowEtab.specialite;
                    var filiere=rowEtab.filiere;
                    var id_etudiant=rowEtab.id;
                    var photo_etudiant=rowEtab.photo;
                    req.session.pseudo=pseudo;
                    req.session.id_etudiant=id_etudiant;
                    req.session.groupe=Groupe;
                    req.session.abriviation=abriviation;
                    req.session.diplome=categorie_diplome;
                    req.session.nomEtudiant=nom;
                    req.session.prenomEtudiant=prenom;
                    req.session.etablissement=etablissement;
                    req.session.niveaux=niveaux;
                    req.session.filiere=filiere;
                    req.session.specialite=specialite;
                    req.session.photo_etudiant=photo_etudiant;
					//req.session.fac=fac;
                
                });
        res.redirect('/Etudiants');
        role=req.session.role,
		fac=req.session.etablissement,
        nomEtudiant=req.session.nomEtudiant,
        num=req.session.pseudo,
        prenomEtudiant=req.session.prenomEtudiant,
        abriviation=req.session.abriviation,
        groupe=req.session.groupe,
        diplome=req.session.diplome,
        niveau=req.session.niveaux,
        specialites=req.session.specialite,
        filieres=req.session.filiere,
        id_etudiant=req.session.id_etudiant,
        photo_etudiant=req.session.photo_etudiant
            }
        }
        });//Fin exécution requete
    
}
    

}, //Fin Fonction inscriptions apprenants
 

/**********Déconnexion******** */ 

 // Pour Interface Authentification
 deconnexion: (req, res)=>{
    //Recupération des valeurs de formulaire
    let message = '';
    let etablissement = req.body.etablissement;
 
          req.session.msg=null;
            req.session.etablissement=null;
            req.session.ErreurConnexion="";
         if(req.session.role=="etablissement"){res.redirect('/');}
         else{ res.redirect('/uma');}
        
    

}, //Fin Fonction inscriptions apprenants


 deconnexions: (req, res)=>{
    //Recupération des valeurs de formulaire
    let message = '';
    let etablissement = req.body.etablissement;
          let fac=req.session.fac;
          req.session.msg=null;
            req.session.etablissement=null;
            req.session.ErreurConnexion="";
         
		   
       res.redirect('/uma');
        
    

},


//Pour Afficher Groupe

// Pour Afficher Groupe
AfficherGroupe: (req, res)=>{
   
    let message = '';
  
 //Requete select
 let etablissement=req.session.etablissement;
 if(!req.session.etablissement)
           
   {
    res.redirect("/");
   }

  else{

    db.query("SELECT distinct (filiere)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"';SELECT distinct (specialite)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"';SELECT distinct (abriviation)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"'", [0, 1,2], function(err, result) {
        if (err) throw err;
       
        res.render('Afficher_groupesEtudiants.ejs', {
            filieres: result[0],
            specialites: result[1],
            abriviations: result[2],
             'etablissement':req.session.etablissement,
             'cycle':req.session.cycle,
        message: ''
    });
});   

  }
    

}, //Fin Fonction inscriptions apprenants
  


// Resultat Affichage  Groupe
ConsulterGroupe: (req, res)=>{
   
    let message = '';
  
 //Requete select
 let etablissement=req.session.etablissement;
 let filiere = req.body.filiere;
 let niveaux=null;
 let categorie = req.body.categorie;
 let sous_categorie = req.body.sous_categorie;
 let specialite = req.body.specialite;
 let abriviation = req.body.abriviation;
 if(categorie=='licence')
 { niveaux = req.body.niveaux_licence;}
 else if(categorie=='Master')
 { niveaux = req.body.niveaux_master;}
 else if(categorie=='Doctora')
 { niveaux = req.body.niveaux_doctora;}
 if(!req.session.etablissement)
           
   {
    res.redirect("/");
   }
    else {
        let sql = "SELECT * FROM `groupes_des_etudiants` where etablissement='"+req.session.etablissement+"' and categorie='"+categorie+"'and sous_categorie='"+sous_categorie+"'and niveaux='"+niveaux+"'";
    if(filiere=="")
    {
         sql = "SELECT * FROM `groupes_des_etudiants` where etablissement='"+req.session.etablissement+"' and categorie='"+categorie+"'and sous_categorie='"+sous_categorie+"'and abriviation='"+abriviation+"'and niveaux='"+niveaux+"'";
    }
   else
    {
         sql = "SELECT * FROM `groupes_des_etudiants` where etablissement='"+req.session.etablissement+"' and categorie='"+categorie+"'and sous_categorie='"+sous_categorie+"'and filiere='"+filiere+"' and specialite='"+specialite+"' and abriviation='"+abriviation+"'and niveaux='"+niveaux+"'";
    }
   
   // let sql="select * from `groupes_des_etudiants` where `etablissement`='"+etablissement+"'";
    //Exécution de requete
    req.session.filiere=filiere; 
    req.session.categorie=categorie; 
    req.session.niveaux=niveaux; 
    db.query(sql,(err,result) =>{
        Object.keys(result).forEach(function(key) {
            var rowEtab = result[key];
            var nbgroupe=rowEtab.nb_groupe;
            var idgroupe=rowEtab.id;
            req.session.nbgroupe=nbgroupe;   
            req.session.idgroupe=idgroupe; 
            req.session.specialite=specialite; 
            req.session.abriviation=abriviation;   
            req.session.sous_categorie=sous_categorie; 
           
        });
        var nbres=result.length;
         console.log("filieres "+req.session.filiere);
         console.log("categorie "+req.session.categorie);
         console.log("sous_categorie "+sous_categorie);
         console.log("specialite "+specialite);
       
        if (nbres==0) {
       
            message='Erreur select';
            return message;

        }
        else{
           
              
       res.render('consulter_groupesEtudiants.ejs', {
        etablissement: req.session.etablissement,
        groupes: req.session.nbgroupe,
        filiere:req.session.filiere,
        categorie: req.session.categorie, 
        niveaux:req.session.niveaux,
        idGroupe:req.session.idgroupe,
        specialite:req.session.specialite,
        abriviation:req.session.abriviation,
        sous_categorie:req.session.sous_categorie
     
    
    });
        }
      });//Fin exécution requete
    
    }//Fin Else 
}, //Fin Fonction inscriptions apprenants
  


// Pour retourner la page SystemeEnseignement
homeEtablissement: (req, res) => {
       
    if(req.session.etablissement)
           
   { res.render('home_etablissement.ejs', {
      
    message: ''

});}
else{ res.redirect("/"); }
},

// Pour retourner la page SystemeEnseignement
GestionSpecialite: (req, res) => {
       
    if(req.session.etablissement)
           
   { 
       res.render('Gestion_specialite.ejs', {'etablissement':req.session.etablissement,'msg':'','cycle':req.session.cycle,
      
    message: ''

});}
else{ 
    
    res.redirect("/");

}
},

// Pour retourner la page SystemeEnseignement
GestionSpecialites: (req, res) => {
       
    if(req.session.etablissement)
           
   { 
    let etablissement = req.body.etablissement;
    let filiere = req.body.filiere;
    let niveaux=null;
    let categorie = req.body.categorie;
    let specialite = req.body.specialite;
    let abriviation = req.body.Abriviation;
    let sous_categorie = req.body.sous_categorie;
    if(categorie=='licence')
    { niveaux = req.body.niveaux_licence;}
    else if(categorie=='Master')
    { niveaux = req.body.niveaux_master;}
    else if(categorie=='Doctora')
    { niveaux = req.body.niveaux_doctora;}
    else if(categorie=='ingenieur')
    { niveaux = req.body.niveaux_ingenieur;}
    else if(categorie=='prep')
    { niveaux = req.body.niveaux_prep;}
    else if(categorie=='medecine')
    { niveaux = req.body.niveaux_medecine;}
    console.log('etablissement '+etablissement);
    let sql="INSERT INTO `filieres_specialite`(`etablissement`, `filiere`, `specialite`, `abriviation`, `categorie`, `sous_categorie`, `niveaux`) VALUES ('" +etablissement + "', '" + filiere + "','" + specialite + "','" + abriviation + "', '" + categorie + "', '" + sous_categorie + "', '" + niveaux + "')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
     
        else{
           
            req.session.msgSP1="L'ajout de filière "+filiere+" et spécialité "+ specialite+" a été effectué avec succès ";
       res.redirect('/AfficherSpecialite');
       message: req.session.msgSP1;
        }
      
      });//Fin exécution requete
    }
else{ res.redirect("/"); }
},

// Pour retourner la page SystemeEnseignement
GestionGroupes: (req, res) => {
       
    if(req.session.etablissement)      
   {
    
   
        db.query("SELECT distinct (filiere)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"';SELECT distinct (specialite)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"';SELECT distinct (abriviation)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"'", [0, 1,2], function(err, result) {
            if (err) throw err;
           
            res.render('Gestion_groupesEtudiants.ejs', {
                filieres: result[0],
                specialites: result[1],
                abriviations: result[2],
                 'etablissement':req.session.etablissement,
                 'cycle':req.session.cycle,
            message: ''
        });
    });   
    }
else{ res.redirect("/"); }
},


//Ajouter Groupe

AjoutGroupe: (req, res) => {
       
    if(req.session.etablissement)
           
   { 
    let etablissement = req.body.etablissement;
    let filiere = req.body.filiere;
    let niveaux=null;
    let categorie = req.body.categorie;
    let abriviation = req.body.abriviation;
    let specialite = req.body.specialite;
    let sous_categorie = req.body.sous_categorie;
    if(categorie=='licence')
    { niveaux = req.body.niveaux_licence;
        nbgroupe = req.body.groupe_licence;
    }
    else if(categorie=='Master')
    { niveaux = req.body.niveaux_master;
        nbgroupe = req.body.groupe_master;
    }
    else if(categorie=='Doctora')
    { niveaux = req.body.niveaux_doctora;
        nbgroupe = req.body.groupe_doctora;}
     else if(categorie=='ingenieur')
        { niveaux = req.body.niveaux_ingenieur;
            nbgroupe = req.body.groupe_ingenieur;}
    else if(categorie=='prep')
        { niveaux = req.body.niveaux_prep;
         nbgroupe = req.body.groupe_prep;}
        else if(categorie=='medecine')
         { niveaux = req.body.niveaux_medecine;
                    nbgroupe = req.body.groupe_medecine;}
    
    console.log('etablissement '+etablissement);
    let sql="INSERT INTO `groupes_des_etudiants`(`etablissement`, `filiere`, `specialite`, `abriviation`,`categorie`, `sous_categorie`, `niveaux`,`nb_groupe`) VALUES ('" +etablissement + "', '" + filiere + "', '" + specialite + "','" + abriviation + "','" + categorie + "', '" + sous_categorie + "','" + niveaux + "', '" + nbgroupe + "')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
        else{
            req.session.msgsG="L'ajout de "+abriviation+" a été effectué avec succès y compris "+nbgroupe+" Groupes";
       res.redirect('/Groupe_Afficher');
       message=req.session.msgsG;
        }
      });//Fin exécution requete
    }
else{ res.redirect("/"); }
},

// Pour Envois
envoisSpecifie: (req, res)=>{
    //Recupération des valeurs de formulaire
    let filiere = req.body.filiere;
    
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    let titres='"'+titre+'"';
    let type_document = req.body.type_document;
    let niveaux = req.body.niveaux;
    let categorie = req.body.categorie;
    let groupe = req.body.groupe;
    
    let specialite = req.body.specialite;
    let abriviation = req.body.abriviation;
    let destination = req.body.destination;
   
    let dt=new Date();
    let hr="";
      if(dt.getHours()<10){hr="0"+dt.getHours();}
      else {hr=dt.getHours();}
    
    let heure_envois=hr+":"+dt.getMinutes();
    let mois="";
    for(i=0;i<11;i++)
    {
      if(dt.getMonth()==0){mois="01";}
      if(dt.getMonth()==1){mois="02";}
      if(dt.getMonth()==2){mois="03";}
      if(dt.getMonth()==3){mois="04";}
      if(dt.getMonth()==4){mois="05";}
      if(dt.getMonth()==5){mois="06";}
      if(dt.getMonth()==6){mois="07";}
      if(dt.getMonth()==7){mois="08";}
      if(dt.getMonth()==8){mois="09";}
      if(dt.getMonth()==9){mois="10";}
      if(dt.getMonth()==10){mois="11";}
      if(dt.getMonth()==11){mois="12";}
    }
    let date_envois=dt.getDate()+"/"+mois+"/"+dt.getFullYear();
    if(req.files==null)
   {
    req.session.ErrorEnvois="il faut choisir une piece jointe";
    res.redirect("/getNumInscriptionRechGroupe/"+groupe+"/"+filiere+"/"+categorie+"/"+niveaux+"/"+specialite+"/"+abriviation);
    ErrorEnvois=req.session.ErrorEnvois;
   }
   else{
    let docs = req.files.document;
 let documents=docs.name;
  // upload the file to the /public/assets/img directory
  docs.mv(__dirname+`/../assets/documents/${documents}`, (err ) => {
    if (err) {
        return res.status(500).send(err);
    }
    if(destination=='enseignant')
    {
        destination=req.body.enseignant;
    }
    else if(destination=='etudiant')
    {
        destination=req.body.etudiant;
    }
    else{
        destination=null;
    }
 //Requete insertion
   
    let sql="INSERT INTO  `envois`(`etablissement`,`titre`, `type_document`, `groupe`,`enseignant`, `categorie_diplome`, `niveaux`, `filiere`, `specialite`, `abriviation`, `document`, `date_envois`) VALUES ('" +etablissement + "'," +titres + ", '" + type_document + "', '" + groupe + "', '" + destination + "', '" + categorie + "', '" + niveaux + "', '" + filiere + "', '" + specialite + "', '" + abriviation + "','"+documents+"','"+date_envois+"')";
    //Exécution de requete
  
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
        else{
              /***********Notifications********* */
        // GetDernierId
       
        let getIdEnvois="select * from envois ORDER BY id DESC LIMIT 1 ";
        db.query(getIdEnvois,(err,resultLastId) =>{
            Object.keys(resultLastId).forEach(function(key) {
                let gnv=groupe+' '+abriviation;
                var cle = resultLastId[key];
                idLast=cle.id; 
                let sqlnotification="INSERT INTO  `notifications`(`etablissement`, `emmeteur`, `date_creation`, `heure_envois`, `type`, `destination`, `etat`,`id_source`) VALUES('" +etablissement + "','" +etablissement + "','" +date_envois+ "','" +heure_envois+ "', 'un avis pour ton groupe ', '" + gnv + "','0', '" + idLast + "')";
                db.query(sqlnotification);

            });   
        });
      
        // Fin dernier id
   
    /***************Fin notification *********/
           
            req.session.msgs="L'affichage de l'avis ciblé a été effectué avec succès   ";
          
           
      res.redirect("/getNumInscriptionRechGroupe/"+groupe+"/"+filiere+"/"+categorie+"/"+niveaux+"/"+specialite+"/"+abriviation);
     msgs=req.session.msgs;
        }  
    });//Fin exécution requete
    });

}
},

// Pour Envois
envois: (req, res)=>{
    //Recupération des valeurs de formulaire
    let filiere = req.body.filiere;
    
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    let titres='"'+titre+'"';
    let type_document = req.body.type_document;
    let niveaux = req.body.niveaux;
    let categorie = req.body.categorie;
    let groupe = req.body.groupe;
    
    let specialite = req.body.specialite;
    let abriviation = req.body.abriviation;
    let destination = req.body.destination;
   
    let dt=new Date();
    let mois="";
    for(i=0;i<11;i++)
    {
      if(dt.getMonth()==0){mois="01";}
      if(dt.getMonth()==1){mois="02";}
      if(dt.getMonth()==2){mois="03";}
      if(dt.getMonth()==3){mois="04";}
      if(dt.getMonth()==4){mois="05";}
      if(dt.getMonth()==5){mois="06";}
      if(dt.getMonth()==6){mois="07";}
      if(dt.getMonth()==7){mois="08";}
      if(dt.getMonth()==8){mois="09";}
      if(dt.getMonth()==9){mois="10";}
      if(dt.getMonth()==10){mois="11";}
      if(dt.getMonth()==11){mois="12";}
    }
    let date_envois=dt.getDate()+"/"+mois+"/"+dt.getFullYear();
    if(req.files==null)
    {
     req.session.ErrorEnvois="il faut choisir une piece jointe";
     res.redirect("/getNumInscriptionRechGroupe/"+groupe+"/"+filiere+"/"+categorie+"/"+niveaux+"/"+specialite+"/"+abriviation);
     ErrorEnvois=req.session.ErrorEnvois;
    }
    else{
        let docs = req.files.document;
    let documents=docs.name;
  // upload the file to the /public/assets/img directory
  docs.mv(__dirname+`/../assets/documents/${documents}`, (err ) => {
    if (err) {
        return res.status(500).send(err);
    }
    if(destination=='enseignant')
    {
        let destinations=req.body.enseignant;
        destination=destinations+'\r';
    }
    else if(destination=='etudiant')
    {
        destination=req.body.etudiant;
    }
    else{
        destination=null;
    }
 //Requete insertion
   
    let sql="INSERT INTO  `envois`(`etablissement`,`titre`, `type_document`, `groupe`,`enseignant`, `categorie_diplome`, `niveaux`, `filiere`, `specialite`, `abriviation`, `document`, `date_envois`) VALUES ('" +etablissement + "'," +titres + ", '" + type_document + "', '" + groupe + "', '" + destination + "', '" + categorie + "', '" + niveaux + "', '" + filiere + "', '" + specialite + "', '" + abriviation + "','"+documents+"','"+date_envois+"')";
    //Exécution de requete
  
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
       
        else{

           if (groupe==null )
           {
           // console.log("Groupe Nulllllllll========= "+groupe);
            if(type_document=='Emplois du temps')
            {
                req.session.GestionEnseignants=" L'affichag de l'emplois du temps "+ destination +" a été effectué avec succès ";
            }
            else if(type_document=='Calendrier examen')
            {
                req.session.GestionEnseignants=" L'affichage de calendrier examen "+ destination +" a été effectué avec succès ";
            }
            else if(type_document=='avis')
            {
                req.session.GestionEnseignants=" L'affichage de l'avis ciblé  "+ destination +" a été effectué avec succès ";
            }
            res.redirect("/GestionEnseignants");
            message:req.session.GestionEnseignants;
           }
           else if(groupe!=null)
            {
                console.log("Groupe !=null ========= "+groupe);
                        if(type_document=='Emplois du temps')
                    {
                        req.session.msgs=" L'affichage de l'emplois du temps a été effectué avec succès ";
                    }
                    else if(type_document=='Calendrier examen')
                    {
                        req.session.msgs=" L'affichage de calendrier examen a été effectué avec succès ";
                    }
        res.redirect("/getNumInscriptionRechGroupe/"+groupe+"/"+filiere+"/"+categorie+"/"+niveaux+"/"+specialite+"/"+abriviation);
        msgs=req.session.msgs;    
    }
      
    
            else {
                res.redirect("/GestionEnseignants");
                message:req.session.GestionEnseignants;
            }
       
           
        }
       // res.redirect("/getNumInscriptionRechGroupe/"+groupe+"/"+filiere+"/"+categorie+"/"+niveaux+"/"+specialite+"/"+abriviation);
        
    });//Fin exécution requete
    });
    }

}, //Fin Fonction inscriptions apprenants

// Pour Envois
envoisTous: (req, res)=>{
    //Recupération des valeurs de formulaire
   let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    let titres='"'+titre+'"';
    let type_document = req.body.type_document;
  
    let destination = req.body.destination;
    let docs = req.files.document;
  
    let documents=docs.name;
     /***Date */
     let dt=new Date();
    let mois="";
    let hr="";
    if(dt.getHours()<10){hr="0"+dt.getHours();}
    else {hr=dt.getHours();}
  let heure_envois=hr+":"+dt.getMinutes();
    for(i=0;i<11;i++)
    {
      if(dt.getMonth()==0){mois="01";}
      if(dt.getMonth()==1){mois="02";}
      if(dt.getMonth()==2){mois="03";}
      if(dt.getMonth()==3){mois="04";}
      if(dt.getMonth()==4){mois="05";}
      if(dt.getMonth()==5){mois="06";}
      if(dt.getMonth()==6){mois="07";}
      if(dt.getMonth()==7){mois="08";}
      if(dt.getMonth()==8){mois="09";}
      if(dt.getMonth()==9){mois="10";}
      if(dt.getMonth()==10){mois="11";}
      if(dt.getMonth()==11){mois="12";}
    }
    let date_envois=dt.getDate()+"/"+mois+"/"+dt.getFullYear();
  // upload the file to the /public/assets/img directory
  docs.mv(__dirname+`/../assets/documents/${documents}`, (err ) => {
    if (err) {
        return res.status(500).send(err);
    }
    
 //Requete insertion
   
    let sql="INSERT INTO  `envois`(`etablissement`,`titre`, `type_document`,`enseignant` ,`document`, `date_envois`) VALUES ('" +etablissement + "'," +titres + ", '" + type_document + "', '" + destination + "','"+documents+"','"+date_envois+"')";
    
    //Exécution de requete
  
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
        else{
            /***********Notifications********* */
            // GetDernierId
            
            let getIdEnvois="select * from envois ORDER BY id DESC LIMIT 1 ";
            db.query(getIdEnvois,(err,resultLastId) =>{
                Object.keys(resultLastId).forEach(function(key) {
                    var cle = resultLastId[key];
                    idLast=cle.id; 
                    let sqlnotification="INSERT INTO  `notifications`(`etablissement`, `date_creation`,`heure_envois`, `type`, `destination`, `etat`,`id_source`) VALUES ('" +etablissement + "','"+date_envois+"', '" +heure_envois+ "','un avis pour tous les enseignants', 'tous Enseignants','0','"+idLast+"')";
                    db.query(sqlnotification);

                });   
            });
        
        // Fin dernier id

 /***************Fin notification *********/
            req.session.GestionEnseignants="L'affichage de l'avis pour tous les enseignants a été effectué avec succès ";
        res.redirect("/GestionEnseignants");
        msg=req.session.GestionEnseignants;


        }
      });//Fin exécution requete
    });

}, //Fin Fonction inscriptions apprenants



// Pour envoisRattrappage
envoisRattrappage: (req, res)=>{
    //Recupération des valeurs de formulaire
    let matiere = req.body.matiere;
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
   let groupe = req.body.num_groupe;
   let type_document = req.body.type_document;
    let abriviation = req.body.abriviation;
    let destination = req.body.enseignant;
    let docs = req.files.document;
    let dt=new Date();
    let mois="";
    for(i=0;i<11;i++)
    {
      if(dt.getMonth()==0){mois="01";}
      if(dt.getMonth()==1){mois="02";}
      if(dt.getMonth()==2){mois="03";}
      if(dt.getMonth()==3){mois="04";}
      if(dt.getMonth()==4){mois="05";}
      if(dt.getMonth()==5){mois="06";}
      if(dt.getMonth()==6){mois="07";}
      if(dt.getMonth()==7){mois="08";}
      if(dt.getMonth()==8){mois="09";}
      if(dt.getMonth()==9){mois="10";}
      if(dt.getMonth()==10){mois="11";}
      if(dt.getMonth()==11){mois="12";}
    }
    let date_envois=dt.getDate()+"/"+mois+"/"+dt.getFullYear(); 
    let documents=docs.name;
    docs.mv(__dirname+`/../assets/documents/${documents}`, (err ) => { 

 //Requete insertion
   
    let sql="INSERT INTO  `envois`(`etablissement`,`titre`,  `type_document`, `groupe`,`enseignant`, `specialite`, `abriviation`, `document`, `date_envois`) VALUES ('" +etablissement + "','" +titre + "','" + type_document + "',  '" + groupe + "', '" + destination + "',  '" + matiere + "', '" + abriviation + "', '" + documents + "', '" + date_envois + "')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
       res.redirect('/AfficherEnseignants/'+abriviation+'/'+groupe);
      });//Fin exécution requete
    });

}, //Fin Fonction inscriptions apprenants

// Pour envois_enseignant_etudiant
envois_enseignant_etudiant: (req, res)=>{
    //Recupération des valeurs de formulaire
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    let titres='"'+titre+'"';
    let msg = req.body.msg;
    let msgs='"'+msg+'"';
    let photo_enseignant = req.body.photoEnseignant;
   // let msg=msg.replace("'","\'",req.body.msg);
    let type_document = req.body.nature_document;
    let enseignant = req.body.enseignant;
    let groupe = req.body.groupe;
    let etat = req.body.etat;
    let matiere = req.body.matiere;
    let matieres='"'+matiere+'"';
    let date = req.body.date;
    let abriviation = req.body.abriviation;
     
    let dt=new Date();
    let hr="";
      if(dt.getHours()<10){hr="0"+dt.getHours();}
      else {hr=dt.getHours();}
    let heure_envois=hr+":"+dt.getMinutes();
    let mois="";
    /*****Pour redirecttion*** */
    let filiere = req.body.filiere;
    let categorie = req.body.categorie;
    let niveaux = req.body.niveaux;
   
    let specialite = req.body.specialite;
    /*******Fin redirection */
    for(i=0;i<11;i++)
    {
      if(dt.getMonth()==0){mois="01";}
      if(dt.getMonth()==1){mois="02";}
      if(dt.getMonth()==2){mois="03";}
      if(dt.getMonth()==3){mois="04";}
      if(dt.getMonth()==4){mois="05";}
      if(dt.getMonth()==5){mois="06";}
      if(dt.getMonth()==6){mois="07";}
      if(dt.getMonth()==7){mois="08";}
      if(dt.getMonth()==8){mois="09";}
      if(dt.getMonth()==9){mois="10";}
      if(dt.getMonth()==10){mois="11";}
      if(dt.getMonth()==11){mois="12";}
    }
    let date_envois=dt.getDate()+"/"+mois+"/"+dt.getFullYear();
    let classe=abriviation+' '+groupe;
    let documents="";
    if(req.files==null)
    {
    /* req.session.msgEnvois_enseignant_etudiantFile="il faut choisir une piece jointe";
     res.redirect('/getEtudiantsClasse/'+classe);
     messageFile=req.session.msgEnvois_enseignant_etudiantFile;*/
      documents="";
    }
    else{

    let docs = req.files.document;
    let documents=docs.name;
  // upload the file to the /public/assets/img directory
  docs.mv(__dirname+`/../assets/documents/${documents}`, (err ) => {
        if (err) {
            return res.status(500).send(err);
        }
    });
    }   
 //Requete insertion
 let idLast=0;
    let sql="INSERT INTO   `envois_enseignant_etudiant`(`etablissement`, `titre`, `message`, `nature_document`, `groupe`, `etudiant`, `date`, `enseignant`, `matiere`, `abriviation`, `document`, `etat`, `date_envois`,`photo_enseignant`) VALUES('" +etablissement + "'," +titres + "," +msgs+ ", '" + type_document + "', '" + groupe + "','', '" + date + "','" + enseignant + "', " + matieres + ", '" + abriviation + "','"+documents+"','"+etat+"','"+date_envois+"', '"+photo_enseignant+"')";
    
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
        else{

     /***********Notifications********* */
        // GetDernierId
       
            let getIdEnvois="select * from envois_enseignant_etudiant ORDER BY id DESC LIMIT 1 ";
            let gnv=groupe+' '+abriviation;
            db.query(getIdEnvois,(err,resultLastId) =>{
                Object.keys(resultLastId).forEach(function(key) {
                    var cle = resultLastId[key];
                    idLast=cle.id; 
                    let sqlnotification="INSERT INTO  `notifications`(`etablissement`, `emmeteur`, `date_creation`,`heure_envois`, `type`, `destination`, `etat`,`id_source`) VALUES('" +etablissement + "','" +enseignant + "','" +date_envois+ "','" +heure_envois+ "', 'une annonce', '" + gnv + "','0', '" + idLast + "')";
                    db.query(sqlnotification);

                });   
            });
          
            // Fin dernier id
       
    /***************Fin notification *********/
            if(type_document=="td")
            {
                req.session.msgEnvois_enseignant_etudiant="Ajout Tds Enseignant etudiant effectué";
            }
            else  if(type_document=="notes")
            {
                req.session.msgEnvois_enseignant_etudiant="Ajout Notes Enseignant etudiant effectué";
            }

            else  if(type_document=="cours")
            {
                req.session.msgEnvois_enseignant_etudiant="Ajout cours Enseignant etudiant effectué";
            }

           

           
           
            res.redirect('/getEtudiantsClasse/'+classe);
       messageEnvois_enseignant_etudiant=req.session.msgEnvois_enseignant_etudiant   
    } 
    
    });//Fin exécution requete
   
}, //Fin Fonction inscriptions apprenants

// Pour envois_enseignant_etudiant
envois_enseignantEtudiant: (req, res)=>{
    //Recupération des valeurs de formulaire
  
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    let msg = req.body.msg;
    let photo_enseignant = req.body.photoEnseignant;
    let type_document = req.body.nature_document;
    let enseignant = req.body.enseignant;
    let etudiant = req.body.etudiant;
    let groupe = req.body.groupe;
    let etat = req.body.etat;
    let matiere = req.body.matiere;
    let date = req.body.date;
    let abriviation = req.body.abriviation;
    
    let categorie = req.body.categorie;
   
    let niveaux = req.body.niveaux;
    let specialite = req.body.specialite;
    let filiere = req.body.filiere;


    let docs = req.files.document;
    let dt=new Date();
    let mois="";
    for(i=0;i<11;i++)
    {
      if(dt.getMonth()==0){mois="01";}
      if(dt.getMonth()==1){mois="02";}
      if(dt.getMonth()==2){mois="03";}
      if(dt.getMonth()==3){mois="04";}
      if(dt.getMonth()==4){mois="05";}
      if(dt.getMonth()==5){mois="06";}
      if(dt.getMonth()==6){mois="07";}
      if(dt.getMonth()==7){mois="08";}
      if(dt.getMonth()==8){mois="09";}
      if(dt.getMonth()==9){mois="10";}
      if(dt.getMonth()==10){mois="11";}
      if(dt.getMonth()==11){mois="12";}
    }
    let date_envois=dt.getDate()+"/"+mois+"/"+dt.getFullYear();
    let documents=docs.name;
  // upload the file to the /public/assets/img directory
  docs.mv(__dirname+`/../assets/documents/${documents}`, (err ) => {
    if (err) {
        return res.status(500).send(err);
    }
   
 //Requete insertion
   
    let sql="INSERT INTO   `envois_enseignant_etudiant`(`etablissement`, `titre`, `message`, `nature_document`, `groupe`, `etudiant`, `date`, `enseignant`, `matiere`, `abriviation`, `document`, `etat`, `date_envois`,`photo_enseignant`) VALUES('" +etablissement + "','" +titre + "','" +msg + "', '" + type_document + "', '" + groupe + "','"+etudiant+"', '" + date + "','" + enseignant + "', '" + matiere + "', '" + abriviation + "','"+documents+"','"+etat+"','"+date_envois+"', '"+photo_enseignant+"')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
        else{
            if(type_document=="td")
            {
                req.session.msgEnvois_enseignant_etudiant="Ajout Tds Enseignant etudiant effectué "+etudiant;
            }
            else  if(type_document=="notes")
            {
                req.session.msgEnvois_enseignant_etudiant="Ajout Notes Enseignant etudiant effectué "+etudiant;
            }

            else  if(type_document=="cours")
            {
                req.session.msgEnvois_enseignant_etudiant="Ajout cours Enseignant etudiant effectué "+etudiant;
            }

        res.redirect('/getNumEtudiantsGroupe/'+groupe+'/'+filiere+'/'+categorie+'/'+niveaux+'/'+specialite+'/'+abriviation);
      
          }  //res.redirect('/Groupe_Enseignant');
      });//Fin exécution requete
    });

}, //Fin Fonction inscriptions apprenants


//Ajout Evenement 

Evenement_Ajout: (req, res)=>{
    //Recupération des valeurs de formulaire
  
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    let presentation = req.body.presentation;
    let titres='"'+titre+'"';
    let presentations='"'+presentation+'"';
    let date = req.body.date;
    let heure = req.body.heure;
    let dt=new Date();
    let mois="";
    let hr="";
    if(dt.getHours()<10){hr="0"+dt.getHours();}
    else {hr=dt.getHours();}
  let heure_envois=hr+":"+dt.getMinutes();
    for(i=0;i<11;i++)
    {
      if(dt.getMonth()==0){mois="01";}
      if(dt.getMonth()==1){mois="02";}
      if(dt.getMonth()==2){mois="03";}
      if(dt.getMonth()==3){mois="04";}
      if(dt.getMonth()==4){mois="05";}
      if(dt.getMonth()==5){mois="06";}
      if(dt.getMonth()==6){mois="07";}
      if(dt.getMonth()==7){mois="08";}
      if(dt.getMonth()==8){mois="09";}
      if(dt.getMonth()==9){mois="10";}
      if(dt.getMonth()==10){mois="11";}
      if(dt.getMonth()==11){mois="12";}
    }
    let date_envois=dt.getDate()+"/"+mois+"/"+dt.getFullYear();
  console.log("Files "+req.files);
   if(req.files==null)
   {
    req.session.ErrorGroupe_Afficher="il faut choisir une piece jointe";
    res.redirect('/Groupe_Afficher');
    message=req.session.ErrorGroupe_Afficher;
   }
   else{
   let docs = req.files.photo;
     let photos=docs.name;
  // upload the file to the /public/assets/img directory
  
  docs.mv(__dirname+`/../assets/images/${photos}`, (err ) => {
    if (err) {
        req.session.ErrorGroupe_Afficher="il faut choisir une piece jointe";
        res.redirect('/Groupe_Afficher');
        message=req.session.ErrorGroupe_Afficher;
    }
   
 //Requete insertion
   
    let sql="INSERT INTO `evenements`(`titre`, `presentation`, `photo`, `date`, `heure`, `etablissement`, `type`) VALUES(" +titres + "," +presentations + ",'" +photos + "', '" + date + "', '" + heure + "','"+etablissement+"','evenement')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            req.session.ErrorGroupe_Afficher="Erreur d'Ajout";
    res.redirect('/Groupe_Afficher');
    message=req.session.ErrorGroupe_Afficher;
        }
        else{

              /***********Notifications********* */
        // GetDernierId
       
        let getIdEnvois="select * from evenements ORDER BY id DESC LIMIT 1 ";
        db.query(getIdEnvois,(err,resultLastId) =>{
            Object.keys(resultLastId).forEach(function(key) {
                var cle = resultLastId[key];
                idLast=cle.id; 
                let sqlnotification="INSERT INTO  `notifications`(`etablissement`, `emmeteur`, `date_creation`, `heure_envois`,`type`, `destination`, `etat`,`id_source`) VALUES('" +etablissement + "','" +etablissement + "','" +date_envois+ "','" +heure_envois+ "', 'un événement', 'tous','0', '" + idLast + "')";
                db.query(sqlnotification);

            });   
        });
      
        // Fin dernier id
   
/***************Fin notification *********/
        req.session.msgsG="L'affichage de l'événement a été effectué avec succès";
       res.redirect('/Groupe_Afficher');
       message=req.session.msgsG;
        }
      });//Fin exécution requete
    });
   }
}, //Fin Fonction inscriptions apprenants

Avis_Ajout: (req, res)=>{
    //Recupération des valeurs de formulaire
  
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    
    
    let date = req.body.date;
    if(req.files==null)
   {
    req.session.ErrorGroupe_Afficher="il faut choisir une piece jointe";
    res.redirect('/Groupe_Afficher');
    message=req.session.ErrorGroupe_Afficher;
   }
   else{
   let docs = req.files.photo;
     let photos=docs.name;
  // upload the file to the /public/assets/img directory
  docs.mv(__dirname+`/../assets/documents/${photos}`, (err ) => {
    if (err) {
        return res.status(500).send(err);
    }
   let titres='"'+titre+'"';
   console.log("Titres "+titres+"\n");
 //Requete insertion
   
    let sql="INSERT INTO `envois`(`etablissement`, `titre`, `type_document`,`groupe`, `etudiant`, `document`,`date_envois` ) VALUES('"+etablissement+"',"+titres+",'avis','tous','tous','" +photos + "', '" + date + "')";
    console.log(sql);
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
        else{
              /***********Notifications********* */
        // GetDernierId
        let dt=new Date();
        let hr="";
      if(dt.getHours()<10){hr="0"+dt.getHours();}
      else {hr=dt.getHours();}
        let heure_envois=hr+":"+dt.getMinutes();
        let getIdEnvois="select * from envois ORDER BY id DESC LIMIT 1 ";
        db.query(getIdEnvois,(err,resultLastId) =>{
            Object.keys(resultLastId).forEach(function(key) {
                var cle = resultLastId[key];
                idLast=cle.id; 
                let sqlnotification="INSERT INTO  `notifications`(`etablissement`, `emmeteur`, `date_creation`, `heure_envois`,`type`, `destination`, `etat`,`id_source`) VALUES('" +etablissement + "','" +etablissement + "','" +date+ "', '" +heure_envois+ "','un avis pour tous les étudiants', 'avis pour tous les groupes','0', '" + idLast + "')";
                db.query(sqlnotification);

            });   
        });
      
        // Fin dernier id
   
    /***************Fin notification *********/
            req.session.msgsG=" L'affichage de l'avis général a été effectué avec succès ";
       res.redirect('/Groupe_Afficher');
       message=req.session.msgsG;
    }
      });//Fin exécution requete
    });
   }
}, //Fin Fonction inscriptions apprenants

Avis_Ajout_Niveaux: (req, res)=>{
    //Recupération des valeurs de formulaire
  
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    let titres='"'+titre+'"';
    let recupCatNiveaux = req.body.niveaux;
   let resSplite= recupCatNiveaux.split(" ");
   // console.log(resSplite[0]);
    let date = req.body.date;
    if(req.files==null)
   {
    req.session.ErrorGroupe_Afficher="il faut choisir une piece jointe";
    res.redirect('/Groupe_Afficher');
    message=req.session.ErrorGroupe_Afficher;
   }
   else{
   let docs = req.files.photo;
     let photos=docs.name;
 // upload the file to the /public/assets/img directory
  docs.mv(__dirname+`/../assets/documents/${photos}`, (err ) => {
    if (err) {
        return res.status(500).send(err);
    }
    //res.send('File uploaded!');
   
 //Requete insertion
 let dt=new Date();
 let hr="";
      if(dt.getHours()<10){hr="0"+dt.getHours();}
      else {hr=dt.getHours();}
  let heure_envois=hr+":"+dt.getMinutes();
 let niveaux = req.body.niveaux;
    let sql="INSERT INTO `envois`(`etablissement`, `titre`, `type_document`,`groupe`,`categorie_diplome`, `niveaux`, `document`,`date_envois` ) VALUES('"+etablissement+"'," +titres + ",'avis','vide','" +resSplite[1] + "','" +resSplite[0] + "','" +photos + "', '" + date + "')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
        else{
              /***********Notifications********* */
        // GetDernierId
       
        let getIdEnvois="select * from envois ORDER BY id DESC LIMIT 1 ";
        db.query(getIdEnvois,(err,resultLastId) =>{
            Object.keys(resultLastId).forEach(function(key) {
                var cle = resultLastId[key];
                idLast=cle.id; 
                let sqlnotification="INSERT INTO  `notifications`(`etablissement`, `emmeteur`, `date_creation`, `heure_envois`,`type`, `destination`, `etat`,`id_source`) VALUES('" +etablissement + "','" +etablissement + "','" +date+ "','" +heure_envois+ "', 'a ton niveau', '" + niveaux + "','0', '" + idLast + "')";
                db.query(sqlnotification);

            });   
        });
      
        // Fin dernier id
   
    /***************Fin notification *********/
            req.session.msgsG=" L'affichage de l'avis pour " +recupCatNiveaux +" a été effectué avec succès ";
       res.redirect('/Groupe_Afficher');
       message=req.session.msgsG;
    }
      });//Fin exécution requete
    });
   }
}, //Fin Fonction inscriptions apprenants

evenement_Afficher: (req, res) => {
   
    //let groupe=req.params.groupe;
    

      let query="select * from  evenements where etablissement='"+req.session.etablissement+"'";
       
      db.query(query, (err, result) => {
         if (err) {
             res.redirect('/');
         }
       
         res.render('evenements/afficher.ejs', {
            
             etablissement:req.session.etablissement,
            
            
             evenements:result,
           message: ''
     });
 });
},

Declaration_Absences: (req, res) => {
    if( req.session.etablissement==null)
         {
             
             res.redirect('/');
         }
    //let groupe=req.params.groupe;
    
    req.session.msg="";
    req.session.msgs="";
    req.session.msgSP1="";
    req.session.msgAE="";
    req.session.msgsG="";  
    req.session.GestionEnseignants="";
    req.session.ErrorEnvois="";
    req.session.Error="";
      let query="select * from  absences_enseignant where etablissement='"+req.session.etablissement+"'";
       
      db.query(query, (err, result) => {
         if (err) {
             res.redirect('/');
         }
       
         res.render('declaration/afficher.ejs', {
            
             etablissement:req.session.etablissement,
            
            
             declarations:result,
           message: ''
     });
 });
},
//Gestion déclaration des Absences
Gestion_Declaration_Absences: (req, res) => {
   
    let id=req.params.id;
    let etat=req.params.etat;
    console.log("Id: "+id+" etat "+etat);

      let query="update absences_enseignant set etat_validation='"+etat+"' where id='"+id+"'";
       
      db.query(query, (err, result) => {
         if (err) {
             res.redirect('/');
         }
       
         res.redirect('/Declaration_Absences');
 });
},
// Pour Ajouter SystemeEnseignement
Affectation_salle_Examen: (req, res)=>{
    //Recupération des valeurs de formulaire
    
    let etablissement = req.body.etablissement;
    let titre = req.body.titre;
    let date = req.body.date;
    let heure = req.body.heure;
    let abriviation = req.body.abriviation;
    let piece_jointes = req.files.piece_jointe;
    
    let piece_jointe=piece_jointes.name;
  //console.log("etablissement "+etablissement+" cycle "+cycle);
 //Requete insertion
 piece_jointes.mv(__dirname+`/../assets/Pieces_jointes/${piece_jointe}`, (err ) => {
    let sql="INSERT INTO `Affectation_salles_examens`(`titre`, `piece_jointe`, `date`, `heure`, `etablissement`, `abriviation`) VALUES ('" +titre + "', '" + piece_jointe + "', '" + date + "', '" + heure + "', '" + etablissement + "', '" + abriviation + "')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
       res.redirect('/Groupe_Afficher');
      });//Fin exécution requete
    

    })}, //Fin Fonction inscriptions apprenants

//Envois Emplois du temps
envois_emplois:(req, res)=>{

    if( req.session.etablissement==null){ res.redirect('/');    }
    //Récupération des valeurs des Formulaire
    let niveaux = req.body.niveaux;
    let categorie = req.body.categorie;
    let groupe = req.body.groupe;
    let filiere = req.body.filiere;
    let specialite = req.body.specialite;
    let abriviation = req.body.abriviation;


     /*******jours */
   let jours = req.body.jours;
   let jour=jours.split("\n");
   let nbjours=jour.length;
  /*******Horaires */
   let horaires = req.body.horaire;
   let horaire=horaires.split("\n");
   let nbhoraires=horaire.length;
   /*******Enseignants */
   let Enseignants = req.body.enseignant;
   let enseignant=Enseignants.split("\n");
   let nbenseignants=enseignant.length;
   /*******Matieres */
   let Matieres = req.body.matiere;
   let matiere=Matieres.split("\n");
   let nbmatieres=matiere.length;
   /*******Natures */
   let natures = req.body.nature;
   let nature=natures.split("\n");
   let nbnature=nature.length;
   /*******Salles */
   let salles = req.body.salle;
   let salle=salles.split("\n");
   let nbsalle=salle.length;
   //classe
   let classe=req.body.classe;
   //Requete Ajout
   for(let ij=0,ih=0,ie=0,im=0,inat=0,is=0;ij<nbjours,ih<nbhoraires,ie<nbenseignants,im<nbmatieres,inat<nbnature,is<nbsalle;ij++,ih++,ie++,im++,inat++,is++)
   {
    let matieresF='"'+matiere[im]+'"';
    let sql="INSERT INTO `emplois_du_temps`(`jour`, `horaire`, `enseignant`, `Matiere`, `nature`, `salle`, `classe`) VALUES ('" +jour[ij] + "',  '" + horaire[ih] + "', '" + enseignant[ie] + "', " +matieresF + ", '" + nature[inat] + "', '" + salle[is] + "', '" + classe + "')";
    // verification si enseignant ajouté ou non
   /* let selectEnseignant="select nom from `enseignant` where `nom`='" + enseignant[ie] + "'";
    console.log(selectEnseignant);
    db.query(selectEnseignant,(err,result)=>{nbselectEnseignant=result.length;
          
          console.log('nbselectEnseignant ===== '+nbselectEnseignant)
          if(nbselectEnseignant==0)
          {*/
        let sqlEnseignant="INSERT INTO `enseignant`(`nom`, `etablissement`, `mdp`) values('" + enseignant[ie] + "','"+req.session.etablissement+"','1') ON DUPLICATE KEY UPDATE nom='" + enseignant[ie] + "'";
        db.query(sqlEnseignant);
         /* }
   });*/

    // Fin Parcour
    db.query(sql);
    
   }//Fin For
   res.redirect("/getNumInscriptionRechGroupe/"+groupe+"/"+filiere+"/"+categorie+"/"+niveaux+"/"+specialite+"/"+abriviation);
},
// Notifications
notifications: (req, res) => {
    let errorMDP="";
    if(req.session.ErreurConnexion!="")
   {
       errorMDP=req.session.ErreurConnexion;   
   }
   else{
       req.session.ErreurConnexion="";
   }
   let sql="";
  //let admin=req.params.etablissement;
  if(req.session.role=='etudiant')
  {
    let niveauNotification=req.session.niveaux+' '+req.session.diplome;
    let gAbrv=req.session.groupe+' '+req.session.abriviation;
    console.log("Nivvevve "+niveauNotification)
sql="select * from  notifications where type='un événement' or destination='avis pour tous les groupes' or destination='"+gAbrv+"' or destination='"+niveauNotification+"' ORDER BY date_creation,heure_envois DESC";   

}
  else if(req.session.role=='enseignant')
  {
   sql="select * from notifications where destination='tous Enseignants' or type='un événement' ORDER BY date_creation,heure_envois DESC";
  }
  console.log(sql);
  db.query(sql,(err,result) =>{


   res.render('notifications.ejs', {
       role:req.session.role,
       errorMDP:req.session.ErreurConnexion,
       notifications:result,
   // admin:admin, 
   message: ''
   });
});
},

// Notifications
detailnotification: (req, res) => {
    let idnotification=req.params.id;
    let errorMDP="";
    if(req.session.ErreurConnexion!="")
   {
       errorMDP=req.session.ErreurConnexion;   
   }
   else{
       req.session.ErreurConnexion="";
   }
   
  //let admin=req.params.etablissement;
  let sqlnotifications="select * from notifications where id='"+idnotification+"' ORDER BY date_creation,heure_envois DESC";
  console.log("Infos Notification Requete :::: "+sqlnotifications);
  db.query(sqlnotifications,(err,resultNotification) =>{
        // Parcour de resultNotification
            Object.keys(resultNotification).forEach(function(key) {
                var resNotification = resultNotification[key];
                let idSource=resNotification.id_source; 
                console.log("Id Source  :::: "+idSource);
                let tab="";
                if(resNotification.type=="une absence"){tab="absences_enseignant";}
                else if(resNotification.type=="une annonce"){tab="envois_enseignant_etudiant";}
                else if(resNotification.type=="un avis pour tous les étudiants" || resNotification.type=="un avis pour tous les enseignants" || resNotification.type=="a ton niveau"|| resNotification.type=="un avis pour ton groupe" ){tab="envois";}
                else if(resNotification.type=="un événement"){tab="evenements";}
                console.log("Tab "+tab);
                /******** Parcour de table source avec idSource*******/
                let sqlInfosSource="select * from "+tab+" where id='"+idSource+"'";
                        console.log("Infos Source Requete :::: "+sqlInfosSource);
                        db.query(sqlInfosSource,(err,resultSource) =>{
                            res.render('detailNotification.ejs', {
                                errorMDP:req.session.ErreurConnexion,
                                detailnotifications:resultSource,
                                tab:tab,
                            // admin:admin, 
                            message: ''
                            });
    
                         
            });

                /******** Fin Parcour de table source avec idSource*******/


            });

       
        

   
});
},


};

