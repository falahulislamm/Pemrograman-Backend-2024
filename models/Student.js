// import database
const db = require("../config/database");

// membuat class Model Student
class Student {
  /**
   * Membuat method static all.
   */
  static all() {
    return new Promise((resolve, reject) => {
        const query = "SELECT * from students";
        db.query(query, (err, results) => {
        resolve(results);
        });
    });
  }

  static create(data) {
    return new Promise((resolve, reject) => {
      const query =
        "INSERT INTO students (nama, nim, email, jurusan, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())";
      const { nama, nim, email, jurusan } = data;
  
      db.query(query, [nama, nim, email, jurusan], (err, results) => {
        if (err) {
          console.log(err); // Log error ke console
          reject(err);
        }
        resolve({
          id: results.insertId,
          nama,
          nim,
          email,
          jurusan,
        });
      });
    });
  }
  
}

// export class Student
module.exports = Student;