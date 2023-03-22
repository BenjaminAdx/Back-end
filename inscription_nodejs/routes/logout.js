var express = require('express');
var router = express.Router();
var db = require('../database');

router.get('/', function (req, res) {
    req.session.destroy(function (err, result) {
        if (err) throw (err);
        else {
            res.redirect('/');
        }
    })
});

module.exports = router;