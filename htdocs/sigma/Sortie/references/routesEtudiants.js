module.exports = {
    //Fonction d'affichage
    // Pour retourner la page Home Etudiant
 HomeEtudiant: (req, res) => {
       
    let sql="select distinct(nom_etablissement) from  tahoura";
    db.query(sql, (err, result) => {
        if (err) {
            res.redirect('/');
        }    
    res.render('etudiants/home.ejs', {
      etablissements:result,
    message: ''
});
});
},

messagerie_etudiant: (req, res) => {
   
    //let groupe=req.params.groupe;
    //console.log("abriviation "+abriviation +" groupe "+groupe);

      let query="select * from  groupes_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"'";
       
      db.query(query, (err, result) => {
         if (err) {
             res.redirect('/');
         }
       
         res.render('etudiants/messageries.ejs', {
            
             etablissement:req.session.etablissement,
             pseudo:req.session.pseudo,
            
             etudiants:result,
           message: ''
     });
 });
},
/***********/
Home_Etudiant: (req, res) => {
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
  //////*****Traitement de jour actuel** */
  let jourAct=dt.getDay();
  let jourActuel="";
  if(jourAct==1)
  {
    jourActuel="Lundi\r";
  }
  else if(jourAct==2)
  {
    jourActuel="Mardi\r";
  }
  else if(jourAct==3)
  {
    jourActuel="Mercredi\r";
  }
  else if(jourAct==4)
  {
    jourActuel="Jeudi\r";
  }
  else if(jourAct==5)
  {
    jourActuel="Vendredi\r";
  }
  else if(jourAct==6)
  {
    jourActuel="Samedi\r";
  }
  /********Fintraitement**** */
  id_etudiant:req.session.pseudo;
  let date_declaration=dt.getFullYear()+"-"+mois+"-"+jour;
  let date_declarationabs=jour+"/"+mois+"/"+dt.getFullYear();
  let classe=req.session.abriviation+' '+req.session.groupe;
  let heure=hr+":"+dt.getMinutes();
  let niveauNotification=req.session.niveaux+' '+req.session.diplome;
  let gAbrv=req.session.groupe+' '+req.session.abriviation;
  console.log("Nivew notification : "+niveauNotification);
  //console.log("select * from  emplois_du_temps where classe='"+classe+"' and jour='"+jourActuel+"'");
//console.log("select * from  envois where etablissement='"+req.session.etablissement+"' and type_document='avis' and groupe!='tous'  order by id Desc limit 3 ");
  db.query("select * from  groupes_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='tous'  and type_document='avis' order by id Desc limit 1;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='td' order by id Desc limit 5;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='cours' order by id Desc limit 5;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Rattrappage' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen' order by id desc limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Emplois du temps' order by id desc  limit 1;select * from   enseignant where etablissement='"+req.session.etablissement+"' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"';select * from  nb_inscriptions where id='"+req.session.id_etudiant+"';select * from  affectation_salles_examens where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='evenement' order by id Desc Limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and type_document='avis' and groupe!='tous' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' and num_groupe='"+req.session.groupe+"' order by id Desc;select * from  emplois_du_temps where classe='"+classe+"' and jour='"+jourActuel+"';select * from  emplois_du_temps where classe='"+classe+"';select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='notes' order by id Desc;select * from  notifications where type='un événement' or destination='avis pour tous les groupes' or destination='"+gAbrv+"' or destination='"+niveauNotification+"' ORDER BY date_creation,heure_envois DESC",[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18], function(err, result) {

    if (err) throw err;
       res.render('etudiants/homeEtudiant.ejs', {
       
           etablissement:req.session.etablissement,
           pseudo:req.session.pseudo,
           etudiants:result[0],
           etudiants_G_notes:result[1],
           etudiants_G_avis:result[2],
           tds: result[3],
           cours: result[4],
           rattrapages: result[5],
           calendrierExamens: result[6],
           EmploiTemps: result[7],
           enseignants: result[8],
           declarations:result[9],
           infos_Etudiants:result[10],
           affectation_salles:result[11],
           evenements:result[12],
           avis:result[13],
           absencesProf:result[14],
           EmploisJourAct:result[15],
           Emplois:result[16],
           notesEnseignants:result[17],
           notification_etudiants:result[18],
           date_declaration:date_declaration,
           date_declarationabs:date_declarationabs,
        heure_sys:heure,
         message: ''
   });
});
},

