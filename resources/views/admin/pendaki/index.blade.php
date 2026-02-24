@extends('admin.layout')

@section('page-title', 'Data Pendaki')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h5 style="margin: 0; color: #333; font-weight: 700;">
        <i class="bi bi-people"></i> Data Pendaki
    </h5>
</div>

<!-- Alert Container -->
<div id="alertContainer"></div>

<!-- Filter Section -->
<div class="card" style="margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <div class="card-body" style="padding: 20px;">
        <h6 style="margin-bottom: 15px; font-weight: 600;">
            <i class="bi bi-funnel"></i> Filter Data
        </h6>
        
        <div id="filterForm">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 15px; align-items: flex-end;">
                <div>
                    <label for="start_date" style="display: block; margin-bottom: 5px; font-weight: 500;">
                        Tanggal Naik Mulai
                    </label>
                    <input 
                        type="date" 
                        id="start_date" 
                        name="start_date" 
                        class="form-control"
                        style="border: 1px solid #ddd; border-radius: 4px; padding: 8px 12px; width: 100%;"
                    >
                </div>

                <div>
                    <label for="end_date" style="display: block; margin-bottom: 5px; font-weight: 500;">
                        Tanggal Naik Selesai
                    </label>
                    <input 
                        type="date" 
                        id="end_date" 
                        name="end_date" 
                        class="form-control"
                        style="border: 1px solid #ddd; border-radius: 4px; padding: 8px 12px; width: 100%;"
                    >
                </div>

                <div>
                    <label for="per_page" style="display: block; margin-bottom: 5px; font-weight: 500;">
                        Per Halaman
                    </label>
                    <select 
                        id="per_page" 
                        name="per_page" 
                        class="form-control"
                        style="border: 1px solid #ddd; border-radius: 4px; padding: 8px 12px; width: 100%;"
                    >
                        <option value="10">10</option>
                        <option value="15" selected>15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div>
                    <button type="button" id="btnFilter" class="btn btn-primary" style="width: 100%; padding: 8px 12px; border: none; border-radius: 4px; background-color: #007bff; color: white; cursor: pointer; font-weight: 500;">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Card -->
<div class="card" style="margin-bottom: 20px; border: 1px solid #e3f2fd; border-radius: 8px; background-color: #f0f7ff;">
    <div class="card-body" style="padding: 15px;">
        <p style="margin: 0; font-size: 14px;">
            <strong>Periode Tanggal Naik:</strong> 
            <span id="periodInfo">Loading...</span>
            <span style="float: right; font-weight: 600;">
                Total: <span id="totalCount" style="color: #007bff;">0</span> pendaki
            </span>
        </p>
    </div>
</div>

<!-- Loading Indicator -->
<div id="loadingIndicator" style="display: none; text-align: center; padding: 40px;">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
    <p style="margin-top: 15px; color: #666;">Memuat data...</p>
</div>

<!-- Data Table -->
<div class="table-container" id="tableContainer" style="display: none;">
    <div class="table-responsive">
        <table class="table table-hover" style="width: 100%;">
            <thead style="background-color: #f8f9fa; border-top: 1px solid #ddd; border-bottom: 2px solid #ddd;">
                <tr>
                    <th style="padding: 12px; text-align: left;">Nama</th>
                    <th style="padding: 12px; text-align: left;">NIK</th>
                    <th style="padding: 12px; text-align: left;">No HP</th>
                    <th style="padding: 12px; text-align: left;">Jenis Kelamin</th>
                    <th style="padding: 12px; text-align: left;">Tgl Naik</th>
                    <th style="padding: 12px; text-align: left;">Tgl Turun</th>
                    <th style="padding: 12px; text-align: left;">Jalur</th>
                    <th style="padding: 12px; text-align: center;">Status</th>
                    <th style="padding: 12px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Data will be loaded here via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div id="paginationContainer" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding: 10px 0;">
        <div id="paginationInfo" style="color: #666; font-size: 14px;"></div>
        <div id="paginationButtons"></div>
    </div>
</div>

<!-- Empty State -->
<div id="emptyState" style="display: none; text-align: center; padding: 60px 20px;">
    <i class="bi bi-inbox" style="font-size: 48px; color: #ccc; display: block; margin-bottom: 10px;"></i>
    <p style="color: #999; font-size: 16px;">
        Tidak ada data pendaki untuk periode yang dipilih
    </p>
</div>

<style>
.btn-view {
    display: inline-block;
    padding: 6px 12px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 12px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 5px;
}

