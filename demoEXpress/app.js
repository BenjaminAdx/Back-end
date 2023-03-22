const express = require('express');
const session = require('express-session');
const bcrypt = require('bcrypt');
const mysql = require('mysql');
const path = require('path');

const app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: false }));

app.use(session({
  secret: 'mySecretKey',
  resave: false,
  saveUninitialized: true
}));


const signupRouter = require('./routes/signup');
const loginRouter = require('./routes/login');
const homeRouter = require('./routes/home');
const logoutRouter = require('./routes/logout');

app.use('/signup', signupRouter);
app.use('/login', loginRouter);
app.use('/', homeRouter);
app.use('/logout', logoutRouter);


app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

app.listen(3000, () => {
  console.log('Server started on port 3000');
});
