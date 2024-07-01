$(document).ready(function() {
    $('#dataForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: 'backend.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const data = JSON.parse(response);
                if(data.success) {
                    $('#dataTable tbody').append(`
                        <tr>
                            <td>${data.name}</td>
                            <td>${data.email}</td>
                        </tr>
                    `);
                    $('#dataForm')[0].reset();
                } else {
                    alert('Failed to add data. Please try again.');
                }
            }
        });
    });
});