/***********/
relation_enseignant_Etudiant: (req, res) => {
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
  id_etudiant:req.session.pseudo;
  let date_declaration=dt.getFullYear()+"-"+mois+"-"+jour;
  let date_declarationabs=jour+"/"+mois+"/"+dt.getFullYear();
  let heure=hr+":"+dt.getMinutes();
//console.log("select * from  envois where etablissement='"+req.session.etablissement+"' and type_document='avis' and groupe!='tous'  order by id Desc limit 3 ");
  db.query("select * from  groupes_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='tous'  and type_document='avis' order by id Desc limit 1;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='td' order by id Desc limit 5;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='cours' order by id Desc limit 5;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Rattrappage' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen' order by id desc limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Emplois du temps' order by id desc  limit 1;select * from   enseignant where etablissement='"+req.session.etablissement+"' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"';select * from  nb_inscriptions where id='"+req.session.id_etudiant+"';select * from  affectation_salles_examens where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='evenement' order by id Desc Limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and type_document='avis' and groupe!='tous' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' and num_groupe='"+req.session.groupe+"' order by id Desc;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='notes' order by id Desc",[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], function(err, result) {
      if (err) throw err;
     
       res.render('etudiants/relation_enseignant_Etudiant.ejs', {
       
           etablissement:req.session.etablissement,
           pseudo:req.session.pseudo,
           
          
           etudiants:result[0],
           etudiants_G_notes:result[1],
           etudiants_G_avis:result[2],
           tds: result[3],
           cours: result[4],
           rattrapages: result[5],
           calendrierExamens: result[6],
           EmploiTemps: result[7],
           enseignants: result[8],
           declarations:result[9],
           infos_Etudiants:result[10],
           affectation_salles:result[11],
           evenements:result[12],
           avis:result[13],
           absencesProf:result[14],
           notesEnseignants:result[15],
           date_declaration:date_declaration,
           date_declarationabs:date_declarationabs,
        heure_sys:heure,
         message: ''
   });
});
},

// Pour retourner la page Home Enseignant
ProfilEtudiant: (req, res) => {
  
  id_etudiant:req.session.pseudo;
  db.query("select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='notes' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='avis' order by id Desc;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='td' order by id Desc;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='cours' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Rattrappage' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen' order by id desc limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Emplois du temps' order by id desc  limit 1;select * from   enseignant where etablissement='"+req.session.etablissement+"' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"';select * from  nb_inscriptions where id='"+req.session.id_etudiant+"';select * from  affectation_salles_examens where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='evenement' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='avis' order by id Desc Limit 1",[0,1,2,3,4,5,6,7,8,9,10,11,12,13], function(err, result) {
      if (err) throw err;
     
       res.render('etudiants/ProfilEtudiant.ejs', {
          
           etablissement:req.session.etablissement,
           pseudo:req.session.pseudo,
           nom:req.session.nom,
          
           etudiants:result[0],
           etudiants_G_notes:result[1],
           etudiants_G_avis:result[2],
           tds: result[3],
           cours: result[4],
           rattrapages: result[5],
           calendrierExamens: result[6],
           EmploiTemps: result[7],
           enseignants: result[8],
           declarations:result[9],
           infos_Etudiants:result[10],
           affectation_salles:result[11],
           evenements:result[12],
           avis:result[13],
         message: ''
   });
});
  
         

},
//Detail Envois
detailEnvois: (req, res) => {
   
  let id=req.params.id;
  //console.log("abriviation "+abriviation +" groupe "+groupe);

    let query="select * from  envois_enseignant_etudiant where id='"+id+"'";
     
    db.query(query, (err, result) => {
       if (err) {
           res.redirect('/');
       }
     
       res.render('etudiants/detailEnvois.ejs', {
          
         
           detailEnvois:result,
         message: ''
   });
});
},
//Tous les cours

Tous_cours: (req, res) => {
  id_etudiant:req.session.pseudo;
  db.query("select * from  groupes_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='avis' order by id Desc limit 3;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='cours' order by id Desc;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='cours' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Rattrappage' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen' order by id desc limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Emplois du temps' order by id desc  limit 1;select * from   enseignant where etablissement='"+req.session.etablissement+"' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"';select * from  nb_inscriptions where id='"+req.session.id_etudiant+"';select * from  affectation_salles_examens where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='evenement' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='avis' order by id Desc Limit 2",[0,1,2,3,4,5,6,7,8,9,10,11,12,13], function(err, result) {
      if (err) throw err;
     
       res.render('etudiants/Tous_cours.ejs', {
          
           etablissement:req.session.etablissement,
           pseudo:req.session.pseudo,

           etudiants:result[0],
           etudiants_G_notes:result[1],
           etudiants_G_avis:result[2],
        
           cours: result[3],
           rattrapages: result[4],
           calendrierExamens: result[5],
           EmploiTemps: result[6],
           enseignants: result[7],
           declarations:result[8],
           infos_Etudiants:result[9],
           affectation_salles:result[10],
           evenements:result[11],
           avis:result[12],
         message: ''
   });
});
},


//Tous les tds

