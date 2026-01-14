const vendorIndexResult = document.getElementById("vendorIndexResult");

function vendorIndex() {
    fetch(productsIndexUrl)
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
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-sm whitespace-nowrap">${name}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-sm whitespace-nowrap">${categoryName}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-sm" style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${desc}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-sm whitespace-nowrap">${price}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-sm whitespace-nowrap">${stock}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-sm whitespace-nowrap">${status}</td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-center"><a href="/products/${id}/edit" class="text-blue-500 hover:text-blue-700 transition" title="Edit"><i class="fas fa-edit"></i></a></td>` +
                    `<td class="px-4 py-2 sm:px-4 sm:py-4 text-center"><form action="/products/${id}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete ${name}?')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="${document
                            .querySelector("meta[name=csrf-token]")
                            .getAttribute("content")}">
                        <button type="submit" class="text-red-500 hover:text-red-700 transition border-0 bg-transparent cursor-pointer" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>` +
                    `</tr>`;
            });

            vendorIndexResult.innerHTML = view;
        })
        .catch((error) => {
            console.error("Error :/");
            vendorIndexResult.innerHTML = `<tr><td>No products found </td></tr>`;
        });
}

vendorIndex();
