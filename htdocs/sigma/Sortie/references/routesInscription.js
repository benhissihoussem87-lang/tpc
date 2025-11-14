module.exports = {
    //Fonction d'affichage
   
    //Fonction pour retourner la page de conx
    AjoutNumInscription: (req, res) => {

      
        let nom_groupe=req.params.nomGroupe;
        let nomGroupe=req.params.nomGroupe;

         let query="select * from nb_inscriptions where  nom_groupe='"+nom_groupe+"'";
           
         db.query(query, (err, result) => {
            if (err) {
                res.redirect('/');
            }
           
            res.render('inscriptions/AjoutNumInscription.ejs', {
                
                nomGroupe:nomGroupe,
                inscription:result,
              message: ''
        });
    });

    },

      //Fonction pour retourner la page de conx
      getNumInscription: (req, res) => {

      
        //let nom_groupe=req.params.nomGroupe;
        let nom_Groupe=req.params.nomGroupe;
        
      console.log( "/**********************/etablissement : "+req.session.etablissement)
       console.log( "filiere : "+req.session.filiere)
       console.log( "specialite : "+req.session.specialite)
       console.log( "sous_categorie : "+req.session.sous_categorie)
       console.log( "Nom Groupe : "+nom_Groupe)
       console.log( "categorie : "+req.session.categorie)
       console.log( "niveaux : "+req.session.niveaux)
       console.log( "abriviation : "+req.session.abriviation)
       
      let query="select * from nb_inscriptions where  nom_groupe='"+nom_Groupe+"' and etablissement='"+req.session.etablissement+"' and categroie_diplome='"+req.session.categorie+"'and niveaux='"+req.session.niveaux+"' and abriviation='"+req.session.abriviation+"'and abriviation='"+req.session.abriviation+"'";
          
         db.query(query, (err, result) => {
            let nb=result.length;
            console.log("-------------------Nb == "+nb+"***************/");
            if (err) {
                res.redirect('/');
            }
           
            res.render('inscriptions/getNumInscription.ejs', {
                
                nomGroupe:nom_Groupe,
                inscription:result,
              message: ''
        });
    });
    

    },

     //Fonction pour retourner la page de conx
     getNumInscriptionRechGroupe: (req, res) => {

         if( req.session.etablissement==null)
         {
             
             res.redirect('/');
         }
      
        //let nom_groupe=req.params.nomGroupe;
        let nomGroupe=req.params.nomGroupe;
        let filiere=req.params.filiere;
        let categorie=req.params.categorie;
        let specialite=req.params.specialite;
        let niveaux=req.params.niveaux;
        let abriviation=req.params.abriviation;
      
      let msgs="";
       msgs=req.session.msgs;
           if(msgs!=null)
           { req.session.msg=msgs;}
           else{
            req.session.msg="";
           }
    // Traitement Error File
    let ErrorEnvois="";
    ErrorEnvois=req.session.ErrorEnvois;
           if(ErrorEnvois!=null)
           { req.session.msgFile=ErrorEnvois;}
           else{
            req.session.msgFile="";
           }
           req.session.GestionNumInscription="";
      db.query("select * from nb_inscriptions where  nom_groupe='"+nomGroupe+"' and etablissement='"+ req.session.etablissement+"' and categroie_diplome='"+categorie+"'and niveaux='"+niveaux+"' and filiere='"+filiere+"' and specialite='"+specialite+"';select * from enseignant where etablissement='"+req.session.etablissement+"'", [0, 1], function(err, result) {
        if (err) throw err;
      
            res.render('inscriptions/getNumInscriptionRechGroupe.ejs', {
                
                filiere:filiere,
                categorie:categorie,
                niveaux:niveaux,
                specialite:specialite,
                nomGroupe:nomGroupe,
                abriviation:abriviation,
                inscription:result[0],
                enseignants:result[1],
                etablissement:req.session.etablissement,
                
            
             message: req.session.msg,
             messageFile: req.session.msgFile
        });
    });

    },
    //Ajout Num Inscription
    // Pour retourner la page SystemeEnseignement
    AjouterNumInscriptions: (req, res) => {
    let groupe = req.body.groupe;
    /***Les nums inscription** */
    let num_Inscription = req.body.numInscription;
    /************************************** */
    let nums=num_Inscription.split("\n");
    let nbNums=nums.length;
    //console.log("length = "+nums.length);
    let etablissement = req.body.etablissement;
    let filiere = req.body.filiere;
    let niveaux = req.body.niveaux;
    let categorie = req.body.categorie;
    let nom_groupe = req.body.nom_groupe;
    let specialite = req.body.specialite;
    let abriviation = req.body.abriviation;
    let id = req.body.id;
  // console.log("groupe "+groupe+ " num " +num_Inscription);
   for(let i=0;i<nbNums;i++)
   {
       if(nums[i]!='')
       {
       //console.log("Num"+i+" == "+nums[i]+"\n");
    let sql="INSERT INTO `nb_inscriptions`(`num`,`nom_groupe`,`etablissement`,`categroie_diplome`,`niveaux`,`filiere`, `specialite`, `abriviation`) VALUES ('" +nums[i] + "',  '" + nom_groupe + "', '" + etablissement + "', '" + categorie + "', '" + niveaux + "', '" + filiere + "', '" + specialite + "', '" + abriviation + "')";
    db.query(sql);
       }
   }
   req.session.GestionNumInscription=" L'ajout des identifiants a été effectué avec succès pour le "+nom_groupe;

     res.redirect('/RechercheGroupe/'+id+'/'+abriviation);
     messageNumInscription:req.session.GestionNumInscription;
   
},
    //Ajout Num Inscription
    // Pour retourner la page SystemeEnseignement
    AjouterNumInscription: (req, res) => {
        let groupe = req.body.groupe;
        
        let num_Inscription = req.body.numInscription;
        let nom_groupe = req.body.nom_groupe;
       console.log("groupe "+groupe+ " num " +num_Inscription);
       
        let sql="INSERT INTO `nb_inscriptions`(`num`,`id_groupe`, `nom_groupe`) VALUES ('" +num_Inscription + "', '" + groupe + "', '" + nom_groupe + "')";
        //Exécution de requete
        db.query(sql,(err,result) =>{
            if(err)
            {
                message='Erreur ajout';
                return message;
            }
           res.redirect('/AfficherGroupes');
          });//Fin exécution requete
       
    },


     //demandeInscription
   
    demandeInscription: (req, res) => {
    
    
    let num_Inscription = req.body.num_inscription;
    let etablissement = req.body.etablissement;
    let nom = req.body.nom;
    let prenom = req.body.prenom;
   
 
   
    let sql="update `nb_inscriptions`set `nom`='"+nom+"',`prenom`='"+prenom+"',autorisation='demande' where `num`='"+num_Inscription+"'";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
     res.redirect('/Etudiant');
      });//Fin exécution requete
   
},

 //Autosrisation
   
 Autorisation: (req, res) => {
    
    let nomGroupe=req.params.nomGroupe;
    let filiere=req.params.filiere;
    let categorie=req.params.categorie;
    let specialite=req.params.specialite;
    let niveaux=req.params.niveaux;
    let abriviation=req.params.abriviation;
    
    let id = req.params.id;
   
 
   
    let sql="update `nb_inscriptions`set autorisation='autorise' where `id`='"+id+"'";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
     res.redirect('/getNumInscriptionRechGroupe/'+nomGroupe+'/'+filiere+'/'+categorie+'/'+niveaux+'/'+specialite+'/'+abriviation);
      });//Fin exécution requete
   
},

 //AutorisationDashboard
   
 AutorisationDashboard: (req, res) => {
    
    let nomGroupe=req.params.nomGroupe;
    let filiere=req.params.filiere;
    let categorie=req.params.categorie;
    let specialite=req.params.specialite;
    let niveaux=req.params.niveaux;
    let abriviation=req.params.abriviation;
    
    let id = req.params.id;
   
 
   
    let sql="update `nb_inscriptions`set autorisation='autorise' where `id`='"+id+"'";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
     res.redirect('/dashboard');
      });//Fin exécution requete
   
},
};

