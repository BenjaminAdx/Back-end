var express = require('express');
var router = express.Router();
const db = require('../database');
const bcrypt = require('bcrypt');

router.get('/', function (req, res, next) {
    res.render('login', { message: '' });
});

router.post('/', function (req, res) {
    const { email, password } = req.body;
    db.query(`SELECT * FROM users WHERE email = ?`, [email], function (error, data) {
        if (data.length > 0) {
            bcrypt.compare(password, data[0].password, function (err, same) {
                if (err) throw (err);
                else if (same) {
                    req.session.loggedIn = true;
                    req.session.email = email;

                    res.redirect('/');
                }
                else {
                    res.render('login', { message: 'Mot de passe incorrect' })
                }
            })

        }
        else {
            res.render('login', { message: 'Aucun utilisateur avec cet email, veuillez vous inscrire' })
        }
    })
})

module.exports = router;