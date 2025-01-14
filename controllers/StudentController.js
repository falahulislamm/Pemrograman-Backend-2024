const Student = require("../models/Student");

class StudentController {
    async index(req, res) {
      const students = await Student.all();
      const data = {
        message: "Menampilkan semua students",
        data: students,
      };
      res.json(data);
    }
  
    async store(req, res) {
      try {
        const studentData = req.body;
        const newStudent = await Student.create(studentData);
    
        const data = {
          message: "Menambahkan data student",
          data: newStudent,
        };
        res.json(data);
      } catch (error) {
        console.log(error); // Log error ke console
        res.status(500).json({ message: "Gagal menambahkan data student", error });
      }
    }    
  }
  
  const object = new StudentController();
  module.exports = object;