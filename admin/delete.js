function deleteRow(sem, subject, foldname, fname, ftype) {
    if (confirm("Are you sure you want to delete this file?")) {
        fetch('delete.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `sem=${encodeURIComponent(sem)}&subject=${encodeURIComponent(subject)}&foldname=${encodeURIComponent(foldname)}&fname=${encodeURIComponent(fname)}&ftype=${encodeURIComponent(ftype)}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Show success or error message
            location.reload(); // Optionally refresh the page
        })
        .catch(error => console.error('Error:', error));
    }
}