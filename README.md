

# MBG — Material & Kitchen Request Management System
## Naira Tahira (241511022)
## 2A - D3 Informatic Engineering

MBG (**Free Food from Gudang Management**) is a web-based application built using **CodeIgniter 4** to manage raw material inventories and kitchen requests in a catering or manufacturing environment.  
It helps coordinate between **Warehouse (Gudang)** and **Kitchen (Dapur)** users for efficient material flow, request approvals, and stock monitoring.

---

## Features

### 👩‍🍳 Dapur (Kitchen)
- Create new **Material Requests (Permintaan Bahan)** for cooking.
- Specify **menu**, **cooking date**, and **quantity (porsi)**.
- Select multiple raw materials and the required amount for each.
- View request status: **Menunggu**, **Disetujui**, or **Ditolak**.
- See detailed request history and reasons for rejection.

### 🏢 Gudang (Warehouse / Admin)
- Manage **Raw Material (Bahan Baku)** data:
  - Add, edit, and compute stock and expiration automatically.
  - Delete raw materials **only if expired** (`status = kadaluarsa`).
- Process **Kitchen Requests**:
  - Approve and automatically reduce material stock.
  - Reject with a reason (`alasan`) sent back to the client.
- Monitor **material expiration statuses**:
  - `tersedia` → available  
  - `segera_kadaluarsa` → expiring soon  
  - `kadaluarsa` → expired  
  - `habis` → out of stock  

---

## ⚙️ Tech Stack

| Component | Description |
|------------|-------------|
| **Framework** | CodeIgniter 4 (PHP 8.2) |
| **Database** | MySQL / MariaDB |
| **Frontend** | HTML5, Bootstrap 5, JavaScript |
| **Icons** | Bootstrap Icons |
| **Server** | Localhost (XAMPP) or Production (Apache/Nginx) |

---

## 🗄️ Database Structure

### 🧾 `user`
| Field | Description |
|-------|--------------|
| `id` | Primary key |
| `name` | User name |
| `username`, `password` | Credentials |
| `role` | `dapur` or `gudang` |

### 🧾 `bahan_baku`
| Field | Description |
|-------|--------------|
| `id` | Primary key |
| `nama`, `kategori`, `satuan` | Material details |
| `jumlah` | Current stock |
| `tanggal_masuk`, `tanggal_kadaluarsa` | Dates |
| `status` | Auto-computed (`tersedia`, `kadaluarsa`, etc.) |

### 🧾 `permintaan`
| Field | Description |
|-------|--------------|
| `id` | Primary key |
| `pemohon_id` | FK → `user.id` |
| `tgl_masak`, `menu_makan`, `jumlah_porsi` | Request info |
| `status` | `menunggu`, `disetujui`, or `ditolak` |
| `alasan` | Rejection reason |
| `created_at` | Timestamp |

### 🧾 `permintaan_detail`
| Field | Description |
|-------|--------------|
| `id` | Primary key |
| `permintaan_id` | FK → `permintaan.id` |
| `bahan_id` | FK → `bahan_baku.id` |
| `jumlah_diminta` | Requested quantity |