Tous_tds: (req, res) => {
  id_etudiant:req.session.pseudo;
  db.query("select * from  groupes_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='avis' order by id Desc limit 3;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='td' order by id Desc;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='td' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Rattrappage' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen' order by id desc limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Emplois du temps' order by id desc  limit 1;select * from   enseignant where etablissement='"+req.session.etablissement+"' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"';select * from  nb_inscriptions where id='"+req.session.id_etudiant+"';select * from  affectation_salles_examens where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='evenement' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='avis' order by id Desc Limit 2",[0,1,2,3,4,5,6,7,8,9,10,11,12,13], function(err, result) {
      if (err) throw err;
     
       res.render('etudiants/Tous_tds.ejs', {
          
           etablissement:req.session.etablissement,
           pseudo:req.session.pseudo,
           
          
           etudiants:result[0],
           etudiants_G_notes:result[1],
           etudiants_G_avis:result[2],
        
           tds: result[3],
           rattrapages: result[4],
           calendrierExamens: result[5],
           EmploiTemps: result[6],
           enseignants: result[7],
           declarations:result[8],
           infos_Etudiants:result[9],
           affectation_salles:result[10],
           evenements:result[11],
           avis:result[12],
         message: ''
   });
});
},

// Affichage Tous les avis Pour Etudiants

Tous_les_avisEtudiants: (req, res) => {
  let niveauNotification=req.session.niveaux+' '+req.session.diplome;
    let gAbrv=req.session.groupe+' '+req.session.abriviation;
  id_etudiant:req.session.pseudo;
  db.query("select * from  groupes_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='avis' order by id Desc Limit 5;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='td' order by id Desc;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='cours' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Rattrappage' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen' order by id desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Emplois du temps' order by id desc ;select * from   enseignant where etablissement='"+req.session.etablissement+"' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"';select * from  nb_inscriptions where id='"+req.session.id_etudiant+"';select * from  affectation_salles_examens where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' order by id Desc ;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='evenement' order by id Desc ;select * from  envois where etablissement='"+req.session.etablissement+"' and type_document='avis' order by id Desc ;select * from  notifications where type='un événement' or destination='avis pour tous les groupes' or destination='"+gAbrv+"' or destination='"+niveauNotification+"' ORDER BY date_creation,heure_envois DESC",[0,1,2,3,4,5,6,7,8,9,10,11,12,13], function(err, result) {
      if (err) throw err;
     
       res.render('etudiants/Tous_les_avisEtudiants.ejs', {
          
           etablissement:req.session.etablissement,
           pseudo:req.session.pseudo,
           
          
           etudiants:result[0],
           etudiants_G_notes:result[1],
           etudiants_G_avis:result[2],
           tds: result[3],
           cours: result[4],
           rattrapages: result[5],
           calendrierExamens: result[6],
           EmploiTemps: result[7],
           enseignants: result[8],
           declarations:result[9],
           infos_Etudiants:result[10],
           affectation_salles:result[11],
           evenements:result[12],
           avis:result[13],
           notification_etudiants:result[14],
         message: ''
   });
});
},




//Fin AFfichage
Home_Etudiant2: (req, res) => {
  id_etudiant:req.session.pseudo;
  db.query("select * from  groupes_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='avis' order by id Desc;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='td' order by id Desc;select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='cours' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Rattrappage' order by id Desc;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen' order by id desc limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Emplois du temps' order by id desc  limit 1;select * from   enseignant where etablissement='"+req.session.etablissement+"' order by id Desc;select * from  absences_enseignant where etablissement='"+req.session.etablissement+"' and num_groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"';select * from  nb_inscriptions where id='"+req.session.id_etudiant+"';select * from  affectation_salles_examens where etablissement='"+req.session.etablissement+"' and abriviation='"+req.session.abriviation+"' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='evenement' order by id Desc Limit 1;select * from  evenements where etablissement='"+req.session.etablissement+"' and type='avis' order by id Desc Limit 1",[0,1,2,3,4,5,6,7,8,9,10,11,12,13], function(err, result) {
      if (err) throw err;
     
       res.render('etudiants/messageries_New.ejs', {
          
           etablissement:req.session.etablissement,
           pseudo:req.session.pseudo,
           
          
           etudiants:result[0],
           etudiants_G_notes:result[1],
           etudiants_G_avis:result[2],
           tds: result[3],
           cours: result[4],
           rattrapages: result[5],
           calendrierExamens: result[6],
           EmploiTemps: result[7],
           enseignants: result[8],
           declarations:result[9],
           infos_Etudiants:result[10],
           affectation_salles:result[11],
           evenements:result[12],
           avis:result[13],
         message: ''
   });
});
},

//Plannings Pour Etudiants
planning_Etudiant: (req, res) => {
   
      db.query("select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen' limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Emplois du temps' limit 1;select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes';select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='avis'", [0,1,2,3], function(err, result) {
        if (err) throw err;
   
       
         res.render('etudiants/planning_etudiant.ejs', {
          
            etudiants_examens: result[0],
            etudiants_emplois: result[1],
            etudiants_notes: result[2],
            etudiants_avis: result[3],
             etablissement:req.session.etablissement,
             pseudo:req.session.pseudo,
           message: ''
        });
 });
},


