# Inventaris RobuxRadit

Web yang saya buat adalah **Inventaris RobuxRadit**, yaitu aplikasi web sederhana untuk menampilkan dan mengelola data inventaris barang bertema Roblox. Website ini dibuat menggunakan **Laravel murni** dengan konsep **MVC (Model View Controller)** dan **Blade**.

Website ini memiliki tampilan khusus untuk admin. Admin dapat melakukan simulasi login, masuk ke dashboard, melihat profil pengguna, serta membuka halaman pengelolaan untuk melihat daftar inventaris barang. Data barang yang ditampilkan pada halaman pengelolaan berasal dari array di controller, kemudian dikirim ke view dan ditampilkan menggunakan perulangan Blade.

Fitur utama pada website ini antara lain:

- Login sederhana menggunakan username dan password demo.
- Dashboard untuk menampilkan ringkasan statistik inventaris.
- Profile untuk menampilkan informasi akun pengguna.
- Pengelolaan untuk menampilkan daftar barang inventaris.
- Navbar dan footer menggunakan Blade Component.
- Data username dikirim dari login ke halaman lain menggunakan request parameter.
- Data inventaris ditampilkan secara dinamis menggunakan `@foreach`.

Website ini tidak menggunakan database dan tidak menggunakan CRUD, karena data inventaris hanya disimulasikan menggunakan array di controller sesuai dengan ketentuan tugas.

Struktur Halaman
1. Login
<img width="1919" height="915" alt="login" src="https://github.com/user-attachments/assets/8a89f58e-7ad7-45c2-8370-55434b204dcd" />

Halaman login digunakan sebagai pintu masuk aplikasi. User memasukkan username dan password demo, kemudian data username akan dikirim ke dashboard melalui request parameter.

2. Dashboard
<img width="1919" height="919" alt="Dashboard1" src="https://github.com/user-attachments/assets/415ce6ef-0b70-4ad4-9828-97975ba3fadf" />

Dashboard menampilkan sapaan untuk user yang sedang login dan ringkasan statistik inventaris, seperti total jenis barang, total stok, total nilai inventaris, dan jumlah stok menipis. Pada halaman ini juga terdapat bagian aksi cepat untuk menuju halaman pengelolaan dan profil.

3. Pengelolaan
<img width="1919" height="928" alt="pengelolaan" src="https://github.com/user-attachments/assets/df93ea85-ffe2-4580-9a0f-b8809e033894" />

Halaman pengelolaan menampilkan data inventaris barang dalam bentuk tabel. Data barang berasal dari array di controller, lalu ditampilkan di view menggunakan @foreach. Informasi yang ditampilkan meliputi kode barang, nama barang, kategori, stok, harga, tanggal masuk, dan status stok.

4. Profile
<img width="1919" height="917" alt="profile" src="https://github.com/user-attachments/assets/0f789bed-e8b9-4c7e-a5d2-2cc2a4e44f8e" />

Halaman profile menampilkan informasi akun pengguna yang sedang login. Username pada halaman ini berasal dari request parameter yang diteruskan dari halaman login dan dashboard.
