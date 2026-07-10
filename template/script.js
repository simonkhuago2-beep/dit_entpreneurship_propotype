document.addEventListener('DOMContentLoaded', function() {
    const currencyMenu = document.querySelector('.ribbon.currency');
    const currencySelect = document.getElementById('currency-select');
    const prices = document.querySelectorAll('.price');

    // Function to update the selected currency in the menu
    function updateSelectedCurrency(selectedCurrency) {
        const currencyLinks = currencyMenu.querySelectorAll('.menu li a');
        currencyLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('data-currency') === selectedCurrency) {
                link.classList.add('active');
            }
        });
    }

    // Event listener for menu currency selection
    currencyMenu.addEventListener('click', function(event) {
        if (event.target.tagName === 'A') {
            const selectedCurrency = event.target.getAttribute('data-currency');
            currencySelect.value = selectedCurrency; // Update the select box value
            updatePrices(selectedCurrency); // Update the prices based on the selected currency
            event.preventDefault();
        }
    });

    // Event listener for select box currency change
    currencySelect.addEventListener('change', function() {
        const selectedCurrency = currencySelect.value;
        updatePrices(selectedCurrency);
        updateSelectedCurrency(selectedCurrency);
    });

    // Function to update prices based on the selected currency
    function updatePrices(selectedCurrency) {
        const exchangeRates = {
            'EUR': 1, // Euro to Euro (1:1)
            'GHS': 6.93, // Euro to Ghanaian Cedi
            'NGN': 465 // Euro to Nigerian Naira
            // Add more exchange rates for other African country currencies here
        };

        prices.forEach(price => {
            const priceEuro = parseFloat(price.dataset.price);
            const convertedPrice = priceEuro * exchangeRates[selectedCurrency];
            const formattedPrice = `${convertedPrice.toFixed(2)} ${selectedCurrency}`;

            const perDayText = price.innerHTML.includes('</small>') ? price.innerHTML.split('</small>')[1] : '';
            
            price.innerHTML = `<small>${formattedPrice}</small>${perDayText}`;
        });
    }

    // Initialize the selected currency based on the default selection or saved user preference
    const defaultCurrency = currencySelect.value;
    updateSelectedCurrency(defaultCurrency);
    updatePrices(defaultCurrency);
});
