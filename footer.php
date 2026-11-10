        </section>
    </main>
</div>
<script>
document.querySelectorAll('[data-confirm]').forEach(function (el) {
    el.addEventListener('click', function (event) {
        if (!confirm(el.getAttribute('data-confirm'))) event.preventDefault();
    });
});
const searchInput = document.getElementById('tableSearch');
if (searchInput) {
    searchInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('#alatTable tbody tr[data-row]').forEach(function (row) {
            row.style.display = row.innerText.toLowerCase().includes(keyword) ? '' : 'none';
        });
    });
}
</script>
</body>
</html>
