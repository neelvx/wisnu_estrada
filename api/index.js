const express = require("express");
const app = express();
const port = 3000;
const parser = require("body-parser");
const database = require("./connection");
const response = require("./response");

app.use(parser.json());

app.get("/", (req, res) => {
  database.query("SELECT * FROM m_karyawan", (error, results) => {
    response(200, results, "Data karyawan berhasil diambil", res);
  });
});

app.get("/edit", (req, res) => {
  database.query(
    `SELECT * FROM m_karyawan WHERE nik=${req.query.nik}`,
    (error, results) => {
      response(200, results, "Data karyawan berhasil diambil", res);
    }
  );
});

app.post("/", (req, res) => {
  const { nik, nama, alamat, tgl_lahir, divisi, status, created_date } =
    req.body;

  //   res.send(req.body);
  const karyawan = `INSERT INTO m_karyawan (nik, nama, alamat, tgl_lahir, divisi, status, created_date) VALUES (${nik}, '${nama}', '${alamat}', '${tgl_lahir}', '${divisi}', '${status}', '${created_date}')`;
  database.query(karyawan, (err, fields) => {
    if (err) response(500, "Invalid", err.sqlMessage, res);
    if (fields?.affectedRows) {
      response(200, fields, "Data karyawan berhasil ditambahkan", res);
    }
  });
});

app.post("/update", (req, res) => {
  const { nik, nama, alamat, tgl_lahir, divisi, status } = req.body;

  const karyawan = `UPDATE m_karyawan SET nama = '${nama}', alamat = '${alamat}', tgl_lahir = '${tgl_lahir}', divisi = '${divisi}', status = '${status}' WHERE nik = ${nik}`;
  database.query(karyawan, (err, fields) => {
    if (err) response(500, "Invalid", err.sqlMessage, res);
    if (fields?.affectedRows) {
      response(200, fields, "Data karyawan berhasil diubah", res);
    }
  });
});

app.post("/delete", (req, res) => {
  const { nik } = req.body;
  const karyawan = `DELETE FROM m_karyawan WHERE nik = ${nik}`;
  database.query(karyawan, (err, fields) => {
    if (err) response(500, "Invalid", err.sqlMessage, res);
    if (fields?.affectedRows) {
      response(200, fields, "Data karyawan berhasil dihapus", res);
    }
  });
});

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`);
});
