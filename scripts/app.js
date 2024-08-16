document.addEventListener('DOMContentLoaded', function() {
    loadProducts();
});

function loadProducts() {
    // This function will load products from the XML file and display them on the page
    fetch('product-catalog.xml')
        .then(response => response.text())
        .then(data => {
            const parser = new DOMParser();
            const xml = parser.parseFromString(data, "text/xml");
            const products = xml.getElementsByTagName("product");

            let productHTML = '';
            for (let i = 0; i < products.length; i++) {
                const name = products[i].getElementsByTagName("name")[0].textContent;
                const description = products[i].getElementsByTagName("description")[0].textContent;
                const price = products[i].getElementsByTagName("price")[0].textContent;
                const image = products[i].getElementsByTagName("image")[0].textContent;

                productHTML += `
                    <div class="col-md-4">
                        <div class="card product-card">
                            <img src="images/${image}" class="card-img-top" alt="${name}">
                            <div class="card-body">
                                <h5 class="card-title">${name}</h5>
                                <p class="card-text">${description}</p>
                                <p class="card-text"><strong>$${price}</strong></p>
                            </div>
                        </div>
                    </div>
                `;
            }

            document.getElementById('product-list').innerHTML = productHTML;
        })
        .catch(error => console.error('Error loading products:', error));
}
