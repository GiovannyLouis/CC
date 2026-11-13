@extends('layouts.app')

@section('title', 'Face Blur Editor')

@push('styles')
<style>
    .card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 1.5rem;
    }

    .dropzone {
        border: 2px dashed #475569;
        border-radius: 12px;
        padding: 3rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s, background-color 0.2s;
    }

    .dropzone:hover,
    .dropzone.dragover {
        border-color: var(--primary);
        background: rgba(59, 130, 246, 0.08);
    }

    .dropzone h2 {
        margin: 0 0 0.4rem;
        font-size: 1.15rem;
    }

    .dropzone p {
        margin: 0 0 1rem;
        color: var(--muted);
        font-size: 0.9rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.55rem 1rem;
        border-radius: 8px;
        border: 1px solid transparent;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.15s, opacity 0.15s;
    }

    .btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-primary {
        background: var(--primary);
        color: #fff;
    }

    .btn-primary:hover:not(:disabled) {
        background: var(--primary-hover);
    }

    .btn-secondary {
        background: var(--surface-soft);
        color: var(--text);
        border-color: #475569;
    }

    .btn-secondary:hover:not(:disabled) {
        background: #475569;
    }

    .alert-error {
        display: none;
        margin-bottom: 1rem;
        padding: 0.85rem 1rem;
        border-radius: 8px;
        background: rgba(239, 68, 68, 0.15);
        border: 1px solid rgba(239, 68, 68, 0.5);
        color: #fecaca;
        font-size: 0.9rem;
    }

    .workspace {
        display: none;
        grid-template-columns: 1fr 290px;
        gap: 1.25rem;
        align-items: start;
    }

    @media (max-width: 860px) {
        .workspace {
            grid-template-columns: 1fr;
        }
    }

    .canvas-wrapper {
        position: relative;
        background: #020617;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 280px;
        border: 1px solid var(--border);
    }

    #editorCanvas {
        display: block;
        max-width: 100%;
        height: auto;
        user-select: none;
    }

    .loading-overlay {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, 0.78);
        backdrop-filter: blur(4px);
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 0.85rem;
        z-index: 10;
        text-align: center;
        padding: 1rem;
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(255, 255, 255, 0.2);
        border-top-color: var(--primary);
        border-radius: 50%;
        animation: spin 0.85s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .sidebar {
        background: #0f172a;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1rem;
    }

    .sidebar h3 {
        margin: 0 0 0.25rem;
        font-size: 1rem;
    }

    .sidebar .hint {
        margin: 0 0 1rem;
        color: var(--muted);
        font-size: 0.82rem;
    }

    .toolbar {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .toolbar .btn {
        flex: 1 1 auto;
        justify-content: center;
        padding: 0.45rem 0.7rem;
        font-size: 0.82rem;
    }

    .toggle-outline {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--muted);
        margin-bottom: 1rem;
        cursor: pointer;
    }

    .face-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        max-height: 360px;
        overflow-y: auto;
        margin-bottom: 1rem;
    }

    .face-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.55rem 0.75rem;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 8px;
        cursor: pointer;
        transition: border-color 0.15s;
    }

    .face-item:hover {
        border-color: var(--primary);
    }

    .face-name {
        font-size: 0.88rem;
        font-weight: 600;
    }

    .badge {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.2rem 0.55rem;
        border-radius: 999px;
    }

    .badge-blurred {
        background: rgba(239, 68, 68, 0.18);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.4);
    }

    .badge-visible {
        background: rgba(34, 197, 94, 0.18);
        color: #86efac;
        border: 1px solid rgba(34, 197, 94, 0.4);
    }

    .actions-footer {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        border-top: 1px solid var(--border);
        padding-top: 0.9rem;
    }

    .actions-footer .btn {
        width: 100%;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<div class="header">
    <h1>Smart Face Auto-Blur</h1>
    <p>Upload an image, let Gemini detect every face automatically, then tap any face box to unblur or re-blur.</p>
</div>

<div class="card">
    <div id="errorBanner" class="alert-error"></div>

    <input type="file" id="imageInput" accept="image/jpeg,image/png,image/webp" hidden>

    <div id="dropzone" class="dropzone">
        <h2>Drop an image here or click to upload</h2>
        <p>Supports JPG, PNG, WebP up to 10MB</p>
        <button type="button" class="btn btn-primary" id="browseBtn">Choose Image</button>
    </div>

    <div id="workspace" class="workspace">
        <div class="canvas-wrapper">
            <canvas id="editorCanvas"></canvas>
            <div id="loadingOverlay" class="loading-overlay">
                <div class="spinner"></div>
                <div>
                    <strong>Detecting faces with Gemini...</strong>
                    <div style="font-size: 0.85rem; color: #cbd5e1; margin-top: 0.25rem;">
                        Calculating bounding box coordinates
                    </div>
                </div>
            </div>
        </div>

        <aside class="sidebar">
            <h3 id="faceSummary">Detected Faces (0)</h3>
            <p class="hint">Click directly on any bounding box on the image—or click an item below—to toggle blur.</p>

            <div class="toolbar">
                <button type="button" id="blurAllBtn" class="btn btn-secondary">Blur All</button>
                <button type="button" id="unblurAllBtn" class="btn btn-secondary">Unblur All</button>
            </div>

            <label class="toggle-outline">
                <input type="checkbox" id="showOutlinesToggle" checked>
                Show bounding box outlines
            </label>

            <div id="faceList" class="face-list"></div>

            <div class="actions-footer">
                <button type="button" id="downloadBtn" class="btn btn-primary">Download Result</button>
                <button type="button" id="resetBtn" class="btn btn-secondary">Upload Another Image</button>
            </div>
        </aside>
    </div>
</div>
@endsection

@push('scripts')
<script>
(() => {
    const detectUrl = @json(route('face-blur.detect'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const imageInput = document.getElementById('imageInput');
    const dropzone = document.getElementById('dropzone');
    const browseBtn = document.getElementById('browseBtn');
    const workspace = document.getElementById('workspace');
    const canvas = document.getElementById('editorCanvas');
    const ctx = canvas.getContext('2d');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const errorBanner = document.getElementById('errorBanner');
    const faceSummary = document.getElementById('faceSummary');
    const faceList = document.getElementById('faceList');
    const showOutlinesToggle = document.getElementById('showOutlinesToggle');
    const blurAllBtn = document.getElementById('blurAllBtn');
    const unblurAllBtn = document.getElementById('unblurAllBtn');
    const downloadBtn = document.getElementById('downloadBtn');
    const resetBtn = document.getElementById('resetBtn');

    let currentImage = null;
    let currentObjectUrl = null;
    let detectedFaces = [];
    let hoveredFaceId = null;
    let isLoading = false;

    function showError(message) {
        errorBanner.textContent = message;
        errorBanner.style.display = 'block';
    }

    function clearError() {
        errorBanner.textContent = '';
        errorBanner.style.display = 'none';
    }

    function setLoading(loading) {
        isLoading = loading;
        loadingOverlay.style.display = loading ? 'flex' : 'none';
        blurAllBtn.disabled = loading || detectedFaces.length === 0;
        unblurAllBtn.disabled = loading || detectedFaces.length === 0;
        downloadBtn.disabled = loading || !currentImage;
    }

    function resetApp() {
        clearError();
        if (currentObjectUrl) {
            URL.revokeObjectURL(currentObjectUrl);
            currentObjectUrl = null;
        }
        currentImage = null;
        detectedFaces = [];
        hoveredFaceId = null;
        imageInput.value = '';
        workspace.style.display = 'none';
        dropzone.style.display = 'block';
        faceList.innerHTML = '';
        faceSummary.textContent = 'Detected Faces (0)';
    }

    async function handleFileSelected(file) {
        if (!file) return;
        clearError();

        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            showError('Please upload a JPG, PNG, or WebP image.');
            return;
        }

        if (file.size > 10 * 1024 * 1024) {
            showError('Image must be 10MB or smaller.');
            return;
        }

        if (currentObjectUrl) {
            URL.revokeObjectURL(currentObjectUrl);
        }

        currentObjectUrl = URL.createObjectURL(file);
        const img = new Image();

        img.onload = async () => {
            currentImage = img;
            detectedFaces = [];
            hoveredFaceId = null;

            canvas.width = img.naturalWidth;
            canvas.height = img.naturalHeight;

            dropzone.style.display = 'none';
            workspace.style.display = 'grid';

            renderScene();
            renderFaceList();
            await detectFacesInBackground(file);
        };

        img.onerror = () => {
            showError('Could not load the selected image.');
        };

        img.src = currentObjectUrl;
    }

    async function detectFacesInBackground(file) {
        setLoading(true);

        try {
            const formData = new FormData();
            formData.append('image', file);

            const response = await fetch(detectUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const data = await response.json().catch(() => ({}));

            if (!response.ok) {
                const validationMsg = data.errors?.image?.[0];
                throw new Error(validationMsg || data.message || 'Face detection failed.');
            }

            const imgW = currentImage.naturalWidth;
            const imgH = currentImage.naturalHeight;

            detectedFaces = (data.faces || []).map((face) => {
                const { ymin, xmin, ymax, xmax } = face.box;
                const x = Math.round((xmin / 1000) * imgW);
                const y = Math.round((ymin / 1000) * imgH);
                const w = Math.max(1, Math.round(((xmax - xmin) / 1000) * imgW));
                const h = Math.max(1, Math.round(((ymax - ymin) / 1000) * imgH));

                return {
                    id: face.id,
                    label: face.label,
                    blurred: Boolean(face.blurred),
                    rect: { x, y, w, h },
                };
            });

            if (detectedFaces.length === 0) {
                showError('Gemini did not detect any faces in this image.');
            }

            renderScene();
            renderFaceList();
        } catch (err) {
            showError(err.message || 'An error occurred while communicating with Gemini.');
        } finally {
            setLoading(false);
        }
    }

    /**
     * Blurs a specific bounding box onto targetCtx without transparent/black edge bleeding.
     */
    function applyFaceBlur(targetCtx, img, rect) {
        const { x, y, w, h } = rect;
        const imgW = img.naturalWidth;
        const imgH = img.naturalHeight;
        const blurRadius = Math.max(8, Math.round(Math.max(w, h) * 0.14));

        if ('filter' in targetCtx) {
            const pad = blurRadius * 2;
            const workW = w + pad * 2;
            const workH = h + pad * 2;

            const workCanvas = document.createElement('canvas');
            workCanvas.width = workW;
            workCanvas.height = workH;
            const workCtx = workCanvas.getContext('2d');

            const srcX = Math.max(0, x - pad);
            const srcY = Math.max(0, y - pad);
            const srcRight = Math.min(imgW, x + w + pad);
            const srcBottom = Math.min(imgH, y + h + pad);
            const srcW = Math.max(1, srcRight - srcX);
            const srcH = Math.max(1, srcBottom - srcY);

            // Fill margins with stretched local edge pixels so frame-edge faces stay opaque
            workCtx.drawImage(img, srcX, srcY, srcW, srcH, 0, 0, workW, workH);

            const destX = srcX - (x - pad);
            const destY = srcY - (y - pad);
            workCtx.drawImage(img, srcX, srcY, srcW, srcH, destX, destY, srcW, srcH);

            targetCtx.save();
            targetCtx.beginPath();
            targetCtx.rect(x, y, w, h);
            targetCtx.clip();
            targetCtx.filter = `blur(${blurRadius}px)`;
            targetCtx.drawImage(workCanvas, x - pad, y - pad);
            targetCtx.restore();
        } else {
            // Universal downscale-upscale fallback if ctx.filter is unsupported
            const smallW = Math.max(4, Math.round(w / 14));
            const smallH = Math.max(4, Math.round(h / 14));
            const tinyCanvas = document.createElement('canvas');
            tinyCanvas.width = smallW;
            tinyCanvas.height = smallH;
            const tinyCtx = tinyCanvas.getContext('2d');
            tinyCtx.drawImage(img, x, y, w, h, 0, 0, smallW, smallH);

            targetCtx.save();
            targetCtx.imageSmoothingEnabled = true;
            targetCtx.drawImage(tinyCanvas, 0, 0, smallW, smallH, x, y, w, h);
            targetCtx.restore();
        }
    }

    function renderScene(targetCtx = ctx, targetCanvas = canvas, showOutlines = showOutlinesToggle.checked) {
        if (!currentImage) return;

        targetCtx.clearRect(0, 0, targetCanvas.width, targetCanvas.height);
        targetCtx.drawImage(currentImage, 0, 0, targetCanvas.width, targetCanvas.height);

        for (const face of detectedFaces) {
            if (face.blurred) {
                applyFaceBlur(targetCtx, currentImage, face.rect);
            }
        }

        if (!showOutlines) return;

        const scaleFactor = Math.max(1, Math.min(targetCanvas.width, targetCanvas.height) / 700);
        const baseLineWidth = Math.max(2, Math.round(3 * scaleFactor));
        const fontSize = Math.max(13, Math.round(14 * scaleFactor));
        const padX = Math.round(8 * scaleFactor);
        const padY = Math.round(4 * scaleFactor);

        for (const face of detectedFaces) {
            const { x, y, w, h } = face.rect;
            const isHovered = face.id === hoveredFaceId;
            const strokeColor = face.blurred ? '#ef4444' : '#22c55e';

            targetCtx.save();
            targetCtx.strokeStyle = strokeColor;
            targetCtx.lineWidth = isHovered ? baseLineWidth + 2 : baseLineWidth;

            if (!face.blurred) {
                targetCtx.setLineDash([8 * scaleFactor, 5 * scaleFactor]);
            }

            targetCtx.strokeRect(x, y, w, h);

            if (isHovered) {
                targetCtx.fillStyle = face.blurred
                    ? 'rgba(239, 68, 68, 0.14)'
                    : 'rgba(34, 197, 94, 0.14)';
                targetCtx.fillRect(x, y, w, h);
            }

            // Draw status tag on the bounding box
            targetCtx.setLineDash([]);
            targetCtx.font = `600 ${fontSize}px -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif`;
            const badgeText = `${face.label} • ${face.blurred ? 'Blurred' : 'Visible'}`;
            const textMetrics = targetCtx.measureText(badgeText);
            const badgeW = textMetrics.width + padX * 2;
            const badgeH = fontSize + padY * 2;
            const badgeX = Math.min(x, targetCanvas.width - badgeW);
            const badgeY = y - badgeH - 2 >= 0 ? y - badgeH - 2 : y + 4;

            targetCtx.fillStyle = strokeColor;
            targetCtx.fillRect(badgeX, badgeY, badgeW, badgeH);

            targetCtx.fillStyle = '#ffffff';
            targetCtx.textBaseline = 'top';
            targetCtx.fillText(badgeText, badgeX + padX, badgeY + padY);
            targetCtx.restore();
        }
    }

    function renderFaceList() {
        const blurredCount = detectedFaces.filter((f) => f.blurred).length;
        faceSummary.textContent = `Detected Faces (${detectedFaces.length}) • ${blurredCount} Blurred`;
        faceList.innerHTML = '';

        if (detectedFaces.length === 0) {
            const empty = document.createElement('div');
            empty.style.color = '#94a3b8';
            empty.style.fontSize = '0.85rem';
            empty.textContent = isLoading ? 'Scanning image...' : 'No faces detected.';
            faceList.appendChild(empty);
            return;
        }

        for (const face of detectedFaces) {
            const item = document.createElement('button');
            item.type = 'button';
            item.className = 'face-item';

            const nameSpan = document.createElement('span');
            nameSpan.className = 'face-name';
            nameSpan.textContent = face.label;

            const badge = document.createElement('span');
            badge.className = `badge ${face.blurred ? 'badge-blurred' : 'badge-visible'}`;
            badge.textContent = face.blurred ? 'Blurred' : 'Unblurred';

            item.appendChild(nameSpan);
            item.appendChild(badge);

            item.addEventListener('click', () => {
                if (isLoading) return;
                face.blurred = !face.blurred;
                renderScene();
                renderFaceList();
            });

            item.addEventListener('mouseenter', () => {
                hoveredFaceId = face.id;
                renderScene();
            });

            item.addEventListener('mouseleave', () => {
                hoveredFaceId = null;
                renderScene();
            });

            faceList.appendChild(item);
        }
    }

    function getCanvasCoordinates(event) {
        const rect = canvas.getBoundingClientRect();
        const scaleX = canvas.width / rect.width;
        const scaleY = canvas.height / rect.height;
        return {
            x: (event.clientX - rect.left) * scaleX,
            y: (event.clientY - rect.top) * scaleY,
        };
    }

    function findFaceAtPoint(px, py) {
        const matches = detectedFaces.filter(({ rect }) =>
            px >= rect.x &&
            px <= rect.x + rect.w &&
            py >= rect.y &&
            py <= rect.y + rect.h
        );

        if (matches.length === 0) return null;

        // Pick smallest box so nested/smaller faces remain clickable
        matches.sort((a, b) => (a.rect.w * a.rect.h) - (b.rect.w * b.rect.h));
        return matches[0];
    }

    // Canvas click to toggle blur/unblur
    canvas.addEventListener('click', (event) => {
        if (isLoading || detectedFaces.length === 0) return;
        const { x, y } = getCanvasCoordinates(event);
        const hit = findFaceAtPoint(x, y);
        if (!hit) return;

        hit.blurred = !hit.blurred;
        renderScene();
        renderFaceList();
    });

    canvas.addEventListener('mousemove', (event) => {
        if (isLoading || detectedFaces.length === 0) {
            canvas.style.cursor = 'default';
            return;
        }
        const { x, y } = getCanvasCoordinates(event);
        const hit = findFaceAtPoint(x, y);
        const nextHoverId = hit ? hit.id : null;

        canvas.style.cursor = hit ? 'pointer' : 'default';

        if (nextHoverId !== hoveredFaceId) {
            hoveredFaceId = nextHoverId;
            renderScene();
        }
    });

    canvas.addEventListener('mouseleave', () => {
        if (hoveredFaceId !== null) {
            hoveredFaceId = null;
            renderScene();
        }
    });

    // Dropzone events
    browseBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        imageInput.click();
    });

    dropzone.addEventListener('click', () => imageInput.click());

    imageInput.addEventListener('change', (e) => {
        handleFileSelected(e.target.files[0]);
    });

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file) {
            handleFileSelected(file);
        }
    });

    // Toolbar & Export events
    showOutlinesToggle.addEventListener('change', () => renderScene());

    blurAllBtn.addEventListener('click', () => {
        detectedFaces.forEach((f) => { f.blurred = true; });
        renderScene();
        renderFaceList();
    });

    unblurAllBtn.addEventListener('click', () => {
        detectedFaces.forEach((f) => { f.blurred = false; });
        renderScene();
        renderFaceList();
    });

    downloadBtn.addEventListener('click', () => {
        if (!currentImage) return;

        // Render cleanly without bounding box overlays onto an offscreen canvas
        const exportCanvas = document.createElement('canvas');
        exportCanvas.width = canvas.width;
        exportCanvas.height = canvas.height;
        const exportCtx = exportCanvas.getContext('2d');

        renderScene(exportCtx, exportCanvas, false);

        const link = document.createElement('a');
        link.download = 'blurred-faces.png';
        link.href = exportCanvas.toDataURL('image/png');
        link.click();
    });

    resetBtn.addEventListener('click', resetApp);
})();
</script>
@endpush