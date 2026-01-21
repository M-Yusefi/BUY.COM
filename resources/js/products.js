const vendor_index_result = document.getElementById("vendorIndexResult");
const products_index_result = document.getElementById("products_index");
const serach_input = document.getElementById("searchInput");
const result_container = document.getElementById("result_container");

serach_input.addEventListener("input", () => {
    search(serach_input.value);
});
//Verwerkt de Vendor productgegevens die vanuit de ProductController worden aangeleverd.
function vendorIndex() {
    if (!vendor_index_result) return;
    fetch(vendor_items_url)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network error or server fault.");
            }
            return response.json();
        })
        .then((data) => {
            const products = data.products || [];

            let view = "";
            products.forEach((element) => {
                const id = element.id;
                const name = element.name;
                const categoryName = element.category?.name || "N/A";
                const desc = element.description || "N/A";
                const price = element.price;
                const stock = element.stock;
                const status = element.status;

                // Get first image (main image)
                const mainImage =
                    element.images && element.images.length > 0
                        ? element.images[0]
                        : null;
                const imageHtml = mainImage
                    ? `<img src="/storage/${mainImage.image_path}" alt="${mainImage.alt_text}" class="w-12 h-12 object-cover rounded">`
                    : `<span class="text-gray-400">No image</span>`;

                view +=
                    `<tr id="product-${id}">\n` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 whitespace-nowrap">${imageHtml}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-m whitespace-nowrap">${name}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-m whitespace-nowrap">${categoryName}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-m" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${desc}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-m font-bold text-blue-600 whitespace-nowrap">€${parseFloat(price).toFixed(2)}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-m whitespace-nowrap">${stock}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-m whitespace-nowrap">${status}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-center"><a href="/products/${id}/edit" class="text-blue-500 hover:text-blue-700 transition" title="Edit"><i class="fas fa-edit"></i></a></td>` +
                    `<td class="px-4 py-2 text-center">
                        <form action="/products/${id}" method="POST" onsubmit="return confirm('Delete ${name}?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="${document.head.querySelector('meta[name="csrf-token"]').content}">
                            
                            <button type="submit" class="text-red-500 hover:scale-110 transition-transform p-2">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>` +
                    `</tr>`;
            });

            vendor_index_result.innerHTML = view;
        })
        .catch((error) => {
            console.error("Fout bij laden vendor producten:", error);
            if (vendor_index_result) {
                vendor_index_result.innerHTML = `<tr><td>No products found</td></tr>`;
            }
        });
}
vendorIndex();
//</>//

// Haalt productgegevens op uit de controller en rendert deze in de index-container
function product_index() {
    if (!products_index_result) return;
    fetch(index_items_url)
        .then((response) => {
            if (!response.ok) throw new Error("Network error or server fault.");
            return response.json();
        })
        .then((data) => {
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
                const firstImage =
                    element.images && element.images.length > 0
                        ? `/storage/${element.images[0].image_path}`
                        : "/path/to/placeholder.png";

                view += `
                <div class="product_card bg-white shadow-md rounded-xl overflow-hidden border border-gray-100 flex flex-col hover:shadow-xl transition-shadow duration-300">
                    <a href="/products/${id}" class="flex-grow">
                        <div class="relative bg-gray-50 overflow-hidden aspect-[5/4]">
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
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <i class="fa-solid fa-cart-shopping text-sm"></i> Add to Cart
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
        })
        .catch((error) => {
            console.error("Fout bij laden producten:", error);
            if (products_index_result) {
                products_index_result.innerHTML =
                    '<p class="text-center col-span-full text-red-700">Er is een fout opgetreden bij het laden van producten.</p>';
            }
        });
}
product_index();
//</>//

function search(query) {
    fetch(search_url + "?query=" + query)
        .then(result => result.json())
        .then(data => {
            if (data.status === "success" && data.products && data.products.length > 0) { 
                let view = `
                    <table class="min-w-full text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-2 text-lg font-semibold text-gray-600 uppercase">Image</th>
                                <th class="px-4 py-2 text-lg font-semibold text-gray-600 uppercase">Name</th>
                                <th class="px-4 py-2 text-lg font-semibold text-gray-600 uppercase">Price</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">`;
                
                data.products.forEach((product) => {
                    const mainImage = product.images?.[0]?.image_path;
                    const imageHtml = mainImage 
                        ? `<img src="/storage/${mainImage}" class="w-10 h-10 object-cover rounded shadow-sm">` 
                        : `<div class="w-10 h-10 bg-gray-200 flex items-center justify-center rounded"><i class="fa-solid fa-image text-gray-400"></i></div>`;

                    view += `
                        <tr class="hover:bg-blue-50 cursor-pointer transition-colors" onclick="window.location='/products/${product.id}'">
                            <td class="px-4 py-3">${imageHtml}</td>
                            <td class="px-4 py-3 text-m font-medium text-gray-800">${product.name}</td>
                            <td class="px-4 py-3 text-m font-bold text-blue-600">€${parseFloat(product.price).toFixed(2)}</td>
                        </tr>`;
                });

                view += "</tbody></table>";
                result_container.innerHTML = view;
                result_container.classList.remove('hidden');
            } else {
                // Geen resultaten gevonden
                result_container.innerHTML = '<p class="p-4 text-gray-500">No products found</p>';
                result_container.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error("Search error:", error);
            result_container.innerHTML = '<p class="p-4 text-red-500">Something went wrong on our end. Please try again in a moment.</p>';
            result_container.classList.add('hidden');
        });
}
