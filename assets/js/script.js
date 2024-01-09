const inputSearch = document.getElementById('keyword');
const btnSearch = document.getElementById('btn-search');
const container = document.getElementById('container');

inputSearch.addEventListener('keyup', () => {

    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText
        }
    }

    xhr.open('GET', `assets/ajax/siswa.php?keyword=${inputSearch.value}`, true)
    xhr.send()
})