.btn-view:hover {
    background-color: #0056b3;
    color: white;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

.btn-delete {
    display: inline-block;
    padding: 6px 12px;
    background-color: #dc3545;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 12px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    background-color: #c82333;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

.card {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.form-control {
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    outline: none;
}

.spinner-border {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    vertical-align: text-bottom;
    border: 0.25em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    animation: spinner-border 0.75s linear infinite;
}

@keyframes spinner-border {
    to { transform: rotate(360deg); }
}

.pagination-btn {
    padding: 8px 12px;
    margin: 0 2px;
    border: 1px solid #ddd;
    background-color: #fff;
    color: #333;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.pagination-btn:hover:not(:disabled) {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-btn.active {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

#tableBody tr {
    transition: background-color 0.2s ease;
}

#tableBody tr:hover {
    background-color: #f8f9fa;
}

.fade-in {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.badge-status {
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
}

.badge-aktif {
    background-color: #d4edda;
    color: #155724;
}

.badge-turun {
    background-color: #e2e3e5;
    color: #383d41;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const BASE_URL = "{{ route('admin.pendaki.filter') }}";
    const SHOW_URL = "{{ url('admin/pendaki') }}";
    const DELETE_URL = "{{ url('admin/pendaki') }}";
    const CSRF_TOKEN = "{{ csrf_token() }}";
    let currentPage = 1;
    
    // Initial load
    loadData();
    
    // Filter button click
    document.getElementById('btnFilter').addEventListener('click', function() {
        currentPage = 1;
        loadData();
    });
    
    // Auto-search when date inputs change
    ['start_date', 'end_date'].forEach(id => {
        const input = document.getElementById(id);
        
        input.addEventListener('change', function() {
            currentPage = 1;
            loadData();
        });
        
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                currentPage = 1;
                loadData();
            }
        });
    });
    
    // Per page change
    document.getElementById('per_page').addEventListener('change', function() {
        currentPage = 1;
        loadData();
    });
    
    function loadData(page = currentPage) {
        currentPage = page;
        
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const perPage = document.getElementById('per_page').value;
        
        // Show loading
        document.getElementById('loadingIndicator').style.display = 'block';
        document.getElementById('tableContainer').style.display = 'none';
        document.getElementById('emptyState').style.display = 'none';
        
        // Build URL with all parameters
        const params = new URLSearchParams();
        if (startDate) params.append('start_date', startDate);
        if (endDate) params.append('end_date', endDate);
        params.append('per_page', perPage);
        params.append('page', page);
        
        fetch(`${BASE_URL}?${params.toString()}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(result => {
            document.getElementById('loadingIndicator').style.display = 'none';
            
            if (result.success) {
                document.getElementById('periodInfo').textContent = 
                    `${result.period.start_date} - ${result.period.end_date}`;
                document.getElementById('totalCount').textContent = result.pagination.total;
                
                if (result.data.length > 0) {
                    renderTable(result.data);
                    renderPagination(result.pagination);
                    document.getElementById('tableContainer').style.display = 'block';
                    document.getElementById('tableContainer').classList.add('fade-in');
                } else {
                    document.getElementById('emptyState').style.display = 'block';
                }
            } else {
                showAlert('Gagal memuat data', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loadingIndicator').style.display = 'none';
            showAlert('Terjadi kesalahan saat memuat data', 'danger');
        });
    }
    
    function renderTable(data) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';
        
        data.forEach(item => {
            const row = document.createElement('tr');
            row.style.borderBottom = '1px solid #eee';
            
            // Penanganan warna merah jika terlambat (Overdue)
            if (item.is_overdue) {
                row.style.backgroundColor = '#fff5f5';
                row.style.color = '#dc3545';
            }
            
            let statusBadge = '<span class="badge-status badge-turun">-</span>';
            if (item.status_pendakian === 'selesai') {
                statusBadge = '<span class="badge-status badge-turun"><i class="bi bi-check-circle"></i> Selesai</span>';
            } else if (item.status_pendakian === 'aktif') {
                if (item.is_overdue) {
                    statusBadge = '<span class="badge-status" style="background-color:#dc3545; color:white;"><i class="bi bi-exclamation-triangle-fill"></i> Terlambat!</span>';
                } else {
                    statusBadge = '<span class="badge-status badge-aktif"><i class="bi bi-arrow-up"></i> Aktif</span>';
                }
            } else if (item.status_pendakian === 'batal') {
                statusBadge = '<span class="badge-status" style="background-color:#f8d7da;color:#721c24;"><i class="bi bi-x-circle"></i> Batal</span>';
            }
            
            row.innerHTML = `
                <td style="padding: 12px;">
                    <strong style="${item.is_overdue ? 'color:#dc3545;' : ''}">${item.nama}</strong>
                </td>
                <td style="padding: 12px;">${item.nik}</td>
                <td style="padding: 12px;">${item.no_hp}</td>
                <td style="padding: 12px;">${item.jenis_kelamin}</td>
                <td style="padding: 12px;">${item.tgl_naik}</td>
                <td style="padding: 12px; font-weight: ${item.is_overdue ? 'bold' : 'normal'}">${item.tgl_turun}</td>
                <td style="padding: 12px;">${item.jalur_pendakian}</td>
                <td style="padding: 12px; text-align: center;">${statusBadge}</td>
                <td style="padding: 12px; text-align: center;">
                    <a href="${SHOW_URL}/${item.id}" class="btn-view" style="${item.is_overdue ? 'background-color:#dc3545;' : ''}">
                        <i class="bi bi-eye"></i> Lihat
                    </a>
                    <button type="button" class="btn-delete" onclick="deletePendaki(${item.id})">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </td>
            `;
            
            tbody.appendChild(row);
        });
    }
    
    function renderPagination(pagination) {
        const info = document.getElementById('paginationInfo');
        const buttons = document.getElementById('paginationButtons');
        
        if (pagination.from && pagination.to) {
            info.textContent = `Menampilkan ${pagination.from} - ${pagination.to} dari ${pagination.total} data`;
        } else {
            info.textContent = '';
        }
        
        buttons.innerHTML = '';
        
        if (pagination.last_page > 1) {
            const prevBtn = document.createElement('button');
            prevBtn.className = 'pagination-btn';
            prevBtn.innerHTML = '&laquo; Prev';
            prevBtn.disabled = pagination.current_page === 1;
            prevBtn.onclick = () => loadData(pagination.current_page - 1);
            buttons.appendChild(prevBtn);
            
            const maxVisible = 5;
            let startPage = Math.max(1, pagination.current_page - Math.floor(maxVisible / 2));
            let endPage = Math.min(pagination.last_page, startPage + maxVisible - 1);
            
            if (endPage - startPage + 1 < maxVisible) {
                startPage = Math.max(1, endPage - maxVisible + 1);
            }
            
            if (startPage > 1) {
                const firstBtn = document.createElement('button');
                firstBtn.className = 'pagination-btn';
                firstBtn.textContent = '1';
                firstBtn.onclick = () => loadData(1);
                buttons.appendChild(firstBtn);
                
                if (startPage > 2) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.style.padding = '0 8px';
                    buttons.appendChild(dots);
                }
            }
            
            for (let i = startPage; i <= endPage; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = 'pagination-btn' + (i === pagination.current_page ? ' active' : '');
                pageBtn.textContent = i;
                pageBtn.onclick = () => loadData(i);
                buttons.appendChild(pageBtn);
            }
            
            if (endPage < pagination.last_page) {
                if (endPage < pagination.last_page - 1) {
                    const dots = document.createElement('span');
                    dots.textContent = '...';
                    dots.style.padding = '0 8px';
                    buttons.appendChild(dots);
                }
                
                const lastBtn = document.createElement('button');
                lastBtn.className = 'pagination-btn';
                lastBtn.textContent = pagination.last_page;
                lastBtn.onclick = () => loadData(pagination.last_page);
                buttons.appendChild(lastBtn);
            }
            
            const nextBtn = document.createElement('button');
            nextBtn.className = 'pagination-btn';
            nextBtn.innerHTML = 'Next &raquo;';
            nextBtn.disabled = pagination.current_page === pagination.last_page;
            nextBtn.onclick = () => loadData(pagination.current_page + 1);
            buttons.appendChild(nextBtn);
        }
    }
    
    function showAlert(message, type = 'success') {
        const container = document.getElementById('alertContainer');
        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.role = 'alert';
        alert.style.marginBottom = '20px';
        alert.innerHTML = `
            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        container.appendChild(alert);
        
        setTimeout(() => alert.remove(), 5000);
    }
    
    window.loadData = loadData;
    
    window.deletePendaki = function(id) {
        if (!confirm('Yakin hapus data pendaki ini?')) return;
        
        fetch(`${DELETE_URL}/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                loadData();
                showAlert('Data pendaki berhasil dihapus', 'success');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Gagal menghapus data', 'danger');
        });
    };
});
</script>

@endsection