//Plannings Pour Enseignant_Etudiant
Enseignant_Etudiant: (req, res) => {
   
  db.query("select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='td';select * from  envois_enseignant_etudiant where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and nature_document='cours'", [0,1], function(err, result) {
    if (err) throw err;

   
     res.render('etudiants/Enseignant_Etudiant.ejs', {
      
        tds: result[0],
        cours: result[1],
      
         etablissement:req.session.etablissement,
         pseudo:req.session.pseudo,
       message: ''
    });
});
},

//Planning Etudiants
Groupe_Etudiant_notes: (req, res) => {
   
    
    //console.log("abriviation "+abriviation +" groupe "+groupe);

      let query="select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='notes'";
       
      db.query(query, (err, result) => {
         if (err) {
             res.redirect('/');
         }
       
         res.render('etudiants/Groupe_Etudiant_notes.ejs', {
            
             etablissement:req.session.etablissement,
             pseudo:req.session.pseudo,
            
             etudiants_G_notes:result,
           message: ''
     });
 });
},
  
//Planning Etudiants Avis
Groupe_Etudiant_avis: (req, res) => {
   
    
  //console.log("abriviation "+abriviation +" groupe "+groupe);

    let query="select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='avis'";
     
    db.query(query, (err, result) => {
      var nbres=result.length;
      console.log("nbr : "+nbres);
       if (err) {
           res.redirect('/');
       }
     
       res.render('etudiants/Groupe_Etudiant_avis.ejs', {
          
           etablissement:req.session.etablissement,
           pseudo:req.session.pseudo,
          
           etudiants_G_avis:result,
         message: ''
   });
});
},


//Planning Etudiants_Calendrier
planningEtudiant_Calendrier: (req, res) => {
   
    //let groupe=req.params.groupe;
    //console.log("abriviation "+abriviation +" groupe "+groupe);

      let query="select * from  envois where etablissement='"+req.session.etablissement+"' and groupe='"+req.session.groupe+"' and abriviation='"+req.session.abriviation+"' and type_document='Calendrier examen'";
       
      db.query("SELECT distinct (filiere)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"';SELECT distinct (specialite)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"';SELECT distinct (abriviation)FROM `filieres_specialite` where etablissement='"+req.session.etablissement+"'", [0, 1,2], function(err, result) {
        if (err) throw err;
       
         res.render('etudiants/planning_calendrier.ejs', {
            
             etablissement:req.session.etablissement,
             pseudo:req.session.pseudo,
            
             etudiants_calendrier:result,
           message: ''
     });
 });
},
Modifier_Photo_Etudiant: (req, res) => {
   
  let id=req.body.id_etudiant;
 
  let photos = req.files.photo_etudiants;
      
  let photo=photos.name;
  // upload the file to the /public/assets/img directory
  photos.mv(__dirname+`/../assets/photos_Etudiants/${photo}`, (err ) => {
 let sql="update `nb_inscriptions` set photo='"+photo+"' where `id`='"+id+"'";
  //Exécution de requete
  db.query(sql,(err,result) =>{
      if(err)
      {
          message='Erreur ajout';
          return message;
      }
   res.redirect('/ProfilEtudiant');
    });//Fin exécution requete
  });
 
},

//Modification Informations Personnel
   
Modifier_Infos_PersonnelEtudiant: (req, res) => {
   
  let id=req.body.id_etudiant;
  let nom=req.body.nom;
  let prenom=req.body.prenom;
  

 let sql="update `nb_inscriptions` set nom='"+nom+"',prenom='"+prenom+"' ,autorisation='demande' where `id`='"+id+"'";
  //Exécution de requete
  db.query(sql,(err,result) =>{
      if(err)
      {
          message='Erreur ajout';
          return message;
      }
      console.log(sql);
   res.redirect('/ProfilEtudiant');
    });//Fin exécution requete
 
},

//Supprimer etudiant

DeleteNumInscription: (req, res) => {
  let nomGroupe=req.params.nomGroupe;
  let filiere=req.params.filiere;
  let categorie=req.params.categorie;
  let specialite=req.params.specialite;
  let niveaux=req.params.niveaux;
  let abriviation=req.params.abriviation;
  let id=req.params.id;
   let query="delete  from nb_inscriptions where id='"+id+"'"; 
     
   db.query(query, (err, result) => {
      if (err) {
          res.redirect('/');
      }
     
      res.redirect('/getNumInscriptionRechGroupe/'+nomGroupe+'/'+filiere+'/'+categorie+'/'+niveaux+'/'+specialite+'/'+abriviation);
    });
},

}

