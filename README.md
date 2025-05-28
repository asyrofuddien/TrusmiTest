
## 🧮 **Soal 1 – SQL Query**

📄 File: [Query 1.txt](https://github.com/user-attachments/files/20492499/1.txt)

> Berisi perintah SQL untuk perhitungan dari table_kpi_marketing berdasarkan rule dan story di atas dengan output data seperti pada table berikut

---

## 📊 **Soal 2 – SQL Query**

📄 File: [Query 2.txt](https://github.com/user-attachments/files/20492500/2.txt)

> Berisi perintah SQL untuk  menghitung jumlah tasklist ontime dan late sertakan persentase ontime dan latenya

---

## 🖼️ **Soal 3 – tampilan dashboard berupa grafik dari hasil soal nomor 1**

![ERD Soal 3](https://github.com/user-attachments/assets/0e1cbea5-52fa-4e67-96c8-438d8e9e8ab7)

---

## 🧩 **Soal 4 – tampilan dashboard berupa grafik dari hasil soal nomor 2**

![ERD Soal 4](https://github.com/user-attachments/assets/0ca58876-976f-4c05-b5ff-c10aabac1010)

---

## 🧱 **Soal 5 – Normalisasi Database**

### 🧩 Struktur Awal (Unnormalized Form / 1NF)

```sql
CREATE TABLE table_kpi_marketing (
  id INT(11) NOT NULL,
  tasklist VARCHAR(100),
  kpi VARCHAR(100),
  karyawan VARCHAR(100),
  deadline DATE,
  aktual DATE
);
```

🔎 **Masalah:**

* Kolom `karyawan` berisi nama langsung → rawan duplikasi.
* `tasklist` dan `kpi` bisa jadi entitas terpisah dengan relasi khusus.

---

### ✅ Normalisasi ke 1NF

📌 **Sudah sesuai 1NF**, karena:

* Setiap kolom mengandung nilai atomik.
* Tidak ada array atau nested field.

---

### 🔁 Normalisasi ke 2NF

#### 🎯 Tujuan:

* Semua kolom non-primer bergantung sepenuhnya pada primary key (`id`).

### 🛠️ Langkah-langkah:

1. Identifikasi entitas utama: `karyawan`, `tasklist`, `kpi`.
2. Buat tabel terpisah untuk masing-masing entitas.

#### 💼 Tabel `karyawan`

```sql
CREATE TABLE karyawan (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama VARCHAR(100) NOT NULL
);
```

#### 🧾 Tabel `tasklist`

```sql
CREATE TABLE tasklist (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama_tasklist VARCHAR(100) NOT NULL
);
```

#### 📈 Tabel `kpi`

```sql
CREATE TABLE kpi (
  id INT PRIMARY KEY AUTO_INCREMENT,
  deskripsi VARCHAR(100) NOT NULL
);
```

#### 🔗 Tabel Relasi `kpi_marketing`

```sql
CREATE TABLE kpi_marketing (
  id INT PRIMARY KEY AUTO_INCREMENT,
  tasklist_id INT,
  kpi_id INT,
  karyawan_id INT,
  deadline DATE,
  aktual DATE,
  FOREIGN KEY (tasklist_id) REFERENCES tasklist(id),
  FOREIGN KEY (kpi_id) REFERENCES kpi(id),
  FOREIGN KEY (karyawan_id) REFERENCES karyawan(id)
);
```

---

### 📚 Normalisasi ke 3NF

✅ **Sudah memenuhi 3NF**, karena:

* Tidak ada *transitive dependency*.
* Semua atribut non-primer hanya bergantung pada primary key masing-masing.
---


Soal 1
[Query 1.txt](https://github.com/user-attachments/files/20492500/2.txt)

Soal 2
[Query 2.txt](https://github.com/user-attachments/files/20492499/1.txt)

Soal 3
![image](https://github.com/user-attachments/assets/0e1cbea5-52fa-4e67-96c8-438d8e9e8ab7)

Soal 4
![image](https://github.com/user-attachments/assets/0ca58876-976f-4c05-b5ff-c10aabac1010)

Soal 5
---

### 🧩 **Struktur Awal (Unnormalized Form / 1NF):**

```sql
CREATE TABLE table_kpi_marketing (
  id INT(11) NOT NULL,
  tasklist VARCHAR(100),
  kpi VARCHAR(100),
  karyawan VARCHAR(100),
  deadline DATE,
  aktual DATE
);
```

Masalah:

* Field `karyawan` menyimpan nama langsung, bisa terjadi pengulangan data jika ada banyak KPI untuk karyawan yang sama.
* `tasklist` dan `kpi` bisa memiliki keterkaitan struktural atau kategorisasi sendiri.

---

## 🔁 **Normalisasi ke 1NF (First Normal Form)**

Sudah sesuai 1NF karena:

* Setiap kolom mengandung nilai atomik (satu nilai per kolom).
* Tidak ada array atau nested values.

---

## 🧱 **Normalisasi ke 2NF (Second Normal Form)**

Syarat:

* Harus sudah 1NF.
* Semua kolom non-primer harus bergantung sepenuhnya pada **seluruh primary key**.

Langkah:

1. Identifikasi **primary key**: `id` (asumsi ini unik untuk setiap baris).
2. Pisahkan entitas: `karyawan`, `tasklist`, `kpi`.

### Rekomendasi Desain 2NF:

#### 1. **Tabel `karyawan`**

```sql
CREATE TABLE karyawan (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama VARCHAR(100) NOT NULL
);
```

#### 2. **Tabel `tasklist`**

```sql
CREATE TABLE tasklist (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama_tasklist VARCHAR(100) NOT NULL
);
```

#### 3. **Tabel `kpi`**

```sql
CREATE TABLE kpi (
  id INT PRIMARY KEY AUTO_INCREMENT,
  deskripsi VARCHAR(100) NOT NULL
);
```

#### 4. **Tabel `kpi_marketing` (relasi utama)**

```sql
CREATE TABLE kpi_marketing (
  id INT PRIMARY KEY AUTO_INCREMENT,
  tasklist_id INT,
  kpi_id INT,
  karyawan_id INT,
  deadline DATE,
  aktual DATE,
  FOREIGN KEY (tasklist_id) REFERENCES tasklist(id),
  FOREIGN KEY (kpi_id) REFERENCES kpi(id),
  FOREIGN KEY (karyawan_id) REFERENCES karyawan(id)
);
```

---

## 🧹 **Normalisasi ke 3NF (Third Normal Form)**

Syarat:

* Harus sudah 2NF.
* Tidak boleh ada **transitive dependency** (kolom non-primer tidak boleh bergantung ke kolom non-primer lainnya).

Dengan desain di atas, sudah memenuhi 3NF, karena:

* Semua kolom non-key hanya bergantung ke **primary key langsung** (tidak melalui kolom non-key lain).
* Setiap entitas utama (karyawan, tasklist, kpi) memiliki tabel terpisah.

---
