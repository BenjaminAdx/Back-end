var express = require('express');
var router = express.Router();
var db = require('../database');

router.get('/', function (req, res, next) {

    const loggedIn = req.session.loggedIn || false;
    const email = req.session.email || '';

    res.render('home', { loggedIn, email });

});

module.exports = router;