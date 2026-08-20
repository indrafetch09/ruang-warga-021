/**
 * Ruang Warga 021 - Combined Application Scripts
 * Consolidated JavaScript for Public Views & Admin Dashboard
 */

/* ==========================================================================
   1. DATA MAPPING (Lookup Tables & Static Content)
   ========================================================================== */

// Mapping Jabatan Pengurus berdasarkan Kategori Hirarki
const jabatanPengurusMapping = {
    penasehat: [ "Penasehat" ],
    ketua: [ "Ketua RW 021" ],
    sekretaris: [ "Sekretaris" ],
    bendahara: [ "Bendahara" ],
    seksi: [
        "Pembangunan & Infrastruktur",
        "Keamanan & Ketertiban",
        "Pemberdayaan Masyarakat",
        "Kepemudaan, Olah Raga & Seni",
        "Humas",
    ],
    tim_pendukung: [
        "Team Kebersihan",
        "Hansip",
        "Karang Taruna",
        "PKK",
        "Posyandu",
    ],
    ketua_rt: [
        "Ketua RT 001",
        "Ketua RT 002",
        "Ketua RT 003",
        "Ketua RT 004",
        "Ketua RT 005",
        "Ketua RT 006",
        "Ketua RT 007",
        "Ketua RT 008",
        "Ketua RT 009",
        "Ketua RT 010",
    ],
};

// Mapping Profesi Pekerjaan Sesuai Standar Dukcapil / KK
const pekerjaanMapping = {
    status_kondisi: [
        "Belum/Tidak Bekerja",
        "Mengurus Rumah Tangga",
        "Pelajar/Mahasiswa",
        "Pensiunan",
        "Pekerja Lepas (Freelance)",
    ],
    profesional: [
        "Karyawan Swasta",
        "Wiraswasta",
        "Pedagang",
        "Pengusaha",
        "Karyawan BUMN",
        "Karyawan BUMD",
        "Karyawan Honorer",
        "Konsultan",
        "Akuntan",
        "Pengacara",
        "Notaris",
        "Arsitek",
        "Desainer",
        "Pengembang Software / IT",
        "Penterjemah",
        "Pialang",
        "Manajer",
    ],
    aparatur: [
        "Pegawai Negeri Sipil (PNS)",
        "Tentara Nasional Indonesia (TNI)",
        "Kepolisian RI (POLRI)",
        "Perangkat Desa / Kelurahan",
        "Kepala Desa",
        "Anggota DPR-RI",
        "Anggota DPD",
        "Anggota BPK",
        "Presiden",
        "Wakil Presiden",
        "Anggota Mahkamah Konstitusi",
        "Anggota Kabinet / Kementerian",
        "Duta Besar / Kepala Perwakilan",
        "Gubernur",
        "Wakil Gubernur",
        "Bupati",
        "Wakil Bupati",
        "Walikota",
        "Wakil Walikota",
        "Anggota DPRD Propinsi",
        "Anggota DPRD Kabupaten / Kota",
    ],
    industri: [
        "Industri",
        "Konstruksi",
        "Karyawan Pabrik / Industri",
        "Buruh Harian Lepas",
        "Sopir / Pengemudi",
        "Mekanik / Teknisi",
        "Tukang Bangunan / Konstruksi",
        "Operator Mesin",
        "Pilot",
        "Pelaut",
        "Transportasi",
    ],
    pendidikan: [
        "Guru",
        "Dosen",
        "Peneliti",
        "Asisten Ahli",
        "Tutor / Instruktur",
    ],
    kesehatan: [
        "Dokter",
        "Perawat",
        "Bidan",
        "Apoteker",
        "Psikiater / Psikolog",
        "Tabib",
        "Tenaga Medis Lainnya",
    ],
    jasa_perorangan: [
        "Pembantu Rumah Tangga",
        "Tukang Cukur / Salon",
        "Tukang Listrik",
        "Tukang Batu",
        "Tukang Kayu",
        "Tukang Sol Sepatu",
        "Tukang Las / Pandai Besi",
        "Tukang Jahit",
        "Penata Rias",
        "Penata Busana",
        "Juru Masak / Chef",
        "Satpam / Keamanan",
    ],
    media_seni: [
        "Wartawan / Jurnalis",
        "Seniman / Artis",
        "Fotografer / Videografer",
        "Penulis",
        "Penyiar Televisi",
        "Penyiar Radio",
        "Promotor Acara",
    ],
    spiritual: [
        "Ustadz / Mubaligh",
        "Imam Masjid",
        "Pendeta",
        "Pastor",
        "Biarawati",
        "Pemuka Agama",
    ],
    pertanian: [
        "Petani / Pekebun",
        "Peternak",
        "Nelayan / Perikanan",
        "Buruh Tani / Perkebunan",
    ],
    olahraga: [ "Atlet", "Pelatih Olahraga" ],
    lainnya: [ "Lainnya" ],
};

