const parent_child_select = document.getElementById("category_id");
const index_categories = document.getElementById("index_categories");

function generateCatOptions() {
    fetch(categoriesUrl)
        .then((response) => response.json())
        .then((data) => {
            const categories = data.categories || [];
            
            const mainCategories = categories.filter((cat) => !cat.parent_id);
            const subCategories = categories.filter((cat) => cat.parent_id);

            let view = '<option value="0">Main Category (None)</option>';

            mainCategories.forEach((main) => {
                view += `<option value="${main.id}" class="font-bold text-blue-600">${main.name.toUpperCase()}</option>`;

                const filteredSubs = subCategories.filter(sub => sub.parent_id == main.id);
                
                filteredSubs.forEach((sub) => {
                    view += `<option value="${sub.id}">&nbsp;&nbsp;&nbsp;-- ${sub.name}</option>`;
                });
            });
            parent_child_select.innerHTML = view;
        })
        .catch((error) => {
            console.error("Fout bij zoeken:", error);
            parent_child_select.innerHTML = `<option class="text-xl text-red-700">Er is een fout opgetreden: ${error.message}</option>`;
        });
}
generateCatOptions();


function indexCategories() {
    fetch(categoriesUrl)
        .then((response) => response.json())
        .then((data) => {
            const categories = data.categories || [];
            
            const mainCategories = categories.filter((cat) => !cat.parent_id);
            const subCategories = categories.filter((cat) => cat.parent_id);

            let index_cat_view = '<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">';

            mainCategories.forEach((main) => {
                const filteredSubs = subCategories.filter(sub => sub.parent_id == main.id);
                let subListHtml = '<ul class="space-y-1 text-gray-600">'; // Verwijder 'list-disc' als je geen bolletjes wilt

                if (filteredSubs.length > 0) {
                    filteredSubs.forEach((sub) => {
                        subListHtml += `<li class="text-sm border-b border-gray-50 pb-1 hover:text-indigo-600 transition tracking-wide">
                                            ${sub.name}
                                        </li>`;
                    });
                } else {
                    subListHtml += '<li class="text-sm italic text-gray-400">No subcategories yet</li>';
                }
                subListHtml += '</ul>';
                index_cat_view += `
                <div class="shadow-xl rounded-lg h-80 w-full flex flex-col border-4 border-blue-500 overflow-hidden">
                    <div class="bg-blue-500 text-white p-6 h-1/2 flex items-center justify-center">
                        <p class="text-2xl font-extrabold text-center">${main.name}</p>
                    </div>
                    <div class="bg-white p-4 h-1/2 flex flex-col justify-start overflow-y-auto">
                        <p class="text-xs font-bold text-blue-500 uppercase mb-2">Subcategories:</p>
                        <div class="flex-grow bg-white overflow-y-auto" style="max-height: 250px;">
                            <p class="text-[10px] font-black text-gray-400 uppercase mb-5 tracking-widest">Available Categories</p>
                            ${subListHtml}
                        </div>
                    </div>
                </div>`;
            });
            
            index_cat_view += '</div>';

            console.log(index_cat_view);
            index_categories.innerHTML = index_cat_view;
        })
}
indexCategories();