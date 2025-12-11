const resultsContainer = document.getElementById('resultsContainer');
const parent_child_select = document.getElementById('parent_id');

// Parent-child options creeren voor de createCat.blade.php
function generateCatOptions() {
    fetch(categoriesUrl)
        .then(response=> {
            if (!response.ok) {
                throw new Error('Network error or server fault.'); 
            }
            return response.json();
        })
        .then(data => {
            const categories = data.categories || [];


            let view = '<option value="0">Main Category (None)</option>';

            categories.forEach(category => {
                const id = category.id;
                const cat = category.name;
                view += `<option value="${id}">${cat}</option>`;
            });

            parent_child_select.innerHTML = view;
        })
        .catch(error => {
            console.error('Fout bij zoeken:', error);
            parent_child_select.innerHTML = `<option class="text-xl text-red-700">Er is een fout opgetreden: ${error.message}</option>`;
        });
}
generateCatOptions();