// Data Modal Statis untuk Fasilitas & Layanan Lingkungan
const modalData = {
    "peminjaman-aula": {
        category: "Aula RW 021 & Fasilitas",
        title: "Peminjaman & Sewa Gedung Balai RW 021",
        headerBg: "bg-purple-700",
        description:
            "Prosedur izin penggunaan dan peminjaman fasilitas Aula RW 021 Bojong Nangka untuk syukuran keluarga, rapat organisasi, sosialisasi dinas, dan kegiatan warga.",
        subitems: [
            "Penggunaan untuk Acara Syukuran / Pernikahan Warga",
            "Rapat RT, Karang Taruna, & Keagamaan",
            "Kegiatan Sosialisasi Pemerintah & Puskesmas",
        ],
        requirements: [
            "Warga RW 021 / Penyewa Berizin Pengurus RT",
            "Mengisi Form Peminjaman Online di Halaman Ini",
            "Mematuhi Jam Operasional & Ketertiban Lingkungan",
        ],
        schedule: "Balai Warga RW 021 RT 05<br>Sesuai Pengajuan Jadwal Peminjaman",
        coordinator: "Galih Wirapati (Sekretaris RW - 087888872828)",
        wa: "https://wa.me/6287888872828",
    },
    "posyandu-info": {
        category: "Aula RW 021 & Fasilitas",
        title: "Layanan Posyandu Bunga Tanjung RW 021",
        headerBg: "bg-purple-700",
        description:
            "Pusat pelayanan kesehatan ibu, balita, dan lansia rutin bulanan yang diselenggarakan oleh kader Posyandu Bunga Tanjung RW 021.",
        subitems: [
            "Penimbangan & Pengukuran Tumbuh Tumbuh Balita",
            "Pemberian Makanan Tambahan (PMT) & Vitamin A",
            "Pemeriksaan Kesehatan Lansia & Cek Gula Darah/Tensi",
        ],
        requirements: [
            "Membawa Buku KIA (Kartu Menuju Sehat / KMS)",
            "Warga RW 021 RT 01 - RT 10",
        ],
        schedule:
            "Aula RW 021 Posyandu Bunga Tanjung<br>Setiap Minggu Ke-4 (Pukul 08.00 - 11.30 WIB)",
        coordinator: "Pengurus Kader Posyandu Bunga Tanjung",
        wa: "https://wa.me/6282299007700",
    },
    "badminton-info": {
        category: "Aula RW 021 & Fasilitas",
        title: "Jadwal Olahraga & Badminton Indoor",
        headerBg: "bg-purple-700",
        description:
            "Penggunaan lapangan bulu tangkis indoor Aula RW 021 bagi perkumpulan PB warga, latihan Karate anak, dan Senam Jasmani.",
        subitems: [
            "PB DABO (Senin & Rabu 19.30 WIB)",
            "PB SELSAB (Selasa & Sabtu 19.30 WIB)",
            "Karang Taruna RW 021 (Jumat 19.30 WIB)",
            "Senam Sehat Jasmani (Rabu & Sabtu 07.00 WIB)",
            "Latihan Karate (Minggu 15.30 WIB)",
        ],
        requirements: [
            "Wajib Menggunakan Sepatu Olahraga Indoor",
            "Menjaga Kebersihan & Mematikan Lampu Usai Pakai",
        ],
        schedule: "Aula RW 021 Dasana Indah<br>Sesuai Pembagian Jadwal Klub",
        coordinator: "Khusairi (Humas & Keamanan RW - 081511322022)",
        wa: "https://wa.me/6281511322022",
    },
};

