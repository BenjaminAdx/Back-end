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
  res.render('login', { message: '', title: 'Login' });
});

router.post('/', (req, res) => {
  const { email, password } = req.body;

  // Vérification si l'utilisateur existe
  connection.query('SELECT * FROM users WHERE email = ?', [email], (error, results) => {
    if (results.length === 0) {
      res.render('login', { message: 'Aucun utilisateur avec cette adresse mail', title: 'Login' });
    } else {
      // Vérification du mot de passe
      const match = bcrypt.compare(password, results[0].password,
        (err, result) => {
          if (err) throw err;

          if (result) {
            req.session.loggedIn = true;
            req.session.email = email;

            res.redirect('/');
          } else {
            res.render('login', { message: 'Mot de passe incorrect', title: 'Login' });
          }
        });
    }
  });
});

module.exports = router;