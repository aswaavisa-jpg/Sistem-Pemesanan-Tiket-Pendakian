@extends('admin.layout')

@section('page-title', 'Laporan Transaksi')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h5 style="margin: 0; color: #333; font-weight: 700;">
        <i class="bi bi-receipt"></i> Laporan Transaksi
    </h5>
</div>

<!-- Alert Container -->
<div id="alertContainer"></div>

<!-- Filter Section -->
<div class="card" style="margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px;">
    <div class="card-body" style="padding: 20px;">
        <h6 style="margin-bottom: 15px; font-weight: 600;">
            <i class="bi bi-funnel"></i> Filter Laporan
        </h6>
        
        <div id="filterForm">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 15px; align-items: flex-end;">
                <div>
                    <label for="start_date" style="display: block; margin-bottom: 5px; font-weight: 500;">
                        Tanggal Mulai
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
                        Tanggal Selesai
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
            <strong>Periode Laporan:</strong> 
            <span id="periodInfo">Loading...</span>
            <span style="float: right; font-weight: 600;">
                Total: <span id="totalCount" style="color: #007bff;">0</span> transaksi
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
                    <th style="padding: 12px; text-align: left;">Kode Transaksi</th>
                    <th style="padding: 12px; text-align: center;">Jumlah Pendaki</th>
                    <th style="padding: 12px; text-align: left;">Jalur Pendakian</th>
                    <th style="padding: 12px; text-align: left;">Tgl Naik</th>
                    <th style="padding: 12px; text-align: left;">Tgl Turun</th>
                    <th style="padding: 12px; text-align: left;">Dibuat</th>
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

<!-- Modal Detail Pendaki -->
<div id="detailModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 id="modalTitle" style="margin: 0;">Detail Transaksi</h5>
            <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div id="modalInfo" style="margin-bottom: 15px; padding: 10px; background-color: #f8f9fa; border-radius: 4px;">
                <p style="margin: 5px 0;"><strong>Kode:</strong> <span id="modalKode">-</span></p>
                <p style="margin: 5px 0;"><strong>Jalur:</strong> <span id="modalJalur">-</span></p>
                <p style="margin: 5px 0;"><strong>Tanggal:</strong> <span id="modalTanggal">-</span></p>
            </div>
            <h6 style="margin-bottom: 10px; font-weight: 600;">Daftar Pendaki:</h6>
            <div id="modalLoading" style="text-align: center; padding: 20px; display: none;">
                <div class="spinner-border text-primary" role="status" style="width: 2rem; height: 2rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm" style="width: 100%;" id="modalTable">
                    <thead style="background-color: #e9ecef;">
                        <tr>
                            <th style="padding: 8px;">No</th>
                            <th style="padding: 8px;">Nama</th>
                            <th style="padding: 8px;">NIK</th>
                            <th style="padding: 8px;">No HP</th>
                            <th style="padding: 8px;">Jenis Kelamin</th>
                            <th style="padding: 8px;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="modalTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.btn-view {
    transition: all 0.3s ease;
}

