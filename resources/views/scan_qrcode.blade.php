@extends('layout.layout')

@section('content')
<div class=" container text-center justify-content-center align-self-center">
    <div class="card bg-light mb-3" style="color:black">
        <div class="card-header">
            <h4>Scan from webcam</h4> 
        </div>
        <div class="card-body">
            <div>
                <b>device has camera : </b> <span class="text-success" id="cam-has-camera"></span>
                <br>
                <br>
                <video muted playsinline width="100%" height="320" id="qr-video"></video>
            </div>
            <div>
                <select id="inversion-mode-select" class="custom-select" style="width:50%">
                    <option value="original">Scan original (dark QR code on bright background)</option>
                    <option value="invert">Scan with inverted colors (bright QR code on dark background)</option>
                    <option value="both">Scan both</option>
                </select>
                <br>
            </div>
            <br>
            <b>detected qrode:</b>
            <span id="cam-qr-result">None</span>
            <br>
            <b>last detected at:</b><span id="cam-qr-result-timestamp"></span>
        </div>
    </div>

    <div class="card bg-light mb-3" style="color:black">
        <div class="card-header">
            <h4>Scan from file</h4> 
        </div>
        <div class="card-body">
            <input type="file" id="file-selector">
            <b>detected qrode: </b>
            <span id="file-qr-result">None</span>
        </div>
    </div>
</div>

<script type="module">
    import QrScanner from "/js/qr-scanner.min.js";
    QrScanner.WORKER_PATH = '/js/qr-scanner-worker.min.js';

    const video = document.getElementById('qr-video');
    const camHasCamera = document.getElementById('cam-has-camera');
    const camQrResult = document.getElementById('cam-qr-result');
    const camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp');
    const fileSelector = document.getElementById('file-selector');
    const fileQrResult = document.getElementById('file-qr-result');

    function setResult(label, result) {
        label.textContent = result;
        camQrResultTimestamp.textContent = new Date().toString();
        label.style.color = 'teal';
        clearTimeout(label.highlightTimeout);
        label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100);
    }

    // ####### Web Cam Scanning #######

    QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera);

    const scanner = new QrScanner(video, result => setResult(camQrResult, result));
    scanner.start();

    document.getElementById('inversion-mode-select').addEventListener('change', event => {
        scanner.setInversionMode(event.target.value);
    });

    // ####### File Scanning #######

    fileSelector.addEventListener('change', event => {
        const file = fileSelector.files[0];
        if (!file) {
            return;
        }
        QrScanner.scanImage(file)
            .then(result => setResult(fileQrResult, result))
            .catch(e => setResult(fileQrResult, e || 'No QR code found.'));
    });

</script>
@endsection