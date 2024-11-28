import './bootstrap';

$.ajax({
    url: '/tasks',
    method: 'POST',
    data: $('#taskForm').serialize(),
    success: function(response) {
        // Tampilkan pesan sukses di halaman
        alert(response.message);
    },
    error: function() {
        alert('There was an error.');
    }
});