/* ==========================================================================
   2. FORM SUBMISSION FUNCTIONS (WhatsApp Integration)
   ========================================================================== */

function submitContactForm(e) {
    e.preventDefault();
    const name = document.getElementById("contact_name")?.value.trim();
    const category = document.getElementById("contact_category")?.value;
    const message = document.getElementById("contact_message")?.value.trim();

    if (!name || !message) {
        alert("Mohon isi Nama Lengkap dan Pesan.");
        return;
    }

    const text = `Halo Pengurus RW 021,\n\nSaya ingin mengirimkan *${(category || "Pesan").toUpperCase()}*:\n\n👤 *Nama*: ${name}\n📌 *Kategori*: ${category || "-"}\n📝 *Pesan*: ${message}\n\nTerima kasih.`;
    const encoded = encodeURIComponent(text);
    window.open(`https://wa.me/6287888872828?text=${encoded}`, "_blank");
}

function submitBookingAula(e) {
    e.preventDefault();
    const nama = document.getElementById("book_nama")?.value.trim();
    const rt = document.getElementById("book_rt")?.value;
    const wa = document.getElementById("book_wa")?.value.trim();
    const tanggal = document.getElementById("book_tanggal")?.value;
    const waktu = document.getElementById("book_waktu")?.value.trim();
    const acara = document.getElementById("book_acara")?.value;
    const catatan = document.getElementById("book_catatan")?.value.trim();

    if (!nama || !wa || !tanggal || !waktu) {
        alert("Mohon lengkapi Nama, No. WhatsApp, Tanggal, dan Waktu Acara.");
        return;
    }

    const text = `Halo Pengurus RW 021 (Sekretaris Galih Wirapati),\n\nSaya ingin mengajukan *PEMINJAMAN AULA RW 021*:\n\n👤 *Nama Pemohon*: ${nama}\n🏡 *Asal Wilayah*: RT ${rt} RW 021\n📱 *No. WhatsApp*: ${wa}\n📅 *Tanggal Acara*: ${tanggal}\n⏰ *Jam/Waktu*: ${waktu}\n🎉 *Jenis Acara*: ${acara}\n📝 *Catatan Keperluan*: ${catatan || "-"}\n\nMohon informasi persetujuan & ketersediaan gedung Aula. Terima kasih.`;

    const encoded = encodeURIComponent(text);
    window.open(`https://wa.me/6287888872828?text=${encoded}`, "_blank");
}

/* ==========================================================================
   3. GLOBAL MODAL CONTROLLERS (Window Scope)
   ========================================================================== */

// --- A. Modal Galeri Foto (Instagram-style) ---
function openModal(imageSrc, title, date, description, categoryLabel) {
    const imgEl = document.getElementById("modalImage");
    const titleEl = document.getElementById("modalTitle");
    const dateEl = document.getElementById("modalDate");
    const descEl = document.getElementById("modalDescription");
    const catEl = document.getElementById("modalCategory");
    const modal = document.getElementById("postModal");

    if (imgEl) imgEl.src = imageSrc;
    if (titleEl) titleEl.innerText = title;
    if (dateEl) dateEl.innerText = date;
    if (descEl) descEl.innerText = description || "Tidak ada deskripsi tambahan.";
    if (catEl) catEl.innerText = categoryLabel || "Kegiatan";

    if (modal) {
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }
}

function closeModal() {
    const modal = document.getElementById("postModal");
    if (modal) {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto";
    }
}

