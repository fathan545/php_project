function navigate(button, url) {
  const buttons = document.querySelectorAll(".menu-button");
  buttons.forEach((btn) => btn.classList.remove("active"));
  button.classList.add("active");
  window.location.href = url;
}

function goBack() {
  window.history.back();
}

function handleLogin() {
  const username = document.getElementById("username").value.trim();
  const password = document.getElementById("password").value.trim();

  if (username === "admin" && password === "admin") {
    alert("Login berhasil!");
    sessionStorage.setItem("isLoggedIn", "true");
    window.location.href = "beranda-admin.html";
  } else {
    alert("Username atau password salah!");
  }
}

document.getElementById("logoutBtn").addEventListener("click", function () {
  alert("Anda telah logout.");
  window.location.href = "login.html";
});

function handleLogout() {
  // Bersihkan status login
  sessionStorage.removeItem("isLoggedIn");

  // Redirect ke login tanpa simpan riwayat
  location.replace("login.html");
}

function editGambar(id) {
  const img = document.getElementById(id);
  const newSrc = prompt("Masukkan URL gambar baru:", img.src);
  if (newSrc) {
    img.src = newSrc;
    localStorage.setItem(id, newSrc);
  }
}

function editTeksBerita() {
  const judul = document.getElementById("beritaJudul");
  const teks = document.getElementById("beritaTeks");

  const newJudul = prompt("Edit judul berita:", judul.textContent);
  const newTeks = prompt("Edit isi berita:", teks.textContent);

  if (newJudul) {
    judul.textContent = newJudul;
    localStorage.setItem("beritaJudul", newJudul);
  }

  if (newTeks) {
    teks.textContent = newTeks;
    localStorage.setItem("beritaTeks", newTeks);
  }
}

function editTeks() {
  const currentText = document.getElementById("beritaTeks").innerText;
  const newText = prompt("Masukkan teks berita baru:", currentText);
  if (newText) {
    document.getElementById("beritaTeks").innerHTML = `<p>${newText}</p>`;
  }
}

function editJadwal(hari) {
  const id = "jadwal-" + hari;
  const current = document.getElementById(id).innerText;
  const newText = prompt(
    "Masukkan jadwal baru untuk " +
      hari.charAt(0).toUpperCase() +
      hari.slice(1) +
      ":",
    current
  );
  if (newText !== null && newText.trim() !== "") {
    document.getElementById(id).innerText = newText;
  }
}

function editGuru(id) {
  const img = document.getElementById(id);
  const newSrc = prompt("Masukkan URL gambar baru:", img.src);
  if (newSrc) {
    img.src = newSrc;
    localStorage.setItem(id, newSrc);
  }
}

function editTataTertib() {
  const currentText = document.getElementById("tatatertibTeks").innerText;
  const newText = prompt("Masukkan tata tertib yang baru:", currentText);
  if (newText) {
    document.getElementById("tatatertibTeks").innerHTML = `<p>${newText}</p`;
  }
}

function editJadwal(hari) {
  const id = "jadwal-" + hari;
  const current = document.getElementById(id).innerText;
  const newText = prompt(
    "Masukkan jadwal baru untuk " +
      hari.charAt(0).toUpperCase() +
      hari.slice(1) +
      ":",
    current
  );
  if (newText !== null && newText.trim() !== "") {
    document.getElementById(id).innerText = newText;
  }
}

// Cek apakah user sudah login
if (sessionStorage.getItem("loggedIn") !== "true") {
  // Jika belum login, redirect ke halaman login
  window.location.href = "login.html";
}

function logout() {
  sessionStorage.removeItem("loggedIn"); // hapus sesi
  window.location.href = "login.html";
}

// Cegah akses kembali dengan tombol back
window.addEventListener("pageshow", function (event) {
  if (
    event.persisted ||
    (window.performance && window.performance.navigation.type === 2)
  ) {
    // reload halaman jika user tekan back setelah logout
    window.location.reload();
  }
});

function login() {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  if (username === "admin" && password === "admin") {
    // Simpan status login ke sessionStorage
    sessionStorage.setItem("loggedIn", "true");
    window.location.href = "beranda-admin.html"; // redirect ke dashboard
  } else {
    alert("Username atau password salah!");
  }
}

if (sessionStorage.getItem("loggedIn") === "true") {
  window.location.href = "beranda-admin.html";
}

if (sessionStorage.getItem("loggedIn") !== "true") {
  window.location.href = "login.html";
}
