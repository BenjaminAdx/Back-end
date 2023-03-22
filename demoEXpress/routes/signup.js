const express = require('express');
const router = express.Router();
const bcrypt = require('bcrypt');
const mysql = require('mysql');

const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: 'root',
  database: 'userConnect'
});

router.get('/', (req, res) => {
  res.render('signup', { message: '', title: 'Bienvenue' });
});

router.post('/', (req, res) => {
  const { email, password } = req.body;

  // Vérification si l'utilisateur existe déjà
  connection.query('SELECT * FROM users WHERE email = ?', [email], (error, results) => {
    if (results.length > 0) {
      res.render('signup', { message: 'Un utilisateur avec cette adresse mail existe déjà', title: 'Bienvenue' });
    } else {
      // Hashage du mot de passe
      bcrypt.hash(password, 10, (err, hash) => {
        if (err) throw err;

        // Insertion de l'utilisateur dans la base de données
        connection.query('INSERT INTO users SET ?', { email, password: hash }, (error, results) => {
          if (error) throw error;

          req.session.loggedIn = true;
          req.session.email = email;

          res.redirect('/');
        });
      });
    }
  });
});

module.exports = router;