// --- B. Modal Static Fasilitas ---
function openFacilityModal(key) {
    const data = modalData[ key ];
    if (!data) return;

    const catEl = document.getElementById("modal-category");
    const titleEl = document.getElementById("modal-title");
    const headerEl = document.getElementById("modal-header-bg");
    const descEl = document.getElementById("modal-description");
    const subitemsContainer = document.getElementById("modal-subitems");
    const reqContainer = document.getElementById("modal-requirements");
    const schedEl = document.getElementById("modal-schedule");
    const coordEl = document.getElementById("modal-coordinator");
    const waBtn = document.getElementById("modal-wa-btn");

    if (catEl) catEl.innerText = data.category;
    if (titleEl) titleEl.innerText = data.title;
    if (headerEl)
        headerEl.className = `px-6 py-5 ${data.headerBg} text-white flex justify-between items-center`;
    if (descEl) descEl.innerText = data.description;

    if (subitemsContainer) {
        subitemsContainer.innerHTML = "";
        data.subitems.forEach((item) => {
            const li = document.createElement("li");
            li.innerText = item;
            subitemsContainer.appendChild(li);
        });
    }

    if (reqContainer) {
        reqContainer.innerHTML = "";
        data.requirements.forEach((req) => {
            const li = document.createElement("li");
            li.innerHTML = `• ${req}`;
            reqContainer.appendChild(li);
        });
    }

    if (schedEl) schedEl.innerHTML = data.schedule;
    if (coordEl) coordEl.innerText = data.coordinator;
    if (waBtn) waBtn.href = data.wa;

    const modal = document.getElementById("detail-modal");
    if (modal) {
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }
}

function closeFacilityModal() {
    const modal = document.getElementById("detail-modal");
    if (modal) {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto";
    }
}

// --- C. Modal Dynamic Kegiatan Rutin ---
function openDynamicJadwalModal(data) {
    if (!data) return;

    const category = data.kategori ? data.kategori.toLowerCase() : "administrasi";
    const headerBgMap = {
        administrasi: "bg-purple-700",
        kebersihan: "bg-emerald-700",
        keamanan: "bg-amber-700",
        sosial: "bg-rose-700",
        keagamaan: "bg-blue-700",
    };

    const bgClass = headerBgMap[ category ] || "bg-purple-700";

    const catEl = document.getElementById("jmodal-category");
    const titleEl = document.getElementById("jmodal-title");
    const headerEl = document.getElementById("jmodal-header-bg");
    const descEl = document.getElementById("jmodal-description");
    const frekBox = document.getElementById("jmodal-frekuensi-box");
    const frekEl = document.getElementById("jmodal-frekuensi");
    const reqEl = document.getElementById("jmodal-requirements");
    const schedEl = document.getElementById("jmodal-schedule");
    const modal = document.getElementById("jadwal-modal");

    if (catEl) catEl.innerText = `Kategori: ${category.toUpperCase()}`;
    if (titleEl) titleEl.innerText = data.nama_kegiatan || "Detail Kegiatan";
    if (headerEl)
        headerEl.className = `px-6 py-5 ${bgClass} text-white flex justify-between items-center transition-colors`;
    if (descEl)
        descEl.innerText =
            data.deskripsi_singkat ||
            "Tidak ada catatan deskripsi tambahan untuk kegiatan ini.";

    if (frekBox && frekEl) {
        if (data.keterangan_frekuensi && data.keterangan_frekuensi.trim() !== "") {
            frekEl.innerText = data.keterangan_frekuensi;
            frekBox.classList.remove("hidden");
        } else {
            frekBox.classList.add("hidden");
        }
    }

    if (reqEl) {
        reqEl.innerText =
            data.persyaratan_ketentuan && data.persyaratan_ketentuan.trim() !== ""
                ? data.persyaratan_ketentuan
                : "Terbuka untuk seluruh warga RW 021. Berpakaian sopan dan rapi.";
    }

    if (schedEl) {
        const hariCap = data.hari
            ? data.hari.charAt(0).toUpperCase() + data.hari.slice(1)
            : "-";
        const waktuStr = data.waktu_pelaksanaan || "-";
        const lokasiStr = data.lokasi || "Wilayah RW 021";

        schedEl.innerHTML = `
            <strong>Hari:</strong> ${hariCap}<br>
            <strong>Waktu:</strong> ${waktuStr}<br>
            <strong>Lokasi:</strong> <span class="text-purple-700 font-bold">${lokasiStr}</span>
        `;
    }

    if (modal) {
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }
}