.btn-view:hover {
    background-color: #0056b3 !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

.btn-detail {
    display: inline-block;
    padding: 6px 12px;
    background-color: #17a2b8;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 12px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-detail:hover {
    background-color: #138496;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

.btn-print {
    display: inline-block;
    padding: 6px 12px;
    background-color: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 12px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-left: 5px;
}

.btn-print:hover {
    background-color: #218838;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
}

.btn-disabled {
    display: inline-block;
    padding: 6px 12px;
    background-color: #6c757d;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 12px;
    border: none;
    cursor: not-allowed;
    opacity: 0.6;
    margin-left: 5px;
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

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-content {
    background-color: white;
    border-radius: 8px;
    width: 90%;
    max-width: 800px;
    max-height: 80vh;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    background-color: #f8f9fa;
}

.modal-header h5 {
    font-weight: 600;
    color: #333;
}

.modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #666;
    transition: color 0.2s;
}

.modal-close:hover {
    color: #333;
}

.modal-body {
    padding: 20px;
    max-height: calc(80vh - 60px);
    overflow-y: auto;
}

.badge-status {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
}

.badge-aktif {
    background-color: #d4edda;
    color: #155724;
}

.badge-selesai {
    background-color: #cfe2ff;
    color: #084298;
}

.badge-default {
    background-color: #e2e3e5;
    color: #383d41;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const BASE_URL = "{{ route('admin.pendaki.reportFilter') }}";
    const DETAIL_URL = "{{ url('admin/pendaki/transaksi') }}";
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
        
        // On change (when date is selected)
        input.addEventListener('change', function() {
            currentPage = 1;
            loadData();
        });
        
        // On Enter key press
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
    
    // Close modal on overlay click
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
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
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(result => {
            // Hide loading
            document.getElementById('loadingIndicator').style.display = 'none';
            
            if (result.success) {
                // Update period info
                document.getElementById('periodInfo').textContent = 
                    `${result.period.start_date_formatted} - ${result.period.end_date_formatted}`;
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
            
            row.innerHTML = `
                <td style="padding: 12px;">
                    <strong style="color: #007bff;">${item.kode_transaksi}</strong>
                </td>
                <td style="padding: 12px; text-align: center;">
                    <span style="background-color: #e9ecef; padding: 4px 10px; border-radius: 12px; font-weight: 600;">
                        ${item.jumlah_pendaki} orang
                    </span>
                </td>
                <td style="padding: 12px;">${item.jalur_pendakian}</td>
                <td style="padding: 12px;">
                    ${item.is_past 
                        ? `<span style="color: #6c757d;"><strong>${item.tgl_naik}</strong> <small>(Lewat)</small></span>`
                        : `<span style="color: #28a745;"><strong>${item.tgl_naik}</strong></span>`
                    }
                </td>
                <td style="padding: 12px;">${item.tgl_turun}</td>
                <td style="padding: 12px; font-size: 12px; color: #666;">${item.created_at} WIB</td>
                <td style="padding: 12px; text-align: center;">
                    <button type="button" class="btn-detail" onclick="showDetail(${item.id})">
                        <i class="bi bi-eye"></i> Detail
                    </button>
                    ${item.penjualantiket_id && item.status_pembayaran === 'verified'
                        ? `<a href="/penjualantiket/${item.penjualantiket_id}/print" target="_blank" class="btn-print">
                            <i class="bi bi-printer"></i> Cetak
                           </a>`
                        : (item.penjualantiket_id 
                            ? `<span class="btn-disabled" title="Pembayaran belum diverifikasi">
                                <i class="bi bi-printer"></i> Cetak
                               </span>`
                            : '')
                    }
                </td>
            `;
            
            tbody.appendChild(row);
        });
    }
    
    function renderPagination(pagination) {
        const info = document.getElementById('paginationInfo');
        const buttons = document.getElementById('paginationButtons');
        
        // Info
        if (pagination.from && pagination.to) {
            info.textContent = `Menampilkan ${pagination.from} - ${pagination.to} dari ${pagination.total} data`;
        } else {
            info.textContent = '';
        }
        
        // Buttons
        buttons.innerHTML = '';
        
        if (pagination.last_page > 1) {
            // Previous button
            const prevBtn = document.createElement('button');
            prevBtn.className = 'pagination-btn';
            prevBtn.innerHTML = '&laquo; Prev';
            prevBtn.disabled = pagination.current_page === 1;
            prevBtn.onclick = () => loadData(pagination.current_page - 1);
            buttons.appendChild(prevBtn);
            
            // Page numbers
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
            
            // Next button
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
        
        // Auto remove after 5 seconds
        setTimeout(() => alert.remove(), 5000);
    }
    
    // Make functions available globally
    window.loadData = loadData;
    window.showDetail = function(id) {
        const modal = document.getElementById('detailModal');
        const modalLoading = document.getElementById('modalLoading');
        const modalTable = document.getElementById('modalTable');
        const modalTableBody = document.getElementById('modalTableBody');
        
        // Show modal and loading
        modal.style.display = 'flex';
        modalLoading.style.display = 'block';
        modalTable.style.display = 'none';
        
        // Fetch detail
        fetch(`${DETAIL_URL}/${id}/detail`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(result => {
            modalLoading.style.display = 'none';
            
            if (result.success) {
                // Update modal info
                document.getElementById('modalTitle').textContent = `Detail Transaksi ${result.kode_transaksi}`;
                document.getElementById('modalKode').textContent = result.kode_transaksi;
                document.getElementById('modalJalur').textContent = result.jalur_pendakian;
                document.getElementById('modalTanggal').textContent = `${result.tgl_naik} - ${result.tgl_turun}`;
                
                // Render pendaki list
                modalTableBody.innerHTML = '';
                result.pendaki.forEach((pendaki, index) => {
                    let statusBadge = `<span class="badge-status badge-default">${pendaki.status_pendakian}</span>`;
                    if (pendaki.status_pendakian === 'aktif') {
                        statusBadge = '<span class="badge-status badge-aktif">Aktif</span>';
                    } else if (pendaki.status_pendakian === 'selesai') {
                        statusBadge = '<span class="badge-status badge-selesai">Selesai</span>';
                    }
                    
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td style="padding: 8px;">${index + 1}</td>
                        <td style="padding: 8px;"><strong>${pendaki.nama}</strong></td>
                        <td style="padding: 8px;">${pendaki.nik}</td>
                        <td style="padding: 8px;">${pendaki.no_hp}</td>
                        <td style="padding: 8px;">${pendaki.jenis_kelamin}</td>
                        <td style="padding: 8px;">${statusBadge}</td>
                    `;
                    modalTableBody.appendChild(row);
                });
                
                modalTable.style.display = 'table';
            } else {
                showAlert('Gagal memuat detail transaksi', 'danger');
                closeModal();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            modalLoading.style.display = 'none';
            showAlert('Terjadi kesalahan saat memuat detail', 'danger');
            closeModal();
        });
    };
    
    window.closeModal = function() {
        document.getElementById('detailModal').style.display = 'none';
    };
});
</script>

@endsection
