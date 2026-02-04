const category_id = document.getElementById("category_id");
const admin_index_categories = document.getElementById("admin_index_categories");
const products_index_result = document.getElementById("products_index");
const index_filter_category = document.getElementById("index_filter_category");
const products_index_header = document.getElementById("product_index_header");

if (index_filter_category) {
    index_filter_category.addEventListener('change' , () => {
        filterCategory(index_filter_category.value);
    }); 
}

// Functie om Categorie opties genereren voor de select velden
function generateCatOptions() {
    if (!category_id) return;
    fetch(category_url)
        .then((response) => response.json())
        .then((data) => {
            const categories = data.categories || [];
            const mainCategories = categories.filter((cat) => !cat.parent_id);
            const subCategories = categories.filter((cat) => cat.parent_id);

            let view = '';

            mainCategories.forEach((main) => {
                view += `<option value="${main.id}" class="font-bold text-blue-600">${main.name.toUpperCase()}</option>`;

                const filteredSubs = subCategories.filter(
                    (sub) => sub.parent_id == main.id,
                );

                filteredSubs.forEach((sub) => {
                    view += `<option value="${sub.id}">&nbsp;&nbsp;&nbsp; ${sub.name}</option>`;
                });
            });
            category_id.innerHTML = view;
        })
        .catch((error) => {
            console.error("Fout bij laden categorieën:", error);
            if (category_id) {
                category_id.innerHTML = `<option class="text-xl text-red-700">Er is een fout opgetreden: ${error.message}</option>`;
            }
        });
}
generateCatOptions();
//</>//


// Functie die de admin de overzicht van alle Main Categorieen en hun Sub
function indexCategories() {
    if (!admin_index_categories) return;
    fetch(category_url)
        .then((response) => response.json())
        .then((data) => {
            const categories = data.categories || [];

            const mainCategories = categories.filter((cat) => !cat.parent_id);
            const subCategories = categories.filter((cat) => cat.parent_id);

            let index_cat_view =
                '<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">';

            mainCategories.forEach((main) => {
                const filteredSubs = subCategories.filter(
                    (sub) => sub.parent_id == main.id,
                );
                let subListHtml = '<ul class="space-y-1 text-gray-600">';

                if (filteredSubs.length > 0) {
                    filteredSubs.forEach((sub) => {
                        subListHtml += `<li class="text-sm border-b border-gray-50 pb-1 hover:text-indigo-600 transition tracking-wide">
                                            ${sub.name}
                                        </li>`;
                    });
                } else {
                    subListHtml +=
                        '<li class="text-sm italic text-gray-400">No subcategories yet</li>';
                }
                subListHtml += "</ul>";
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

            index_cat_view += "</div>";

            admin_index_categories.innerHTML = index_cat_view;
        
        })
        .catch((error) => {
            console.error("Fout bij laden categorieën:", error);
            if (admin_index_categories) {
                admin_index_categories.innerHTML =
                    '<p class="text-red-700">Er is een fout opgetreden bij het laden van categorieën.</p>';
            }
        });
}
indexCategories();
//</>//


function filterCategory (query) {
    if (!products_index_result) return;
    fetch(category_filter_url + "?query=" + query)
    .then(result => result.json()) 
    .then(data => {
        if (data.status === "success" && data.products && data.products.length > 0) {
            const products = data.products || [];
            let view = "";

            if (products.length === 0) {
                products_index_result.innerHTML = 
                    '<p class="text-center col-span-full text-gray-500">No products available.</p>';
                return;
            }
            products.forEach((element) => {
                const id = element.id;
                const price = parseFloat(element.price).toFixed(2);
                const vendor = element.vendor?.shop_name || "Official Store";
                const mainImage = element.images?.[0]?.image_path;
                const firstImage = mainImage
                        ? `/storage/${mainImage}`
                        : "/path/to/placeholder.png";

                let btnColor = element.is_in_cart ? 
                    "bg-red-600 hover:bg-red-700"    
                    :"bg-blue-600 hover:bg-blue-700";
                let btnText = element.is_in_cart ? "In Cart" :"Add to Cart";

                products_index_header.innerHTML = `<h2 class="font-extrabold text-2xl text-blue-600 tracking-tight">${element.category?.name}</h2>`;

                view += `
                <div class="product_card bg-white shadow-md rounded-xl overflow-hidden border border-gray-100 flex flex-col hover:shadow-xl transition-shadow duration-300">
                    <a href="/products/${id}" class="flex-grow">
                        <div class="relative w-full h-48 overflow-hidden rounded-t-lg bg-gray-100">
                            <img id="img_${id}" 
                            src="${firstImage}" 
                            alt="${element.name}" 
                            class="w-full h-48 object-cover transition-opacity duration-500 opacity-100">
                        </div>
                        <div class="p-5">
                            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">${element.category?.name || "General"}</span>
                            <h1 class="text-gray-800 font-semibold text-lg line-clamp-2 mt-1 mb-2 h-14">${element.name}</h1>
                            <p class="text-sm text-gray-500 italic mb-4">By ${vendor}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-black text-gray-900">€${price}</span>
                            </div>
                        </div>
                    </a>
                    <div class="p-5 pt-0 mt-auto">
                        <button 
                            onclick="addToCart(${id})" 
                            class="w-full ${btnColor} hover:opacity-90 text-white font-bold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <i class="fa-solid fa-cart-shopping text-sm"></i> ${btnText}
                        </button>
                    </div>
                </div>`;
            });
            
            products_index_result.innerHTML = view;

            //Geschreven door AI
            products.forEach((element) => {
                const allImages =
                    element.images && element.images.length > 1
                        ? element.images.map(
                              (img) => `/storage/${img.image_path}`,
                          )
                        : [];

                if (allImages.length > 1) {
                    let currentIndex = 0;
                    const imgId = `img_${element.id}`;

                    setInterval(() => {
                        const imgElement = document.getElementById(imgId);
                        if (imgElement) {
                            imgElement.style.opacity = "0";
                            setTimeout(() => {
                                currentIndex =
                                    (currentIndex + 1) % allImages.length;
                                imgElement.src = allImages[currentIndex];
                                imgElement.style.opacity = "1";
                            }, 500);
                        }
                    }, 10000);
                }
            });
            //</>//
        }
    })
    .catch(error => {
        console.error("Search error:", error);
        result_container.innerHTML = '<p class="p-4 text-red-500">Something went wrong on our end. Please try again in a moment.</p>';
        result_container.classList.add('hidden');
    });
}
//</>//