function closeJadwalModal() {
    const modal = document.getElementById("jadwal-modal");
    if (modal) {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto";
    }
}

// --- D. Modal Detail Penduduk (Admin) ---
function showDetailModal(data) {
    if (!data) return;

    const setElText = (id, val) => {
        const el = document.getElementById(id);
        if (el) el.innerText = val || "-";
    };

    setElText("m-nama", data.nama);
    setElText(
        "m-status-verifikasi",
        (data.status_verifikasi || "verified").toUpperCase(),
    );
    setElText("m-nik", data.nik_readable);
    setElText("m-nik-kk", data.nik_kk_readable);

    const statusMap = {
        kepala_keluarga: "Kepala Keluarga",
        istri: "Istri",
        anak: "Anak",
        orang_tua: "Orang Tua / Mertua",
        famili_lain: "Famili Lain / Lainnya",
    };
    const skKey = (data.status_keluarga || "famili_lain").toLowerCase();
    setElText("m-status-keluarga", statusMap[ skKey ] || "Famili Lain");

    const tempat = data.tempat_lahir || "";
    const tgl = data.tanggal_lahir || "";
    setElText("m-ttl", tempat || tgl ? `${tempat}, ${tgl}` : "-");

    const jkText =
        data.jenis_kelamin === "L"
            ? "Laki-laki"
            : data.jenis_kelamin === "P"
                ? "Perempuan"
                : "-";
    setElText("m-jk", jkText);

    setElText("m-alamat", `Blok ${data.blok || "-"} No. ${data.nomor || "-"}`);
    setElText("m-rt", `RT ${String(data.rt || 1).padStart(2, "0")}`);

    const agama = data.agama ? data.agama.toUpperCase() : "-";
    const pekerjaan = data.pekerjaan || "-";
    setElText("m-agama-pekerjaan", `${agama} / ${pekerjaan}`);

    const modal = document.getElementById("detailModal");
    if (modal) {
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }
}

function closeDetailModal() {
    const modal = document.getElementById("detailModal");
    if (modal) {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto";
    }
}

// --- E. Modal Import Excel/CSV Data Warga (DILETAKKAN DI GLOBAL SCOPE) ---
function openImportModal() {
    const modal = document.getElementById("importModal");
    if (modal) {
        modal.classList.remove("hidden");
        document.body.style.overflow = "hidden";
    }
}

function closeImportModal() {
    const modal = document.getElementById("importModal");
    if (modal) {
        modal.classList.add("hidden");
        document.body.style.overflow = "auto";
    }
}

/* ==========================================================================
   4. UI TAB SWITCHERS & REALTIME FILTERS
   ========================================================================== */

function toggleVisiMisi(tab) {
    const visiBtn = document.getElementById("tab-visi-btn");
    const misiBtn = document.getElementById("tab-misi-btn");
    const visiContent = document.getElementById("content-visi");
    const misiContent = document.getElementById("content-misi");

    if (!visiBtn || !misiBtn || !visiContent || !misiContent) return;

    if (tab === "visi") {
        visiBtn.className =
            "px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-purple-600 text-white border-t border-x border-purple-600";
        misiBtn.className =
            "px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-gray-100 text-gray-600 hover:bg-gray-200 border-t border-x border-gray-200";
        visiContent.classList.remove("hidden");
        misiContent.classList.add("hidden");
    } else {
        misiBtn.className =
            "px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-purple-600 text-white border-t border-x border-purple-600";
        visiBtn.className =
            "px-6 py-3 font-bold text-sm rounded-t-xl transition-all shadow-sm bg-gray-100 text-gray-600 hover:bg-gray-200 border-t border-x border-gray-200";
        misiContent.classList.remove("hidden");
        visiContent.classList.add("hidden");
    }
}

