var mysql = require('mysql');
var connection = mysql.createConnection({
    host: 'localhost',
    user: 'root', //
    password: 'root', //
    database: 'blog',
});
connection.connect((err) => {
    if (err) {
        console.log(err)
        return
    }
    console.log('Database test connected')
});
module.exports = connection;