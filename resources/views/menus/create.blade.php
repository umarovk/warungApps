<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Tambah Menu - Warung Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .back-btn {
            position: absolute;
            left: 20px;
            top: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #4ecdc4;
        }

        .form-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            background: white;
            cursor: pointer;
        }

        .form-textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #4ecdc4;
        }

        .submit-btn {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
            color: white;
            border: none;
            padding: 15px 25px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(78, 205, 196, 0.4);
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .image-preview {
            width: 100%;
            height: 200px;
            border: 2px dashed #e1e5e9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
            background: #f8f9fa;
            color: #666;
            font-size: 14px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="header">
        <a
            href="{{ route('menus.index') }}"
            class="back-btn"
        >←</a>
        <h1>Tambah Menu</h1>
        <p>Tambahkan menu baru ke warung</p>
    </div>

    <div class="container">
        <div class="form-card">
            <form
                action="{{ route('menus.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="form-group">
                    <label
                        for="nama"
                        class="form-label"
                    >Nama Menu *</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-input"
                        value="{{ old('nama') }}"
                        required
                    >
                    @error('nama')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label
                        for="kategori"
                        class="form-label"
                    >Kategori *</label>
                    <select
                        id="kategori"
                        name="kategori"
                        class="form-select"
                        required
                    >
                        <option value="">Pilih kategori</option>
                        @foreach ($kategoriList as $value => $label)
                            <option
                                value="{{ $value }}"
                                {{ old('kategori') == $value ? 'selected' : '' }}
                            >
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label
                        for="harga"
                        class="form-label"
                    >Harga (Rp) *</label>
                    <input
                        type="number"
                        id="harga"
                        name="harga"
                        class="form-input"
                        value="{{ old('harga') }}"
                        min="0"
                        required
                    >
                    @error('harga')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label
                        for="deskripsi"
                        class="form-label"
                    >Deskripsi</label>
                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        class="form-textarea"
                        placeholder="Deskripsi menu..."
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label
                        for="gambar"
                        class="form-label"
                    >Foto Menu</label>
                    <input
                        type="file"
                        id="gambar"
                        name="gambar"
                        class="form-input"
                        accept="image/*"
                        style="padding: 8px;"
                    >
                    <div
                        class="image-preview"
                        id="imagePreview"
                    >
                        <span>Preview foto akan muncul di sini</span>
                    </div>
                    <small style="color: #666; font-size: 12px; margin-top: 5px;">
                        Format: JPG, PNG, GIF (Max: 2MB)
                    </small>
                    @error('gambar')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="submit-btn"
                >
                    Simpan Menu
                </button>
            </form>
        </div>
    </div>

    <script>
        // File upload preview functionality
        document.getElementById('gambar').addEventListener('change', function() {
            const preview = document.getElementById('imagePreview');
            const file = this.files[0];

            if (file) {
                // Check file size (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    this.value = '';
                    preview.innerHTML = '<span>Preview foto akan muncul di sini</span>';
                    return;
                }

                // Check file type
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar.');
                    this.value = '';
                    preview.innerHTML = '<span>Preview foto akan muncul di sini</span>';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 100%; max-height: 100%; border-radius: 8px;">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '<span>Preview foto akan muncul di sini</span>';
            }
        });
    </script>
</body>

</html>
