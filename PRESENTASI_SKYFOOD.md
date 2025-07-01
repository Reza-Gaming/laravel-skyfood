# Presentasi Aplikasi Skyfood – Sistem Pemesanan Makanan Online

---

## Slide 1: Judul & Identitas
**Aplikasi Skyfood – Sistem Pemesanan Makanan Online**  
Nama: [Nama Anda]  
NIM: [NIM Anda]  
Kelas: [Kelas Anda]

---

## Slide 2: Tema & Latar Belakang
**Tema:**  
Aplikasi pemesanan makanan online (Skyfood) dengan fitur multi-user (admin & user), CRUD menu, order, dan status pesanan.

**Latar Belakang:**
- Meningkatnya kebutuhan layanan pesan-antar makanan secara online.
- Memudahkan pelanggan memesan makanan tanpa harus datang ke restoran.
- Memberikan kemudahan bagi admin untuk mengelola menu, pesanan, dan pengguna.

---

## Slide 3: Penjelasan Singkat UML (Use Case & Class Diagram)
**Use Case Diagram:**
- User: Login, pesan makanan, lihat riwayat pesanan, review makanan.
- Admin: Login, kelola menu, kelola user, kelola pesanan, update status pesanan.

**Class Diagram (Singkat):**
- **User**: id, name, email, password, role
- **Food**: id, nama, harga, kategori, gambar
- **Order**: id, user_id, items, total_harga, status, payment_method
- **Review**: id, user_id, food_id, rating, komentar
- **Category**: id, nama

*Gambar diagram bisa ditampilkan di slide ini (gunakan draw.io atau gambar tangan)*

---

## Slide 4: Demo Aplikasi (Live)
**Demo Fitur:**
- Login sebagai user/admin
- User: pesan makanan, lihat keranjang, checkout, lihat riwayat pesanan, review makanan
- Admin: kelola menu (CRUD), kelola user, kelola pesanan (update status), dashboard statistik
- Tracking status pesanan (pending, cooking, delivering, finished)
- Tampilan tema "starry sky night" yang konsisten di semua halaman

**Link Demo:**  
[https://rezaskyfood.up.railway.app](https://rezaskyfood.up.railway.app)

---

## Slide 5: Penjelasan Kode Penting
**Controller:**
- `FoodController`: CRUD menu makanan, validasi input, upload gambar.
- `OrderController`: Proses order, update status, simulasi pembayaran.
- `AdminController`: Kelola user, dashboard admin.

**Model:**
- `Food`, `Order`, `User`, `Review`, `Category`: Relasi antar model, fillable, casting.

**View (Blade):**
- `resources/views/layouts/app.blade.php`: Layout utama, tema starry sky night.
- `resources/views/food/index.blade.php`: Daftar menu makanan.
- `resources/views/orders/show.blade.php`: Detail pesanan & tracking status.
- `resources/views/auth/login.blade.php`: Login dengan tema konsisten.

---

## Slide 6: Tantangan Selama Pembuatan
- **Deploy gratis tanpa kartu kredit:** Solusi dengan Railway.app.
- **Konfigurasi database SQLite di Docker/Railway:** Perlu penyesuaian path dan permission.
- **Menjaga konsistensi tema di semua halaman:** Penyesuaian CSS dan Blade.
- **Menghilangkan data sensitif dari repo:** Harus filter riwayat git.
- **Debug error 500 di hosting:** Perlu aktifkan debug dan cek log detail.

---

## Slide 7: Penutup & Tanya Jawab
- Aplikasi sudah memenuhi seluruh syarat teknis (MVC, CRUD, resource controller, online, dsb).
- Siap untuk demo live dan tanya jawab.

---

# Script Presentasi (Bisa Dibaca Saat Presentasi)

**Assalamualaikum wr. wb.**

Perkenalkan, nama saya [Nama Anda], NIM [NIM Anda], dari kelas [Kelas Anda].

Pada kesempatan ini saya akan mempresentasikan aplikasi tugas individu saya, yaitu **Skyfood – Sistem Pemesanan Makanan Online**.

---

## Tema & Latar Belakang
Tema aplikasi ini adalah layanan pemesanan makanan online, di mana user bisa memesan makanan, melihat riwayat pesanan, dan memberikan review. Admin dapat mengelola menu, user, dan pesanan. Latar belakangnya adalah kebutuhan masyarakat akan layanan pesan-antar makanan yang praktis dan efisien.

---

## Penjelasan UML
Secara singkat, use case diagram aplikasi ini terdiri dari dua aktor utama: user dan admin. User dapat login, memesan makanan, melihat riwayat, dan review. Admin dapat login, mengelola menu, user, dan pesanan. Class diagram terdiri dari model User, Food, Order, Review, dan Category yang saling berelasi.

---

## Demo Aplikasi
Selanjutnya, saya akan mendemokan aplikasi secara live di [https://rezaskyfood.up.railway.app](https://rezaskyfood.up.railway.app). Saya akan login sebagai user, melakukan pemesanan, melihat riwayat, dan review. Kemudian login sebagai admin untuk mengelola menu dan pesanan.

---

## Penjelasan Kode Penting
Kode penting pada aplikasi ini ada di Controller (misal: FoodController untuk CRUD makanan, OrderController untuk proses order), Model (relasi antar tabel), dan View (Blade) yang sudah menggunakan tema starry sky night.

---

## Tantangan
Tantangan utama adalah deploy gratis tanpa kartu kredit, konfigurasi database SQLite di Docker/Railway, menjaga konsistensi tema, menghilangkan data sensitif dari repo, dan debug error 500 di hosting. Semua tantangan ini berhasil diatasi.

---

## Penutup
Demikian presentasi dari saya. Aplikasi sudah memenuhi seluruh syarat teknis dan siap untuk demo live. Terima kasih, wassalamualaikum wr. wb. 