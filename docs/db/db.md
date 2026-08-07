---
config:
  theme: mc
---
flowchart TD
    %% Main Entry Point
    A([Halaman Utama / Login]) --> B{Autentikasi & Role}
    
    %% User Branch
    B -->|"Role: USER"| C[Beranda]
    
    %% User Features - Main Navigation
    C --> D[Tentang Kami]
    C --> E[Profil]
    C --> F[Struktur RW]
    C --> G[Pengurus RT]
    C --> H[Layanan]
    C --> I[Informasi]
    C --> J[Statistik]
    C --> K[Maps]
    C --> L[Hubungi Kami]
    
    %% Layanan Sub-features
    H --> H1[Administrasi Kependudukan]
    H --> H2[Kebersihan Lingkungan]
    
    H1 --> H1a[Pengajuan Surat]
    H1 --> H1b[Cek Status Dokumen]
    H1 --> H1c[Download Formulir]
    
    H2 --> H2a[Jadwal Gotong Royong]
    H2 --> H2b[Bank Sampah]
    H2 --> H2c[Laporan Kebersihan]
    
    %% Informasi Details
    I --> I1[Pengumuman]
    I --> I2[Agenda Kegiatan]
    I --> I3[Berita Warga]
    I --> I4[Galeri Foto]
    
    %% Statistik Details
    J --> J1[Demografi Warga]
    J --> J2[Data KK]
    J --> J3[Grafik Pertumbuhan]
    
    %% Maps Details
    K --> K1[Peta Wilayah RW]
    K --> K2[Lokasi Fasilitas Umum]
    K --> K3[Denah Rumah Warga]
    
    %% Hubungi Kami Details
    L --> L1[Form Kontak]
    L --> L2[WhatsApp Pengurus]
    L --> L3[Lokasi Kantor RW]
    
    %% Admin Branch
    B -->|"Role: ADMIN"| M[Dashboard Admin]
    
    %% Admin Features
    M --> N[Ringkasan Data]
    M --> O[Data Warga]
    M --> P[Data User]
    M --> Q[Pengaturan]
    
    %% Dashboard Sub-features
    N --> N1[Total Warga]
    N --> N2[Total KK]
    N --> N3[Grafik Aktivitas]
    N --> N4[Notifikasi Terbaru]
    
    %% Data Warga CRUD
    O --> O1[Lihat Semua Warga]
    O --> O2[Tambah Warga]
    O --> O3[Edit Data Warga]
    O --> O4[Hapus Warga]
    O --> O5[Filter by RT]
    O --> O6[Export Data]
    
    %% Data User Management
    P --> P1[Lihat User]
    P --> P2[Tambah User]
    P --> P3[Edit Role User]
    P --> P4[Reset Password]
    P --> P5[Aktif/Nonaktif User]
    
    %% Pengaturan Details
    Q --> Q1[Profil RW]
    Q --> Q2[Logo & Identitas]
    Q --> Q3[Kata Sandi Admin]
    Q --> Q4[Backup Database]
    Q --> Q5[Pengaturan Umum]
    
    %% Cross-feature Relationships
    O -.->|"Data muncul di"| J1
    O -.->|"Data muncul di"| J2
    
    M -.->|"Notifikasi ke"| I1
    
    H1a -.->|"Butuh data dari"| O
    
    %% Styling
    classDef userNode fill:#e3f0ff,stroke:#1e4a6b,stroke-width:2px,color:#0a2a44
    classDef adminNode fill:#fff3e0,stroke:#e67e22,stroke-width:2px,color:#5d3a1a
    classDef featureNode fill:#f0f4ff,stroke:#4a7ab5,stroke-width:1px
    classDef startNode fill:#d4edda,stroke:#28a745,stroke-width:3px,color:#155724
    classDef authNode fill:#fff3cd,stroke:#ffc107,stroke-width:3px,color:#856404
    
    class C,D,E,F,G,H,I,J,K,L,H1,H2 userNode
    class M,N,O,P,Q adminNode
    class H1a,H1b,H1c,H2a,H2b,H2c,I1,I2,I3,I4,J1,J2,J3,K1,K2,K3,L1,L2,L3,N1,N2,N3,N4,O1,O2,O3,O4,O5,O6,P1,P2,P3,P4,P5,Q1,Q2,Q3,Q4,Q5 featureNode
    class A startNode
    class B authNode
