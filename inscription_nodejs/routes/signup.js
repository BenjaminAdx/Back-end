const bcrypt = require('bcrypt');
var express = require('express');
var router = express.Router();
const db = require('../database');

router.get('/', function (req, res, next) {
    res.render('signup', { message: '' });
});

router.post('/', function (req, res) {
    const { email, password } = req.body;
    db.query(`SELECT * FROM users WHERE email = ?`, [email], function (error, data) {
        if (data.length > 0) {
            res.render('signup', { message: 'Email déjà existant, veuillez vous connecter' });
        }
        else {
            bcrypt.hash(password, 10, function (err, hash) {
                if (err) throw (err);
                else {
                    db.query(`INSERT INTO users SET ?`, { email, password: hash }, function (err, results) {
                        if (err) throw (err)
                        else {
                            req.session.loggedIn = true;
                            req.session.email = email;

                            res.redirect('/');
                        }
                    })
                }
            })
        }
    })
});


module.exports = router;