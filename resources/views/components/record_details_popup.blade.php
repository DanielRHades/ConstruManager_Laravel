<div id="record-details" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
    <div class="bg-white p-8 rounded-lg shadow-md w-96 relative">

        <button onclick="closeEditRecord()" class="absolute right-0 top-0 me-4 mt-2">x</button>

        <p class="font-bold" id="record-details-date"></p>
        <p id="record-details-description"></p>
    </div>
</div>

<script>
    function closeEditRecord() {
        document.getElementById('record-details').classList.add('hidden');
    }
</script>
