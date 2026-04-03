import sys, re

with open(r'docs\03_SKEMA_DATABASE.md', 'r', encoding='utf-8') as f:
    lines = f.readlines()

new_lines = []
in_table = False
row_num = 1

for line in lines:
    stripped_line = line.strip()
    
    # Deteksi Header Tabel
    if stripped_line == '| Nama Atribut Kolom | Jenis Variabel | Keterangan |' or stripped_line == '| Nama Atribut Kolom | Jenis Variabel | Fungsionalitas Deskriptif |':
        new_lines.append('| No | Nama Field | Tipe Data | Keterangan |\n')
        in_table = True
        row_num = 1
        continue
        
    # Deteksi Separator Header
    if in_table and stripped_line.startswith('|---'):
        new_lines.append('|---|---|---|---|\n')
        continue
        
    # Deteksi Baris Data
    if in_table and stripped_line.startswith('|') and not stripped_line.startswith('|---'):
        parts = [p.strip() for p in stripped_line.split('|')][1:-1]
        
        # Harus ada setidaknya 3 kolom (Nama, Jenis, Keterangan)
        if len(parts) >= 3:
            # Karena bisa jadi ada simbol '|' di dalam teks (meskipun jarang di file ini)
            # Kita cukup ambil [0], [1], dan sisa untuk keterangan
            nama_field = parts[0]
            tipe_data = parts[1]
            keterangan = ' | '.join(parts[2:])
            
            # Format Tipe Data
            td_upper = tipe_data.upper()
            if 'INTEGER' in td_upper or 'BIGINT' in td_upper:
                td = 'INT(11)'
            elif 'VARCHAR' in td_upper:
                td = 'VARCHAR(255)'
            elif 'TEXT' in td_upper:
                td = 'TEXT'
            elif 'DATETIME' in td_upper:
                td = 'DATETIME'
            elif 'TIMESTAMP' in td_upper:
                td = 'TIMESTAMP'
            elif 'DATE' in td_upper:
                td = 'DATE'
            elif 'BOOLEAN' in td_upper:
                td = 'BOOLEAN'
            elif 'ENUM' in td_upper:
                td = 'ENUM'
            else:
                td = td_upper

            # Jika Nama Field adalah `id`, seteterangan menjadi Primary Key, Auto Increment
            if nama_field == '`id`':
                td = 'INT(11)'
                keterangan = 'Primary Key, Auto Increment'

            new_row = f'| {row_num} | {nama_field} | {td} | {keterangan} |\n'
            new_lines.append(new_row)
            row_num += 1
            continue

    # Kalau baris kosong atau tidak diawali '|', berarti keluar dari tabel
    if not stripped_line.startswith('|'):
        in_table = False
        
    new_lines.append(line)

with open(r'docs\03_SKEMA_DATABASE.md', 'w', encoding='utf-8') as f:
    f.writelines(new_lines)
print("Konversi tabel berhasil!")