function switchTab(type) {
    const vBtn = document.getElementById("tab-verified-btn");
    const pBtn = document.getElementById("tab-pending-btn");
    const vContent = document.getElementById("tab-verified-content");
    const pContent = document.getElementById("tab-pending-content");

    if (!vBtn || !pBtn || !vContent || !pContent) return;

    if (type === "verified") {
        vBtn.className =
            "px-5 py-3 text-sm font-bold border-b-2 border-purple-600 text-purple-600 flex items-center gap-2 transition";
        pBtn.className =
            "px-5 py-3 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-purple-600 flex items-center gap-2 transition";
        vContent.classList.remove("hidden");
        pContent.classList.add("hidden");
    } else {
        pBtn.className =
            "px-5 py-3 text-sm font-bold border-b-2 border-purple-600 text-purple-600 flex items-center gap-2 transition";
        vBtn.className =
            "px-5 py-3 text-sm font-bold border-b-2 border-transparent text-gray-500 hover:text-purple-600 flex items-center gap-2 transition";
        pContent.classList.remove("hidden");
        vContent.classList.add("hidden");
    }

    filterWargaRealtime();
}

function filterWargaRealtime() {
    const searchInput = document.getElementById("searchInput");
    const rtSelect = document.getElementById("rtFilterSelect");

    if (!searchInput || !rtSelect) return;

    const query = searchInput.value.toLowerCase().trim();
    const selectedRt = rtSelect.value;

    const activeTabContent = document.querySelector(
        "#tab-verified-content:not(.hidden), #tab-pending-content:not(.hidden)",
    );
    if (!activeTabContent) return;

    const rows = activeTabContent.querySelectorAll("tbody tr.warga-row");
    let visibleCount = 0;

    rows.forEach((row) => {
        const text = row.textContent.toLowerCase();
        const rt = row.getAttribute("data-rt") || "";

        const matchesQuery = query === "" || text.includes(query);
        const matchesRt = selectedRt === "" || rt == selectedRt;

        if (matchesQuery && matchesRt) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    });

    const emptyState = activeTabContent.querySelector(
        "#emptyVerifiedState, #emptyPendingState",
    );
    if (emptyState) {
        if (visibleCount === 0 && rows.length > 0) {
            emptyState.classList.remove("hidden");
        } else {
            emptyState.classList.add("hidden");
        }
    }
}

function filterGaleriRealtime() {
    const searchInput = document.getElementById("searchGaleri");
    const katSelect = document.getElementById("filterKategoriGaleri");

    if (!searchInput || !katSelect) return;

    const query = searchInput.value.toLowerCase().trim();
    const kategori = katSelect.value.toLowerCase();

    const rows = document.querySelectorAll(".galeri-row");
    let visibleCount = 0;

    rows.forEach((row) => {
        const text = row.textContent.toLowerCase();
        const rowKat = row.getAttribute("data-kategori") || "";

        const matchesQuery = query === "" || text.includes(query);
        const matchesKat = kategori === "" || rowKat === kategori;

        if (matchesQuery && matchesKat) {
            row.style.display = "";
            visibleCount++;
        } else {
            row.style.display = "none";
        }
    });

    const emptyState = document.getElementById("emptyGaleriSearchState");
    if (emptyState) {
        if (visibleCount === 0 && rows.length > 0) {
            emptyState.classList.remove("hidden");
        } else {
            emptyState.classList.add("hidden");
        }
    }
}

/* ==========================================================================
   5. DYNAMIC DEPENDENT DROPDOWNS HELPERS
   ========================================================================== */

