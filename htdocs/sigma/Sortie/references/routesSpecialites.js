module.exports = {
    //Fonction d'affichage
   
    //Fonction pour retourner la page de conx
    AfficherSpecialite: (req, res) => {
        req.session.msg="";
    req.session.msgs="";
    req.session.msgAE="";
    req.session.msgsG="";  
    req.session.Error="";
    req.session.ErrorGroupe_Afficher="";
    req.session.GestionNumInscription="";
    req.session.GestionEnseignants="";
    req.session.ErrorEnvois="";
        if(req.session.msgSP1!=null)
        {
        req.session.msgSP=req.session.msgSP1;  
        }
        else{
            req.session.msgSP="";
        }
       //console.log("etablissement "+req.session.etablissement);
         let query="select * from  filieres_specialite where etablissement='"+req.session.etablissement+"' order By id desc";
           
         db.query(query, (err, result) => {
            if (err) {
                res.redirect('/');
            }
           else{ 
            res.render('specialites/Afficher.ejs', {
               
                groupes:result,
                etablissement:req.session.etablissement,
               msg:'',
               cycle:req.session.cycle,
               message:req.session.msgSP
            });
        }
        
    });

    },

    //Ajout Num Inscription
    // Pour retourner la page SystemeEnseignement
    AjouterNumInscription: (req, res) => {
    let groupe = req.body.groupe;
    
    let num_Inscription = req.body.numInscription;
   console.log("groupe "+groupe+ " num " +num_Inscription);
   
    let sql="INSERT INTO `nb_inscriptions`(`num`,`id_groupe`) VALUES ('" +num_Inscription + "', '" + groupe + "')";
    //Exécution de requete
    db.query(sql,(err,result) =>{
        if(err)
        {
            message='Erreur ajout';
            return message;
        }
       res.redirect('/AjoutNumInscription/'+groupe);
      });//Fin exécution requete
   
},


//Supprimer Groupe

//Fonction pour retourner la page de conx
DeleteGroupe: (req, res) => {

    let id=req.params.id;
     let query="delete  from groupes_des_etudiants where id="+id;
       
     db.query(query, (err, result) => {
        if (err) {
            res.redirect('/');
        }
       
        res.redirect('/Groupe_Afficher', {
           
          message: ''
    });
});

},
    
};

