const vendorIndexResult = document.getElementById('vendorIndexResult');

function vendorIndex() {
    fetch(productsIndexUrl) 
        .then(response=> {
            if (!response.ok) {
                throw new Error('Network error or server fault.');
            }
            return response.json();
        })
        .then(data => {
            const products = data.products || [];


            products.forEach(element => {
                const name = element.name;
                const desc = element.description;
                const price = element.price;
                const stock = element.stock;
                const status = element.status;
                const crearedAt = element.created_at;

                let view = `<tr> 
                    <td> ${name}</td>
                    <td> ${desc}</td>
                    <td> ${price}</td>
                    <td> ${stock}</td>
                    <td> ${status}</td>
                    <td> ${crearedAt}</td>
                    </tr>`;
            });

            vendorIndexResult.innerHTML = view;
        })
        .catch(error => {
            console.error('Error :/');
            vendorIndexResult.innerHTML = `<tr><td>No products found </td></tr>`;
        })
}

vendorIndex();