function populatePekerjaan(selectedCategory, defaultPekerjaan = "") {
    const selectPekerjaan = document.getElementById("selectPekerjaan");
    if (!selectPekerjaan) return;

    selectPekerjaan.innerHTML = "";
    const listOpsi = pekerjaanMapping[ selectedCategory ] || [];

    listOpsi.forEach((pekerjaan) => {
        const opt = document.createElement("option");
        opt.value = pekerjaan;
        opt.textContent = pekerjaan;
        if (pekerjaan.toLowerCase() === defaultPekerjaan.toLowerCase()) {
            opt.selected = true;
        }
        selectPekerjaan.appendChild(opt);
    });

    if (
        selectPekerjaan.selectedIndex === -1 &&
        selectPekerjaan.options.length > 0
    ) {
        selectPekerjaan.selectedIndex = 0;
    }
}

function findCategoryByPekerjaan(targetPekerjaan) {
    if (!targetPekerjaan) return "profesional";
    for (const [ category, list ] of Object.entries(pekerjaanMapping)) {
        if (
            list.some((item) => item.toLowerCase() === targetPekerjaan.toLowerCase())
        ) {
            return category;
        }
    }
    return "profesional";
}

function initDependentPekerjaan() {
    const katSelect = document.getElementById("selectKategoriPekerjaan");
    const pekSelect = document.getElementById("selectPekerjaan");
    if (!katSelect || !pekSelect) return;

    katSelect.onchange = function () {
        populatePekerjaan(this.value);
    };

    const targetPekerjaan = window.currentPekerjaan || "Karyawan Swasta";
    const detectedCategory = findCategoryByPekerjaan(targetPekerjaan);

    katSelect.value = detectedCategory;
    populatePekerjaan(detectedCategory, targetPekerjaan);
}

function populateJabatan(selectedCategory, defaultJabatan = "") {
    const selectJabatanPengurus = document.getElementById("selectJabatan");
    if (!selectJabatanPengurus) return;

    selectJabatanPengurus.innerHTML = "";
    const listOpsi = jabatanPengurusMapping[ selectedCategory ] || [];

    listOpsi.forEach((jabatan) => {
        const opt = document.createElement("option");
        opt.value = jabatan;
        opt.textContent = jabatan;
        if (jabatan === defaultJabatan) {
            opt.selected = true;
        }
        selectJabatanPengurus.appendChild(opt);
    });
}

/* ==========================================================================
   6. CHART.JS INITIALIZATION (Statistik Demografi)
   ========================================================================== */

