const express = require('express');
const router = express.Router();

router.get('/', (req, res) => {
    const loggedIn = req.session.loggedIn || false;
    const email = req.session.email || '';
    var title = 'Bienvenue';
    res.render('home', { loggedIn, email, title });
});

module.exports = router;
