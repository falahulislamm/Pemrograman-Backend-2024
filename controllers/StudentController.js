// TODO 3: Import data students dari folder data/students.js
const students = require('../data/student');

// Membuat Class StudentController
class StudentController {
  // Menampilkan data students
  index(req, res) {
    // TODO 4: Tampilkan data students
    const response = {
        message: "Menampilkan data student",
        data: students,
    }
    res.json(response);
  }

  // Menambahkan data students
  store(req, res) {
    // TODO 5: Tambahkan data students
    const { name } = req.body;
    if (!name) {
      return res.status(400).json({ message: 'Name is required' });
    }
    students.push(name);
    res.status(201).json({ message: `Menambahkan Data Student: ${name}`, students });
  }

  // Mengupdate data students
  update(req, res) {
  const { id } = req.params;
  const { name } = req.body;

  if (!name) {
    return res.status(400).json({ message: 'Name is required' });
  }

  if (id < 0 || id >= students.length) {
    return res.status(404).json({ message: 'Student not found' });
  }

  // Simpan nama lama untuk pesan
  const oldName = students[id];
  students[id] = name;

  res.json({
    message: `Mengedit student id ${id}, nama ${name}`,
    data: students,
  });
}


  // Menghapus data students
  destroy(req, res) {
    // TODO 7: Hapus data students
    const { id } = req.params;

    if (id < 0 || id >= students.length) {
      return res.status(404).json({ message: 'Student not found' });
    }

    students.splice(id, 1);
    res.json({
      message: `Menghapus student id ${id}`,
      data: students,
     });
  }
}

// Membuat object StudentController
const object = new StudentController();

// Export object StudentController
module.exports = object;