function initDemographicCharts() {
    if (typeof Chart === "undefined") return;

    const barEl = document.getElementById("barChartRt");
    if (barEl) {
        const barLabels = window.chartBarLabels || [
            "RT 01",
            "RT 02",
            "RT 03",
            "RT 04",
            "RT 05",
            "RT 06",
            "RT 07",
            "RT 08",
            "RT 09",
            "RT 10",
        ];
        const barKk = window.chartBarKk || [ 32, 35, 28, 40, 38, 30, 36, 34, 39, 38 ];
        const barJiwa = window.chartBarJiwa || [
            112, 123, 98, 140, 133, 105, 126, 119, 137, 133,
        ];

        new Chart(barEl.getContext("2d"), {
            type: "bar",
            data: {
                labels: barLabels,
                datasets: [
                    {
                        label: "Jumlah KK",
                        data: barKk,
                        backgroundColor: "#9333ea",
                        borderRadius: 6,
                    },
                    {
                        label: "Estimasi Jiwa",
                        data: barJiwa,
                        backgroundColor: "#059669",
                        borderRadius: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "top",
                        labels: { font: { family: "Plus Jakarta Sans", weight: "bold" } },
                    },
                    tooltip: {
                        backgroundColor: "#1e1b4b",
                        titleFont: {
                            family: "Plus Jakarta Sans",
                            size: 13,
                            weight: "bold",
                        },
                        bodyFont: { family: "Plus Jakarta Sans", size: 12 },
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: "#f3f4f6" },
                        ticks: { font: { family: "Plus Jakarta Sans" } },
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "Plus Jakarta Sans", weight: "bold" } },
                    },
                },
            },
        });
    }

    const pieEl = document.getElementById("pieChartUsia");
    if (pieEl) {
        const usiaData = window.chartUsiaData || [ 215, 180, 680, 170 ];

        new Chart(pieEl.getContext("2d"), {
            type: "pie",
            data: {
                labels: [
                    "Anak (0-12 thn)",
                    "Remaja (13-18 thn)",
                    "Dewasa (19-59 thn)",
                    "Lansia (60+ thn)",
                ],
                datasets: [
                    {
                        data: usiaData,
                        backgroundColor: [ "#c084fc", "#38bdf8", "#7e22ce", "#f59e0b" ],
                        borderWidth: 2,
                        borderColor: "#ffffff",
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            font: { family: "Plus Jakarta Sans", weight: "600" },
                            padding: 15,
                        },
                    },
                    tooltip: {
                        backgroundColor: "#1e1b4b",
                        callbacks: {
                            label: function (context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const val = context.raw;
                                const pct = ((val / total) * 100).toFixed(1);
                                return ` ${context.label}: ${val} Jiwa (${pct}%)`;
                            },
                        },
                    },
                },
            },
        });
    }

    const genderEl = document.getElementById("pieChartGender");
    if (genderEl) {
        const genderData = window.chartGenderData || [ 635, 610 ];

        new Chart(genderEl.getContext("2d"), {
            type: "doughnut",
            data: {
                labels: [ "Laki-laki", "Perempuan" ],
                datasets: [
                    {
                        data: genderData,
                        backgroundColor: [ "#2563eb", "#ec4899" ],
                        borderWidth: 3,
                        borderColor: "#ffffff",
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            font: { family: "Plus Jakarta Sans", weight: "600" },
                            padding: 12,
                        },
                    },
                },
            },
        });
    }
}

/* ==========================================================================
   7. DOM CONTENT LOADED (Initialization & Unified Event Listeners)
   ========================================================================== */

document.addEventListener("DOMContentLoaded", function () {
    // 1. Tombol ESC Menutup Semua Modal
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeModal();
            closeFacilityModal();
            closeJadwalModal();
            closeDetailModal();
            closeImportModal();
        }
    });

    // 2. Klik Latar Belakang (Backdrop) Menutup Modal
    const registeredModals = [
        "postModal",
        "detail-modal",
        "jadwal-modal",
        "detailModal",
        "importModal",
    ];
    registeredModals.forEach((modalId) => {
        const modalEl = document.getElementById(modalId);
        if (modalEl) {
            modalEl.addEventListener("click", function (e) {
                if (e.target === this) {
                    if (modalId === "postModal") closeModal();
                    if (modalId === "detail-modal") closeFacilityModal();
                    if (modalId === "jadwal-modal") closeJadwalModal();
                    if (modalId === "detailModal") closeDetailModal();
                    if (modalId === "importModal") closeImportModal();
                }
            });
        }
    });

    // 3. Auto Open Facility Modal via URL Query Param
    const urlParams = new URLSearchParams(window.location.search);
    const detailKey = urlParams.get("detail");
    if (detailKey && modalData[ detailKey ]) {
        openFacilityModal(detailKey);
    }

    // 4. Inisialisasi Dependent Dropdown Pekerjaan
    initDependentPekerjaan();

    // 5. Inisialisasi Dynamic Dropdown Jabatan
    const selectKategoriPengurus = document.getElementById("selectKategori");
    if (selectKategoriPengurus) {
        selectKategoriPengurus.addEventListener("change", function () {
            populateJabatan(this.value);
        });

        const initialCategory = selectKategoriPengurus.value;
        const currentJabatan = window.currentJabatan || "";
        populateJabatan(initialCategory, currentJabatan);
    }

    // 6. Inisialisasi Grafik Demografi Chart.js
    initDemographicCharts();
});
