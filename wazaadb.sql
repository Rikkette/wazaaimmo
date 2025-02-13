drop database if exists wazaabd;
create database wazaabd;
use wazaabd;

CREATE TABLE waz_employes(
   id_employes VARCHAR(50),
   password_employes INT,
   email_employes VARCHAR(50),
   PRIMARY KEY(id_employes)
);

CREATE TABLE waz_client(
   id_client VARCHAR(50),
   password_client VARCHAR(50),
   email_client VARCHAR(50),
   PRIMARY KEY(id_client)
);

CREATE TABLE waz_annonces(
   an_id INT,
   an_offre VARCHAR(50),
   an_type VARCHAR(50),
   an_pieces INT,
   an_ref INT NOT NULL,
   an_titre VARCHAR(50),
   an_description TEXT,
   an_local VARCHAR(50),
   an_surf_hab TEXT,
   an_surf_tot INT,
   an_prix INT,
   lettre_diag_ VARCHAR(50),
   date_d_ajout DATE,
   date_modifiation DATE,
   PRIMARY KEY(an_id)
);

CREATE TABLE waz_photos(
   id_photos VARCHAR(50),
   photos_annonces VARCHAR(50),
   PRIMARY KEY(id_photos)
);

CREATE TABLE waz_options(
   opt_id VARCHAR(50),
   opt_libelle VARCHAR(50),
   PRIMARY KEY(opt_id)
);

CREATE TABLE waz_type_propositions(
   id_type_propo VARCHAR(50),
   PRIMARY KEY(id_type_propo)
);

CREATE TABLE was_user_type(
   id_user_type VARCHAR(50),
   user_id VARCHAR(50),
   PRIMARY KEY(id_user_type)
);

CREATE TABLE waz_active_inactive(
   id_an_active_inactive VARCHAR(50),
   an_active_inactive boolean,
   nombre_visite_annonce float,
   PRIMARY KEY(id_an_active_inactive)
);

CREATE TABLE créer(
   id_employes VARCHAR(50),
   an_id INT,
   PRIMARY KEY(id_employes, an_id),
   FOREIGN KEY(id_employes) REFERENCES waz_employes(id_employes),
   FOREIGN KEY(an_id) REFERENCES waz_annonces(an_id)
);

CREATE TABLE ajoute(
   id_employes VARCHAR(50),
   id_photos VARCHAR(50),
   PRIMARY KEY(id_employes, id_photos),
   FOREIGN KEY(id_employes) REFERENCES waz_employes(id_employes),
   FOREIGN KEY(id_photos) REFERENCES waz_photos(id_photos)
);

CREATE TABLE sont_vue(
   id_client VARCHAR(50),
   an_id INT,
   PRIMARY KEY(id_client, an_id),
   FOREIGN KEY(id_client) REFERENCES waz_client(id_client),
   FOREIGN KEY(an_id) REFERENCES waz_annonces(an_id)
);

CREATE TABLE relier(
   an_id INT,
   id_photos VARCHAR(50),
   PRIMARY KEY(an_id, id_photos),
   FOREIGN KEY(an_id) REFERENCES waz_annonces(an_id),
   FOREIGN KEY(id_photos) REFERENCES waz_photos(id_photos)
);

CREATE TABLE on_des(
   an_id INT,
   opt_id VARCHAR(50),
   PRIMARY KEY(an_id, opt_id),
   FOREIGN KEY(an_id) REFERENCES waz_annonces(an_id),
   FOREIGN KEY(opt_id) REFERENCES waz_options(opt_id)
);

CREATE TABLE s_applique(
   an_id INT,
   id_type_propo VARCHAR(50),
   PRIMARY KEY(an_id, id_type_propo),
   FOREIGN KEY(an_id) REFERENCES waz_annonces(an_id),
   FOREIGN KEY(id_type_propo) REFERENCES waz_type_propositions(id_type_propo)
);

CREATE TABLE different(
   id_client VARCHAR(50),
   id_user_type VARCHAR(50),
   PRIMARY KEY(id_client, id_user_type),
   FOREIGN KEY(id_client) REFERENCES waz_client(id_client),
   FOREIGN KEY(id_user_type) REFERENCES was_user_type(id_user_type)
);

CREATE TABLE peuvent_etre(
   an_id INT,
   id_an_active_inactive VARCHAR(50),
   PRIMARY KEY(an_id, id_an_active_inactive),
   FOREIGN KEY(an_id) REFERENCES waz_annonces(an_id),
   FOREIGN KEY(id_an_active_inactive) REFERENCES waz_active_inactive(id_an_active_inactive)
);
