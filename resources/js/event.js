function editEvent(id) {
    // Ambil data event menggunakan fetch
    fetch(`/events/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            // Mengisi form dengan data event yang diambil
            document.getElementById('form-title').textContent = 'Edit Event';
            document.getElementById('event-form').action = `/events/${id}`;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('event-id').value = id;
            document.getElementById('title').value = data.title;
            document.getElementById('description').value = data.description;
            document.getElementById('start_time').value = data.start_time;
            document.getElementById('end_time').value = data.end_time;
        })
        .catch(error => {
            alert('Error: ' + error.message);
        });
}
