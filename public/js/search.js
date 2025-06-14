document.getElementById('searchIcon').addEventListener('click', function() {
    const query = document.querySelector('.dropmenu2 input').value;
    if (query.trim() !== '') {
        window.location.href = `/search?query=${encodeURIComponent(query)}`;
    }
});
